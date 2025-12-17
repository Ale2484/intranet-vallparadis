<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DocumentController extends Controller
{
    public function download(Document $document)
    {
        if (Storage::disk("local")->exists($document->file_path)) {
            return Storage::disk("local")->download($document->file_path);
        } else{
            return back()->with("error", "El archivo no existe");
        }
    }
}
