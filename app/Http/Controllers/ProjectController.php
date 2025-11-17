<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Center;
use App\Models\User;
use App\Models\ProjectDocument;
use App\Models\UserProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();
        // $activeProjects = Project::active()->count();
        // $inactiveProjects = Project::inactive()->count();
        
        $projects = Project::with(['centerRelation', 'userRelation'])
                          ->orderBy('created_at', 'desc')
                          ->paginate(20);

        return view("projects.index", compact(
            'totalProjects', 
            // 'activeProjects', 
            // 'inactiveProjects',
            'projects'
        ));
    }

    public function search(Request $request)
    {
        $pagination = "";
        $htmlContent = "";
        // Se obtiene la pagina, sino, se usa la pagina 1
        $page = $request->input("page", 1);
        $searchValue = $request->searchValue;
        $searchProjects = Project::where("name", "like" , "%$searchValue%")->paginate(20, ["*"], "page", $page);
        if (!empty($searchProjects)) {
            foreach ($searchProjects as $project) {
                $htmlContent .= view("components.project-card", compact("project"))->render();
            }
            // Se obtiene la paginacion
            $pagination = $searchProjects->links()->render();
        }
        return response()->json(["htmlContent" => $htmlContent, "pagination" => $pagination]);
    }
    
    public function filter(Request $request)
    {
        $page = $request->input("page", 1);
        $order = $request->input("order", null);
        $status = $request->input("status", null);
        $query = Project::query();

        // Se obtiene el filtro del estado y se añade a la query
        if ($status == "active") {
            $query->where("is_active", true);
        } elseif ($status == "inactive") {
            $query->where("is_active", false);
        }
        // Se comprueba que tipo de orden se envia y se añade a la query
        switch ($order) {
            case "recent-first":
                $query->orderBy("created_at", "desc");
                break;
            case "oldest-first":
                $query->orderBy("created_at", "asc");
                break;
            case "az":
                $query->orderBy("name", "asc");
                break;
            case "za":
                $query->orderBy("name", "desc");
                break;
            case "last-modified":
                $query->orderBy("updated_at", "desc");
                break;
            case "first-modified":
                $query->orderBy("updated_at", "asc");
                break;
        }

        // Se pagina la query
        $projects = $query->paginate(20, ["*"], "page", $page);

        // Lo mismo que con search, se obtienen los cursos que se obtienen en la query
        $htmlContent = "";
        foreach ($projects as $project) {
            $htmlContent .= view("components.project-card", compact("project"))->render();
        }
        $pagination = $projects->links()->render();

        return response()->json(["htmlContent" => $htmlContent, "pagination" => $pagination]);
    }

    public function create()
    {
        $project = new Project();
        $centers = Center::all();
        $assignedUsers = collect();
        // $users = User::active()->get();
        $users = User::all();
        return view('projects.create', compact('centers', 'users', 'project', "assignedUsers"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:project,commission',
            'user' => 'required|exists:users,id',
            'start' => 'nullable|date',
            'description' => 'required|string|max:255',
            'observations' => 'required|string|max:255',
            'documents' => 'nullable|array',
            'documents.*' => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif,txt,zip,rar|max:10240', // 10MB max
        ]);

        $validated["center"]=1;

        $validated['is_active'] = true;

        // Crear el proyecto
        $project = Project::create($validated);

        // Procesar documentos si existen
        if ($request->hasFile('documents')) {
            $this->processDocuments($project, $request->file('documents'));
        }

        // Se procesan los usuarios
        $asignedUsers = $request->input("users");
        if (!empty($asignedUsers)) {
            foreach ($asignedUsers as $userId) {
                // Se añaden los nuevos usuarios
                UserProject::create(["user" => $userId, "project" => $project->id]);
            }
        }

        return redirect()->route('projects.index')->with('success', 'Projecte/comissió creat correctament.');
    }

    public function show(Project $project)
    {
        $asignedUsers = $project->users;
        $project->load(['centerRelation', 'userRelation', 'documents']);
        return view("projects.show", compact("project", "asignedUsers"));
    }

    public function edit(Project $project)
    {
        $centers = Center::all();
        // $users = User::active()->get();
        $users = User::all();
        $assignedUsers = $project->users;

        $project->load('documents');
        return view('projects.edit', compact('project', 'centers', 'users', "assignedUsers"));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:project,commission',
            'user' => 'required|exists:users,id',
            'start' => 'nullable|date',
            'description' => 'required|string|max:255',
            'observations' => 'required|string|max:255',
            'documents' => 'nullable|array',
            'documents.*' => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif,txt,zip,rar|max:10240', // 10MB max
        ]);

        $validated["center"]=1;

        $project->update($validated);


        // Se procesan los usuarios
        $asignedUsers = $request->input("users");
        if (!empty($asignedUsers)) {
            foreach ($asignedUsers as $userId) {
                $searchUser = UserProject::where(["user" => $userId, "project" => $project->id])->exists();
                
                if (!$searchUser) {
                    UserProject::create(["user" => $userId, "project" => $project->id]);
                }
            }
        }


        // Procesar nuevos documentos si existen
        if ($request->hasFile('documents')) {
            $this->processDocuments($project, $request->file('documents'));
        }

        return redirect()->route('projects.index')->with('success', 'Projecte/comissió actualitzat correctament.');
    }

    public function destroy(Project $project)
    {
        // Eliminar documentos asociados
        foreach ($project->documents as $document) {
            Storage::delete('public/' . $document->path);
            $document->delete();
        }

        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Projecte/comissió eliminat correctament.');
    }

    public function deactivate(Project $project)
    {
        $project->update(['is_active' => false]);
        return redirect()->route('projects.index')->with('success', 'Projecte/comissió desactivat correctament.');
    }

    public function activate(Project $project)
    {
        $project->update(['is_active' => true]);
        return redirect()->route('projects.index')->with('success', 'Projecte/comissió activat correctament.');
    }

    /**
     * Procesar y guardar documentos
     */
    private function processDocuments(Project $project, $documents)
    {
        foreach ($documents as $document) {
            // Guardar el archivo
            $path = $document->store('project-documents', 'public');
            
            // Crear registro en la base de datos
            ProjectDocument::create([
                'name' => $document->getClientOriginalName(),
                'project' => $project->id,
                'path' => $path
            ]);
        }
    }

    /**
     * Eliminar un documento específico
     */
    public function deleteDocument(ProjectDocument $document)
    {
        Storage::delete('public/' . $document->path);
        $document->delete();
        
        return back()->with('success', 'Document eliminat correctament.');
    }
}