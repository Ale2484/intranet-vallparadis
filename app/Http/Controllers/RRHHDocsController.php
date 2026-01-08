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
            'documents.*' => 'required|file|max:20480',
        ]);

        if (!$request->hasFile('documents')) {
            return back()->with('error', 'No has pujat cap fitxer');
        }

        foreach ($request->file('documents') as $file) {

            // Guardar archivo en storage/app/public/center-documents
            $path = $file->store('rrhh-documents', 'private');

            // Crear DOCUMENTO usando relación morph
            $rrhh->documents()->create([
                'name'        => $file->getClientOriginalName(),
                'type'        => $validated['type'] ?? $file->getMimeType(),
                'description' => $validated['description'] ?? null,
                'path'        => $path,
                'user'        => auth()->id(),
            ]);
        }

        return back()->with('success', 'Documents pujats correctament');
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
