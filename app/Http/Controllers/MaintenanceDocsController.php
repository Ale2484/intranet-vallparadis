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
                $path = $file->store('maintenance-documents', 'private');

                // Crear DOCUMENTO usando relación morph
                $maintenance->documents()->create([
                    'name'        => $file->getClientOriginalName(),
                    'path'        => $path,
                    'user'        => auth()->id(),
                ]);
            }

            return back()->with('success', 'Documents pujats correctament');
        }
    }
}
