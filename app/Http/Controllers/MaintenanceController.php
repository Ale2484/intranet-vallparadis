<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Center;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    protected $paginateNumber = 21;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenances = Maintenance::orderBy("created_at", "desc")->paginate($this->paginateNumber);
        return view("maintenance.index", compact("maintenances"));
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
            "center" => "required|string",
            "topic" => "required|string",
            "responsible" => "required|string",
            "description" => "required|string",
        ]);

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
        return redirect()->route("maintenance.index")->with("success", "Manteniment deshabilitat correctament");
    }

    public function search(Request $request)
    {
        $pagination = "";
        $htmlContent = "";
        // Se obtiene la pagina, sino, se usa la pagina 1
        $page = $request->input("page", 1);
        $searchValue = $request->searchValue;
        $searchMaintenances = Maintenance::where("topic", "like" , "%$searchValue%")->paginate($this->paginateNumber, ["*"], "page", $page);
        if (!empty($searchMaintenances)) {
            foreach ($searchMaintenances as $maintenance) {
                $htmlContent .= view("components.maintenance-card", compact("maintenance"))->render();
            }
            // Se obtiene la paginacion
            $pagination = $searchMaintenances->links()->render();
        }
        return response()->json(["htmlContent" => $htmlContent, "pagination" => $pagination]);
    }

    public function filter(Request $request)
    {
        $page = $request->input("page", 1);
        $order = $request->input("order", null);
        $status = $request->input("status", null);
        $query = Maintenance::query();

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
        }

        // Se pagina la query
        $maintenances = $query->paginate($this->paginateNumber, ["*"], "page", $page);

        // Lo mismo que con search, se obtienen los cursos que se obtienen en la query
        $htmlContent = "";
        foreach ($maintenances as $maintenance) {
            $htmlContent .= view("components.maintenance-card", compact("maintenance"))->render();
        }
        $pagination = $maintenances->links()->render();

        return response()->json(["htmlContent" => $htmlContent, "pagination" => $pagination]);
    }
}