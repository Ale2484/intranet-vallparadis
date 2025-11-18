<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $paginateNumber = 21;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy("created_at", "desc")->paginate($this->paginateNumber);

        return view("services.index", compact("services"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $service = new Service();
        $centers = Center::all();
        return view("services.create", compact("service", "centers"));
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
}
