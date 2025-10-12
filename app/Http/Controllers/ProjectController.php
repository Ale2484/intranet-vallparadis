<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Center;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();
        $activeProjects = Project::active()->count();
        $inactiveProjects = Project::inactive()->count();
        
        // Todos los proyectos mezclados, ordenados por creación
        $projects = Project::with(['centerRelation', 'userRelation'])
                          ->orderBy('created_at', 'desc')
                          ->get();

        return view("projects.index", compact(
            'totalProjects', 
            'activeProjects', 
            'inactiveProjects',
            'projects'
        ));
    }

    public function create()
    {
        $centers = Center::all();
        // $users = User::active()->get();
        $users = User::where("id", 1)->get();        
        return view('projects.create', compact('centers', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:project,commission',
            'center' => 'required|exists:centers,id',
            'user' => 'required|exists:users,id',
            'start' => 'nullable|date',
            'description' => 'required|string|max:255',
            'observations' => 'required|string|max:255',
        ]);

        $validated['is_active'] = true;

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Projecte/comissió creat correctament.');
    }

    public function show(Project $project)
    {
        $project->load(['centerRelation', 'userRelation']);
        return view("projects.show", compact("project"));
    }

    public function edit(Project $project)
    {
        $centers = Center::all();
        // $users = User::active()->get();
        $users = User::where("id", 1)->get();
        return view('projects.edit', compact('project', 'centers', 'users'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:project,commission',
            'center' => 'required|exists:centers,id',
            'user' => 'required|exists:users,id',
            'start' => 'nullable|date',
            'description' => 'required|string|max:255',
            'observations' => 'required|string|max:255',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Projecte/comissió actualitzat correctament.');
    }

    public function destroy(Project $project)
    {
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
}