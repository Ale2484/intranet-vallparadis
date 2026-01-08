<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceDocsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Maintenance $maintenance)
    {

        $documents = $maintenance->documents()
            ->orderBy('created_at', 'desc')
            ->get();
        return view("maintenance.documents", compact("maintenance", "documents"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate([
            'documents.*' => 'required|file|max:20480',
        ]);

        if (!$request->hasFile('documents')) {
            return back()->with('error', 'No has pujat cap fitxer');
        }

        foreach ($request->file('documents') as $file) {

            // Guardar archivo en storage/app/public/center-documents
            $path = $file->store('maintenance-documents', 'private');

            // Crear DOCUMENTO usando relación morph
            $maintenance->documents()->create([
                'name'        => $file->getClientOriginalName(),
                'type'        => $validated['type'] ?? $file->getMimeType(),
                'description' => $validated['description'] ?? null,
                'path'        => $path,
                'user'        => auth()->id(),
            ]);
        }

        return back()->with('success', 'Documents pujats correctament');
    }
}
