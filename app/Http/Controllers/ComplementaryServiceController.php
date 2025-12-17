<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\ComplementaryService;
use App\Models\Document;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class ComplementaryServiceController extends Controller
{
    protected $paginateNumber = 21;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complementaryServices = ComplementaryService::orderBy("created_at", "desc")->paginate($this->paginateNumber);
        return view("complementary-services.index", compact("complementaryServices"));
    }

    public function search(Request $request)
    {
        $pagination = "";
        $htmlContent = "";
        // Se obtiene la pagina, sino, se usa la pagina 1
        $page = $request->input("page", 1);
        $searchValue = $request->searchValue;
        $searchComplementaryServices = ComplementaryService::where("name", "like" , "%$searchValue%")->paginate($this->paginateNumber, ["*"], "page", $page);
        if (!empty($searchComplementaryServices)) {
            foreach ($searchComplementaryServices as $complementaryService) {
                $htmlContent .= view("components.complementary-service-card", compact("complementaryService"))->render();
            }
            // Se obtiene la paginacion
            $pagination = $searchComplementaryServices->links()->render();
        }
        return response()->json(["htmlContent" => $htmlContent, "pagination" => $pagination]);
    }
    public function filter(Request $request)
    {
        $page = $request->input("page", 1);
        $order = $request->input("order", null);
        $status = $request->input("status", null);
        $query = ComplementaryService::query();

        // Se obtiene el filtro del estado y se añade a la query
        if ($status == "active") {
            $query->where("is_active", true);
        } elseif ($status == "inactive") {
            $query->where("is_active", false);
        }

        // Se comprueba que tipo de orden se envia y se añade a la query
        switch ($order) {
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
        }

        // Se pagina la query
        $complementaryServices = $query->paginate($this->paginateNumber, ["*"], "page", $page);

        // Lo mismo que con search, se obtienen los cursos que se obtienen en la query
        $htmlContent = "";
        foreach ($complementaryServices as $complementaryService) {
            $htmlContent .= view("components.complementary-service-card", compact("complementaryService"))->render();
        }
        $pagination = $complementaryServices->links()->render();

        return response()->json(["htmlContent" => $htmlContent, "pagination" => $pagination]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(ComplementaryService $complementaryService)
    {
        $complementaryService = new ComplementaryService();
        $centers = Center::all();
        return view("complementary-services.create", compact("complementaryService", "centers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "center_id" => "required|exists:centers,id",
            "type" => "required|string",
            "name" => "required|string",
            "manager_name" => "required|string",
            "manager_email" => "required|string",
            "manager_phone" => "nullable",
            "schedules" => "nullable|string",
            "is_active" => "required|boolean"
        ]);
        $validated["schedules"] = Purifier::clean($validated["schedules"], "quill");
        ComplementaryService::create($validated);

        return redirect()->route("complementary-services.index")->with("success", "Servei complementari creat correctament");
    }

    /**
     * Display the specified resource.
     */
    public function show(ComplementaryService $complementaryService)
    {
        $complementaryServiceDocuments = $complementaryService->documents()->orderBy("created_at", "desc")->get();
        return view("complementary-services.show", compact("complementaryService", "complementaryServiceDocuments"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComplementaryService $complementaryService)
    {
        $centers = Center::all();
        return view("complementary-services.edit", compact("complementaryService", "centers"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ComplementaryService $complementaryService)
    {
        $validated = $request->validate([
            "center_id" => "required|exists:centers,id",
            "type" => "required|string",
            "name" => "required|string",
            "manager_name" => "required|string",
            "manager_email" => "required|string",
            "manager_phone" => "nullable",
            "schedules" => "nullable|string",
            "is_active" => "required|boolean"
        ]);
        $validated["schedules"] = Purifier::clean($validated["schedules"], "quill");
        $complementaryService->update($validated);
        return redirect()->route("complementary-services.index")->with("success", "Servei complementari modificat correctament");
    }
    public function deactivate(ComplementaryService $complementaryService)
    {
        $complementaryService->update(["is_active" => false]);
        return redirect()->route("complementary-services.index")->with("success", "Servei complementari deshabilitat correctament");
    }

    public function activate(ComplementaryService $complementaryService)
    {
        $complementaryService->update(["is_active" => true]);
        return redirect()->route("complementary-services.index")->with("success", "Servei complementari habilitat correctament");
    }

    public function uploadFile(Request $request, ComplementaryService $complementaryService) {
        $validated = $request->validate([
            "type" => "nullable|string|max:255",
            "description" => "nullable|string|max:255",
            "files*" => "required|file|max:20480",
        ]);
        if ($request->hasFile("files")) {
            foreach ($request->file("files") as $file) {
                $modifiedFileName = now()->format('y_m_d') . "_" . $file->getClientOriginalName();
                $path = $file->store("center-documents", "public");
    
                $complementaryService->documents()->create([
                    "name" => $modifiedFileName,
                    "type" => $validated['type'] ?? $file->getMimeType(),
                    "description" => $validated["description"] ?? null,
                    "path" => $path,
                    "user" => auth()->user()->id
                ]);
            }
            return redirect()->route("complementary-services.show", $complementaryService)->with("success", "Fitxers pujats correctament");
        } else{
            return redirect()->route("complementary-services.show", $complementaryService)->with("error", "Has de pujar un fitxer vàlid");
        }
    }
    public function downloadFile($baseName)
    {
        $document = Document::where("path", "like", "%$baseName")->firstOrFail();
        $filePath = storage_path("app/public/" . $document->path);
        if (file_exists($filePath)) {
            return response()->download($filePath, $document->name);
        } else {
            return redirect()->back()->with("error", "El fitxer no existeix.");
        }
    }
}
