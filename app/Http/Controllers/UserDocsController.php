<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserDocsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {

        $documents = $user->documents()
            ->orderBy('created_at', 'desc')
            ->get();
        return view("users.documents", compact("user", "documents"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        if (!$request->hasFile('files')) {
            return back()->with('error', 'No has pujat cap fitxer / El fitxer no pot pesar més de 2MB');
        } else {
            foreach ($request->file('files') as $file) {
                if (!$file->isValid() || !in_array($file->extension(), ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'gif', 'txt', 'zip', 'rar'])) {
                    return back()->with('error', 'El fitxer ha de ser un document vàlid.');
                }
                if ($file->getSize() > 2048 * 1024) { // 2MB limit
                    return back()->with('error', 'El fitxer no pot pesar més de 2MB.');
                }
                // Guardar archivo en storage/app/public/user-documents
                $path = $file->store('user-documents', 'private');
                // Crear DOCUMENTO usando relación morph
                $user->documents()->create([
                    'name'        => $file->getClientOriginalName(),
                    'path'        => $path,
                    'user'        => auth()->id(),
                ]);
            }
            return back()->with('success', 'Documents pujats correctament');

        }

    }
}
