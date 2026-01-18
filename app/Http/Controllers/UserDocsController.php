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
        $validated = $request->validate([
            'files.*' => 'required|file|max:20480',
        ]);

        if (!$request->hasFile('files')) {
            return back()->with('error', 'No has pujat cap fitxer');
        }

        foreach ($request->file('files') as $file) {

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
