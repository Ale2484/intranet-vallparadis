<?php

namespace App\Http\Controllers;

use App\Models\RRHHTopic;
use App\Models\Center;
use App\Models\User;
use Illuminate\Http\Request;

class RRHHTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = RRHHTopic::query();
        $status = $request->input("status");
        if ($status == "active") {
            $query->where("is_active", true);
        } elseif ($status == "inactive") {
            $query->where("is_active", false);
        }
        $viewType = $_COOKIE['view_type'] ?? "card";
        $rrhhs = $query->orderBy("created_at", "desc")->get();
        return view("rrhh.index", compact("rrhhs", "viewType"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centers = Center::all();
        $users = User::all();
        return view("rrhh.create", compact(
            "centers",
            "users"
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "user_affected" => "required|string",
            "derivative" => "required|string",
            "description" => "required|string",
            "topic" => "required|string",
        ]);
        $validated["user_register"] = auth()->user()->id;
        $validated["center"] = auth()->user()->center;


        RRHHTopic::create($validated);
        
        return redirect()->route("rrhh.index")->with("success", "Tema pendent creat correctament");
    }

    /**
     * Display the specified resource.
     */
    public function show(RRHHTopic $rrhh)
    {
        return view("rrhh.show", compact("rrhh"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RRHHTopic $rRHHTopic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RRHHTopic $rRHHTopic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RRHHTopic $rRHHTopic)
    {
        //
    }

    public function deactivate(RRHHTopic $rrhh)
    {
        $rrhh->update(["is_active" => false]);
        return redirect()->route("rrhh.index")->with("success", "Tema pendent deshabilitat correctament");
    }

    public function activate(RRHHTopic $rrhh)
    {
        $rrhh->update(["is_active" => true]);
        return redirect()->route("rrhh.index")->with("success", "Tema pendent activat correctament");
    }

    public function search(Request $request)
    {
        $htmlContent = "";
        $searchValue = $request->searchValue;
        $orderBy = $request->orderBy;
        $status = $request->status;
        $query = RRHHTopic::query();

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
        $rrhhs = $query->get();

        if ($rrhhs->isNotEmpty()) {
            $viewType = $_COOKIE['view_type'] ?? "card";
            if ($viewType == "card") {
                foreach ($rrhhs as $rrhh) {
                    $htmlContent .= view("components.r-r-h-h-card", compact("rrhh"))->render();
                }
            } else {
                foreach ($rrhhs as $rrhh) {
                    $htmlContent .= view("components.r-r-h-h-table", compact("rrhh"))->render();
                }
            }
        }
        return response()->json(["htmlContent" => $htmlContent]);
    }

    // public function filter(Request $request)
    // {
    //     $order = $request->input("order", null);
    //     $status = $request->input("status", null);
    //     $query = RRHHTopic::query();

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

    //     $rrhhs = $query->get();

    //     $htmlContent = "";
    //     foreach ($rrhhs as $rrhh) {
    //         $htmlContent .= view("components.r-r-h-h-card", compact("rrhh"))->render();
    //     }

    //     return response()->json(["htmlContent" => $htmlContent]);
    // }
}
