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
    public function index()
    {
        $maintenances = Maintenance::orderBy("created_at", "desc")->paginate(21);
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
}