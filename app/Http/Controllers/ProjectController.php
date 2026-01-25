<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Center;
use App\Models\User;
use App\Models\ProjectDocument;
use App\Models\UserProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();
        $status = $request->input("status");
        if ($status == "active") {
            $query->where("is_active", true);
        } elseif ($status == "inactive") {
            $query->where("is_active", false);
        }
        $projects = $query->with(['centerRelation', 'userRelation'])->orderBy('created_at', 'desc')->get();

        $viewType = $_COOKIE['view_type'] ?? "card";

        return view("projects.index", compact("projects","viewType"));
    }

    public function search(Request $request)
    {
        $htmlContent = "";
        $searchValue = $request->searchValue;
        $orderBy = $request->orderBy;
        $status = $request->status;

        $query = Project::query();

        if ($searchValue) {
            $query->where("name", "like", "%$searchValue%");
        }

        if ($status == "active") {
            $query->where("is_active", true);
        } elseif ($status == "inactive") {
            $query->where("is_active", false);
        }

        switch ($orderBy) {
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
            default:
                $query->orderBy("created_at", "desc");
        }
        $projects = $query->get();

        if ($projects->isNotEmpty()) {
            $viewType = $_COOKIE['view_type'] ?? "card";
            if ($viewType == "card") {
                foreach ($projects as $project) {
                    $htmlContent .= view("components.project-card", compact("project"))->render();
                }
            } else {
                foreach ($projects as $project) {
                    $htmlContent .= view("components.project-table", compact("project"))->render();
                }
            }
        }
        return response()->json(["htmlContent" => $htmlContent]);
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
            'documents.*' => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif,txt,zip,rar|max:2048',
        ]);

        $validated["center"]= Center::find(Session::get("active_center_id"));


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
        ]);

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                if (!$file->isValid() || !in_array($file->extension(), ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'gif', 'txt', 'zip', 'rar'])) {
                    return back()->with('error', 'El fitxer ha de ser un document vàlid.');
                }
                if ($file->getSize() > 2048 * 1024) {
                    return back()->with('error', 'El fitxer no pot pesar més de 2MB.');
                }
            }
        }


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
            Storage::delete('private/' . $document->path);
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
    private function processDocuments(Project $project, $files)
    {
        foreach ($files as $document) {
            // Guardar el archivo
            $path = $document->store('project-documents', 'private');
            
            // Crear registro en la base de datos
            $project->documents()->create([
                'name' => $document->getClientOriginalName(),
                'path' => $path,
                'user' => auth()->id(),
            ]);
        }
    }

    /**
     * Eliminar un documento específico
     */
    public function deleteDocument(ProjectDocument $document)
    {
        Storage::delete('private/' . $document->path);
        $document->delete();
        
        return back()->with('success', 'Document eliminat correctament.');
    }
}