<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Center::query();
        
        $status = $request->input("status");
        if ($status == "active") {
            $query->where("is_active", true);
        } elseif ($status == "inactive") {
            $query->where("is_active", false);
        }
        $centers = $query->orderBy("created_at", "desc")->get();

        $viewType = $_COOKIE['view_type'] ?? "card";
        return view("centers.index", compact("centers",  "viewType"));
    }
    
    public function search(Request $request)
    {
        $htmlContent = "";
        $searchValue = $request->searchValue;
        $orderBy = $request->orderBy;
        $status = $request->status;
        $query = Center::query();

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
        $centers = $query->get();

        if ($centers->isNotEmpty()) {
            $viewType = $_COOKIE['view_type'] ?? "card";
            if ($viewType == "card") {
                foreach ($centers as $center) {
                    $htmlContent .= view("components.center-card", compact("center"))->render();
                }
            } else {
                foreach ($centers as $center) {
                    $htmlContent .= view("components.center-table", compact("center"))->render();
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
        $center = new Center();
        return view("centers.create", compact("center"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Se validan los datos que se envian por el form de creacion de centro
        $validated = $request->validate([
            "name" => "required|string",
            "address" => "required|string",
            "phone" => "nullable|string|max:15",
            "email" => "nullable|email|max:255",
            "is_active" => "required|boolean"
        ]);

        Center::create($validated);
        
        return redirect()->route("centers.index")->with("success", "Centre creat correctament");
    }

    /**
     * Display the specified resource.
     */
    public function show(Center $center)
    {
        return view("centers.show", compact("center"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Center $center)
    {
        return view("centers.edit", compact("center"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Center $center)
    {
        $validated = $request->validate([
            "name" => "required|string|max:100",
            "address" => "required|string|max:255",
            "phone" => "nullable|string|max:15",
            "email" => "nullable|email|max:255",
            "is_active" => "required|boolean"

        ]);
        // Si el telefono o el email tiene valores falsos se quedan como null
        $validated["phone"] = $validated["phone"] === "" ? null : $validated["phone"];
        $validated["email"] = $validated["email"] === "" ? null : $validated["email"];

        $center->update($validated);

        return redirect()->route("centers.index")->with("success", "S'ha actualitzat el centre correctament");

    }

    public function deactivate(Center $center)
    {
        $center->update(["is_active" => false]);
        return redirect()->route("centers.index")->with("success", "Centre deshabilitat correctament");
    }

    public function activate(Center $center)
    {
        $center->update(["is_active" => true]);
        return redirect()->route("centers.index")->with("success", "Centre activat correctament");
    }
}
