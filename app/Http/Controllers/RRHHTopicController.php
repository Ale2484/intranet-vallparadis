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
    public function index()
    {
        $rrhhs = RRHHTopic::orderBy("created_at", "desc")->paginate(21);
        return view("rrhh.index", compact("rrhhs"));
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
            "center" => "required|string",
            "user_affected" => "required|string",
            "derivative" => "required|string",
            "description" => "required|string",
            "topic" => "required|string",
        ]);
        $validated["user_register"] = auth()->user()->id;


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
        return redirect()->route("rrhh.index")->with("success", "Tema pendent deshabilitat correctament");
    }
}
