<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\GeneralService;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Session;

class GeneralServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = GeneralService::query();
        $status = $request->input("status");
        if ($status == "active") {
            $query->where("is_active", true);
        } elseif ($status == "inactive") {
            $query->where("is_active", false);
        }
        $generalServices = $query->orderBy("created_at", "desc")->get();

        $viewType = $_COOKIE['view_type'] ?? "card";
        return view("general-services.index", compact("generalServices", "viewType"));
    }
    public function search(Request $request)
    {
        $htmlContent = "";
        $searchValue = $request->searchValue;
        $orderBy = $request->orderBy;
        $status = $request->status;

        $query = GeneralService::query();

        if ($searchValue) {
            $query->where("name", "like", "%$searchValue%");
        }

        if ($status == "active") {
            $query->where("is_active", true);
        } elseif ($status == "inactive") {
            $query->where("is_active", false);
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

        $generalServices = $query->get();

        if ($generalServices->isNotEmpty()) {
            $viewType = $_COOKIE['view_type'] ?? "card";
            if ($viewType == "card") {
                foreach ($generalServices as $generalService) {
                    $htmlContent .= view("components.general-services-card", compact("generalService"))->render();
                }
            } else {
                foreach ($generalServices as $generalService) {
                    $htmlContent .= view("components.general-services-table", compact("generalService"))->render();
                }
            }
        }
        return response()->json(["htmlContent" => $htmlContent]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $generalService = new GeneralService();
        $centers = Center::all();
        return view("general-services.create", compact("generalService", "centers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Se validan los datos que se envian por el form de creacion de centro
        $validated = $request->validate([
            "name" => "required|string",
            "type" => "required|in:cuina,neteja,bugaderia",
            "manager_name"=> "required|string",
            "manager_email" => "required|email",
            "manager_phone" => "nullable",
            "staff_and_schedules" => "nullable|string",
            "is_active" => "required|boolean"
        ]);
        $validated["center_id"] = Session::get("active_center_id");

        $validated["staff_and_schedules"] = Purifier::clean($validated["staff_and_schedules"], "quill");
        
        GeneralService::create($validated);

        return redirect()->route("general-services.index")->with("success", "Servei general creat correctament");
    }

    /**
     * Display the specified resource.
     */
    public function show(GeneralService $generalService)
    {
        $observations = $generalService->observations()->orderBy("created_at", "desc")->get();
        return view("general-services.show", compact("generalService", "observations"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GeneralService $generalService)
    {
        $centers = Center::all();
        return view("general-services.edit", compact("generalService", "centers"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GeneralService $generalService)
    {
        $validated = $request->validate([
            "name" => "required|string",
            "type" => "required|in:cuina,neteja,bugaderia",
            "manager_name"=> "required|string",
            "manager_email" => "required|email",
            "manager_phone" => "nullable",
            "staff_and_schedules" => "nullable|string",
            "is_active" => "required|boolean"
        ]);
        $validated["staff_and_schedules"] = Purifier::clean($validated["staff_and_schedules"], "quill");

        $generalService->update($validated);
        return redirect()->route("general-services.index")->with("success", "Servei modificat correctament");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function addObservation(GeneralService $generalService, Request $request)
    {
        $validated = $request->validate(["observation" => "required|min:3"]);
        $generalService->observations()->create(["user_id" => auth()->user()->id, "observation" => $validated["observation"]]);
        return back()->with("success", "Observació creada correctament");
    }
    public function deactivate(GeneralService $generalService)
    {
        $generalService->update(["is_active" => false]);
        return redirect()->route("general-services.index")->with("success", "Servei deshabilitat correctament");
    }

    public function activate(GeneralService $generalService)
    {
        $generalService->update(["is_active" => true]);
        return redirect()->route("general-services.index")->with("success", "Servei habilitat correctament");
    }
}
