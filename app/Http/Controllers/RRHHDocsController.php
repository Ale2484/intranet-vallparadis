<?php

namespace App\Http\Controllers;

use App\Models\RRHHTopic;
use Illuminate\Http\Request;

class RRHHDocsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RRHHTopic $rrhh)
    {

        $documents = $rrhh->documents()
            ->orderBy('created_at', 'desc')
            ->get();
        return view("rrhh.documents", compact("rrhh", "documents"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, RRHHTopic $rrhh)
    {
        $validated = $request->validate([
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
                $path = $file->store('rrhh-documents', 'private');

                // Crear DOCUMENTO usando relación morph
                $rrhh->documents()->create([
                    'name'        => $file->getClientOriginalName(),
                    'description' => $validated['description'] ?? null,
                    'path'        => $path,
                    'user'        => auth()->id(),
                ]);
            }

            return back()->with('success', 'Documents pujats correctament');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RRHHTopic $rRHHTopic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RRHHTopic $rRHHTopic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RRHHTopic $rRHHTopic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RRHHTopic $rRHHTopic)
    {
        //
    }
}
