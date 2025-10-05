<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showLoginForm()
    {
        $centers = Center::all();
        return view("auth.login", compact("centers"));
    }

    public function login(Request $request)
    {
        $request->validate([
            "center" => "required|exists:centers,id",
            "email" => "required",
            "password" => "required"
        ]);

        if(Auth::attempt(["email" => $request->email, "password" => $request->password])){
            return redirect()->route("dashboard");
        } else{
            dd("Login fallido");
        }
    }
}
