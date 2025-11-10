<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Center;
use App\Models\User;
use App\Models\ProjectDocument;
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
                          ->get();

        return view("projects.index", compact(
            'totalProjects', 
            // 'activeProjects', 
            // 'inactiveProjects',
            'projects'
        ));
    }

    public function create()
    {
        $project = new Project();
        $centers = Center::all();
        // $users = User::active()->get();
        $users = User::all();
        return view('projects.create', compact('centers', 'users', 'project'));
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

        return redirect()->route('projects.index')->with('success', 'Projecte/comissió creat correctament.');
    }

    public function show(Project $project)
    {
        $project->load(['centerRelation', 'userRelation', 'documents']);
        return view("projects.show", compact("project"));
    }

    public function edit(Project $project)
    {
        $centers = Center::all();
        // $users = User::active()->get();
        $users = User::all();
        $project->load('documents');
        return view('projects.edit', compact('project', 'centers', 'users'));
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