<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::query();

        $documents = $query->orderBy("created_at", "desc")->get();
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
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "type" => "nullable|string|max:255",
            "description" => "nullable|string",
            "path" => "required|file|max:20480",
            "documentstable_id" => "nullable|integer",
            "documentstable_type" => "nullable|string",
        ]);

        if ($request->hasFile("path")) {
            $file = $request->file("path");
            $path = $file->store("documents", "public");
            $validated["path"] = $path;
        }

        $validated["user"] = auth()->id();

        if ($request->filled("documentstable_id") && $request->filled("documentstable_type")) {
            $documentableType = $validated["documentstable_type"];
            $documentableId = $validated["documentstable_id"];

            if (class_exists($documentableType)) {
                $documentable = $documentableType::findOrFail($documentableId);
                $documentable->documents()->create($validated);
            } else {
                return redirect()->back()->with("error", "El tipus de documentable no es vàlid.");
            }
        } else {
            Document::create($validated);
        }
        
        if ($request->filled("documentstable_id")) {
            return redirect()->back()->with("success", "Document creat correctament.");
        } else {
            return redirect()->route("documents.index")->with("success", "Document creat correctament.");
        }
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
            "type" => "nullable|string|max:255",
            "description" => "nullable|string",
            "path" => "nullable|file|max:20480",
        ]);

        if ($request->hasFile("path")) {
            Storage::disk("public")->delete($document->path);
            $file = $request->file("path");
            $path = $file->store("documents", "public");
            $validated["path"] = $path;
        }

        $document->update($validated);

        if ($document->documentstable_id) {
            return redirect()->back()->with("success", "Document actualitzat correctament.");
        } else {
            return redirect()->route("documents.index")->with("success", "Document actualitzat correctament.");
        }
    }

    public function destroy(Document $document)
    {
        Storage::disk("public")->delete($document->path);
        $document->delete();
        if ($document->documentstable_id) {
            return redirect()->back()->with("success", "Document eliminat correctament.");
        } else {
            return redirect()->route("documents.index")->with("success", "Document eliminat correctament.");
        }
    }

    public function download($path)
    {
        $document = Document::where("path", "like", "%$path")->firstOrFail();
        $filePath = storage_path("app/public/" . $document->path);
        if (file_exists($filePath)) {
            return response()->download($filePath, $document->name);
        } else {
            return redirect()->back()->with("error", "El fitxer no existeix.");
        }
    }
}
