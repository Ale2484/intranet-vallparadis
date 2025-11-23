<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\GeneralService;
use Illuminate\Http\Request;

class GeneralServiceController extends Controller
{
    protected $paginateNumber = 21;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generalServices = GeneralService::orderBy("created_at", "desc")->paginate($this->paginateNumber);

        return view("general-services.index", compact("generalServices"));
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
            "center_id" => "required|exists:centers,id",
            "name" => "required|string",
            "type" => "required|in:cleaning,laundry,cook",
            "manager_name"=> "required|string",
            "manager_email" => "required|email",
            "manager_phone" => "nullable",
            "is_active" => "required|boolean"
        ]);

        GeneralService::create($validated);

        return redirect()->route("general-services.index")->with("success", "Servei creat correctament");
    }

    /**
     * Display the specified resource.
     */
    public function show(GeneralService $generalService)
    {
        $observations = $generalService->observations;
        $schedules = $generalService->schedules ?? [];
        return view("general-services.show", compact("generalService", "observations", "schedules"));
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
            "center_id" => "required|exists:centers,id",
            "name" => "required|string",
            "type" => "required|in:cleaning,laundry,cook",
            "manager_name"=> "required|string",
            "manager_email" => "required|email",
            "manager_phone" => "nullable",
            "is_active" => "required|boolean"
        ]);

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
