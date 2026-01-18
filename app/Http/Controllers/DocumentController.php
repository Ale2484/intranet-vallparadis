<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
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
}
