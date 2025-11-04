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
    public function index()
    {
        $centers = Center::all();
        $inactiveCenters = $centers->where("is_active", false)->count();
        $activeCenters = $centers->count() - $inactiveCenters;

        $activePercentage = ($activeCenters / $centers->count()) * 100; 
        $inactivePercentage = ($inactiveCenters / $centers->count()) * 100;
       
        $activePercentage = round($activePercentage, 1);
        $inactivePercentage = round($inactivePercentage, 1);
        

        return view("centers.index", compact("centers", "inactiveCenters", "activeCenters", "activePercentage", "inactivePercentage"));
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
            "phone"=> "required|max:9",
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
        return redirect()->route("centers.index")->with("success", "Centre deshabilitat correctament");
    }
}
