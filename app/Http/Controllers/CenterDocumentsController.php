<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;

class CenterDocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Center $center)
    {
        $types = ['Organitzacio_del_Centre', 'Documents_del_Departament', 'Memories_i_Seguiment_anual', 'PRL', 'Comite_d_Empresa', 'Informes_professionals', 'Informes_persones_usuaries', 'Qualitat_i_ISO', 'Projectes', 'Comissions', 'Families', 'Comunicacio_i_Reunions', 'Altres'];
        $documents = $center->documents()
            ->orderBy('created_at', 'desc')
            ->get();
        return view("centers.documents", compact("center", "documents", "types"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Center $center)
    {
        $validated = $request->validate([
            'type' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'documents.*' => 'required|file|max:20480',
        ]);

        if (!$request->hasFile('documents')) {
            return back()->with('error', 'No has pujat cap fitxer');
        }

        foreach ($request->file('documents') as $file) {

            // Guardar archivo en storage/app/public/center-documents
            $path = $file->store('center-documents', 'private');

            // Crear DOCUMENTO usando relación morph
            $center->documents()->create([
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
