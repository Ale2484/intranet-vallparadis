<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class ComplementaryServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::all();

        return view("complementary-services.index", compact("documents"));
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            "document" => "nullable|file|mimes:pdf,doc,xlsx,csv,doccx|max:10240"
        ]);

        if ($request->hasFile("document")) {
            $file = $request->file("document");
            $fileName = time() . "_" . $file->getClientOriginalName();
            $filePath = $file->storeAs("documents", $fileName, "local");
            Document::create(["user_id" => auth()->user()->id, "name" => $fileName, "file_path" => $filePath, "type" => "document"]);
            return back()->with("success", "Se sube el documento correctamente");
        } else{
            return back()->with("error", "No se encuentra el documento");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
