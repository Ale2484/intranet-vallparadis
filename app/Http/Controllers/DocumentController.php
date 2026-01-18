<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function download($baseName)
    {
        $document = Document::where("path", "like", "%$baseName")->firstOrFail();
        $filePath = storage_path("app/private/" . $document->path);
        if (file_exists($filePath)) {
            return response()->download($filePath, $document->name);
        } else {
            return redirect()->back()->with("error", "El fitxer no existeix.");
        }
    }

    public function index(Request $request)
    {
        $query = Document::query();

        $documents = Document::where("documentstable_id", Session::get("active_center_id"))->orderBy("created_at", "desc")->get();
        $viewType = $_COOKIE["view_type"] ?? "card";
        return view("documents.index", compact("documents", "viewType"));
    }

    public function search(Request $request)
    {
        $htmlContent = "";
        $searchValue = $request->searchValue;
        $orderBy = $request->orderBy;
        $status = $request->status;

        $query = Document::query();
        $query->where("documentstable_id", Session::get("active_center_id"));
        if ($searchValue) {
            $query->where("name", "like", "%$searchValue%");
        }

        switch ($orderBy) {
            case "recent-first":
                $query->orderBy("created_at", "desc");
                break;
            case "oldest-first":
                $query->orderBy("created_at", "asc");
                break;
            case "az":
                $query->orderBy("name", "asc");
                break;
            case "za":
                $query->orderBy("name", "desc");
                break;
            case "last-modified":
                $query->orderBy("updated_at", "desc");
                break;
            case "first-modified":
                $query->orderBy("updated_at", "asc");
                break;
            default:
                $query->orderBy("created_at", "desc");
        }

        $documents = $query->get();
        if ($documents->isNotEmpty()) {
            $viewType = $_COOKIE["view_type"] ?? "card";
            if ($viewType == "card") {
                foreach ($documents as $document) {
                    $htmlContent .= view("components.document-card", compact("document"))->render();
                }
            } else{
                foreach ($documents as $document) {
                    $htmlContent .= view("components.document-table", compact("document"))->render();
                }
            }

        }
        return response()->json(["htmlContent" => $htmlContent]);
    }

    public function create()
    {
        $document = new Document();
        return view("documents.create", compact("document"));
    }

    public function store(Request $request)
    {
        $activeCenter = Center::find(Session::get("active_center_id"));
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "type" => "required|in:Organitzacio_del_Centre,Documents_del_Departament,Memories_i_Seguiment_anual,PRL,Comite_d_Empresa,Informes_professionals,Informes_persones_usuaries,Qualitat_i_ISO,Projectes,Comissions,Families,Comunicacio_i_Reunions,Altres",
            "description" => "nullable|string",
            "path" => "required|file|max:20480",
        ]);

        if ($request->hasFile("path")) {
            $file = $request->file("path");
            $path = $file->store("documents", "public");
            $validated["path"] = $path;
        }

        $validated["user"] = auth()->id();

        $activeCenter->documents()->create($validated);
        
        return redirect()->route("documents.index")->with("success", "Document creat correctament" );
    }

    public function show(Document $document)
    {
        return view("documents.show", compact("document"));
    }

    public function edit(Document $document)
    {
        return view("documents.edit", compact("document"));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "type" => "required|in:Organitzacio_del_Centre,Documents_del_Departament,Memories_i_Seguiment_anual,PRL,Comite_d_Empresa,Informes_professionals,Informes_persones_usuaries,Qualitat_i_ISO,Projectes,Comissions,Families,Comunicacio_i_Reunions,Altres",
            "description" => "nullable|string",
            "path" => "nullable|file|max:20480",
        ]);


        $document->update($validated);
        return redirect()->route("documents.index")->with("success", "Document actualitzat correctament");
    }

    public function destroy(Document $document)
    {
        Storage::disk("private")->delete($document->path);
        $document->delete();
        return redirect()->route("documents.index")->with("success", "Document eliminat correctament.");
    }
}
