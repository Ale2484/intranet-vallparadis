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
        $formated_types = ['Organitzacio del Centre', 'Documents del Departament', 'Memories i Seguiment_anual', 'PRL', "Comite d'Empresa",'Informes professionals', 'Informes persones usuaries', 'Qualitat i ISO', 'Projectes', 'Comissions', 'Families', 'Comunicacio i Reunions', 'Altres'];
        $documents = $center->documents()
            ->orderBy('created_at', 'desc')
            ->get();
        return view("centers.documents", compact("center", "documents", "types", "formated_types"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Center $center)
    {
        $validated = $request->validate([
            'type' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);
        if (!$request->hasFile('documents')) {
            return back()->with('error', 'No has pujat cap fitxer / El fitxer no pot pesar més de 2MB');
        } else {
            foreach ($request->file('documents') as $file) {
                if (!$file->isValid() || !in_array($file->extension(), ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'gif', 'txt', 'zip', 'rar'])) {
                    return back()->with('error', 'El fitxer ha de ser un document vàlid.');
                }
                if ($file->getSize() > 2048 * 1024) {
                    return back()->with('error', 'El fitxer no pot pesar més de 2MB.');
                }
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
}
