<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Center;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Maintenance::query();
        $status = $request->input("status");
        if ($status == "active") {
            $query->where("is_active", true);
        } elseif ($status == "inactive") {
            $query->where("is_active", false);
        }
        $viewType = $_COOKIE['view_type'] ?? "card";
        $maintenances = $query->orderBy("created_at", "desc")->get();
        return view("maintenance.index", compact("maintenances", "viewType"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centers = Center::all();
        return view("maintenance.create", compact(
            "centers",
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "topic" => "required|string",
            "responsible" => "required|string",
            "description" => "required|string",
        ]);
        $validated["center"] = auth()->user()->center;
        Maintenance::create($validated);
        
        return redirect()->route("maintenance.index")->with("success", "Manteniment creat correctament");
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        return view("maintenance.show", compact("maintenance"));
    }

    public function deactivate(Maintenance $maintenance)
    {
        $maintenance->update(["is_active" => false]);
        return redirect()->route("maintenance.index")->with("success", "Manteniment deshabilitat correctament");
    }

    public function activate(Maintenance $maintenance)
    {
        $maintenance->update(["is_active" => true]);
        return redirect()->route("maintenance.index")->with("success", "Manteniment activat correctament");
    }

    public function search(Request $request)
    {
        $htmlContent = "";
        $searchValue = $request->searchValue;
        $orderBy = $request->orderBy;
        $status = $request->status;
        $query = Maintenance::query();

        if ($searchValue) {
            $query->where("topic", "like", "%$searchValue%");
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
                $query->orderBy("topic", "asc");
                break;
            case "za":
                $query->orderBy("topic", "desc");
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
        $maintenances = $query->get();

        if ($maintenances->isNotEmpty()) {
            $viewType = $_COOKIE['view_type'] ?? "card";
            if ($viewType == "card") {
                foreach ($maintenances as $maintenance) {
                    $htmlContent .= view("components.maintenance", compact("maintenance"))->render();
                }
            } else {
                foreach ($maintenances as $maintenance) {
                    $htmlContent .= view("components.maintenance", compact("maintenance"))->render();
                }
            }
        }
        return response()->json(["htmlContent" => $htmlContent]);
    }

    // public function filter(Request $request)
    // {
    //     $order = $request->input("order", null);
    //     $status = $request->input("status", null);
    //     $query = Maintenance::query();

    //     // Se obtiene el filtro del estado y se añade a la query
    //     if ($status == "active") {
    //         $query->where("is_active", true);
    //     } elseif ($status == "inactive") {
    //         $query->where("is_active", false);
    //     }

    //     // Se comprueba que tipo de orden se envia y se añade a la query
    //     switch ($order) {
    //         case "recent-first":
    //             $query->orderBy("created_at", "desc");
    //             break;
    //         case "oldest-first":
    //             $query->orderBy("created_at", "asc");
    //             break;
    //         case "az":
    //             $query->orderBy("topic", "asc");
    //             break;
    //         case "za":
    //             $query->orderBy("topic", "desc");
    //             break;
    //         case "last-modified":
    //             $query->orderBy("updated_at", "desc");
    //             break;
    //         case "first-modified":
    //             $query->orderBy("updated_at", "asc");
    //             break;
    //     }

    //     $maintenances = $query->get();

    //     // Lo mismo que con search, se obtienen los cursos que se obtienen en la query
    //     $htmlContent = "";
    //     foreach ($maintenances as $maintenance) {
    //         $htmlContent .= view("components.maintenance-card", compact("maintenance"))->render();
    //     }

    //     return response()->json(["htmlContent" => $htmlContent]);
    // }
}