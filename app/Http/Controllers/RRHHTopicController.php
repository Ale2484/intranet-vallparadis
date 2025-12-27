<?php

namespace App\Http\Controllers;

use App\Models\RRHHTopic;
use App\Models\Center;
use App\Models\User;
use Illuminate\Http\Request;

class RRHHTopicController extends Controller
{
    protected $paginateNumber = 21;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rrhhs = RRHHTopic::orderBy("created_at", "desc")->paginate($this->paginateNumber);
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
        return redirect()->route("rrhh.index")->with("success", "Tema pendent deshabilitat correctament");
    }

    public function search(Request $request)
    {
        $pagination = "";
        $htmlContent = "";
        // Se obtiene la pagina, sino, se usa la pagina 1
        $page = $request->input("page", 1);
        $searchValue = $request->searchValue;
        $searchRRHHs = RRHHTopic::where("topic", "like" , "%$searchValue%")->paginate($this->paginateNumber, ["*"], "page", $page);
        if (!empty($searchRRHHs)) {
            foreach ($searchRRHHs as $rrhh) {
                $htmlContent .= view("components.r-r-h-h-card", compact("rrhh"))->render();
            }
            // Se obtiene la paginacion
            $pagination = $searchRRHHs->links()->render();
        }
        return response()->json(["htmlContent" => $htmlContent, "pagination" => $pagination]);
    }

    public function filter(Request $request)
    {
        $page = $request->input("page", 1);
        $order = $request->input("order", null);
        $status = $request->input("status", null);
        $query = RRHHTopic::query();

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
        $rrhhs = $query->paginate($this->paginateNumber, ["*"], "page", $page);

        // Lo mismo que con search, se obtienen los cursos que se obtienen en la query
        $htmlContent = "";
        foreach ($rrhhs as $rrhh) {
            $htmlContent .= view("components.r-r-h-h-card", compact("rrhh"))->render();
        }
        $pagination = $rrhhs->links()->render();

        return response()->json(["htmlContent" => $htmlContent, "pagination" => $pagination]);
    }
}
