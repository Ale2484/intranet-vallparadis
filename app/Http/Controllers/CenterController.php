<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Controlador encargado de gestionar los centros
 *
 * Permite crear, editar, actualizar, y modificar el estado (activo/inactivo)
 * de los centros
 */
class CenterController extends Controller
{
    /**
     * Se muestran todos los centros con opcion de filtrar por estado
     * @param Request $request Filtro que se aplica en el estado de los centros, activos/inativos
     * @return View
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
    
    /**
     * Se filtran y ordenan los centros para devolver el listado de componentes rendereizados
     * @param Request $request Contiene el texto de busqueda, el orden y el estado de los centros
     * @return JsonResponse
     */
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
     * Se muestra el formulario para crear un nuevo centro
     * @return View
     */
    public function create()
    {
        $center = new Center();
        return view("centers.create", compact("center"));
    }

    /**
     * Se crea un nuevo centro a partir de los datos enviados en el formulario de creacion
     * @param Request $request Datos enviados desde el formulario de creacion del centro
     * @return RedirectResponse
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
     * Se muestra en detalle un centro concreto
     * @param Center $center Centro que se intenta mostrar
     * @return View
     */
    public function show(Center $center)
    {
        return view("centers.show", compact("center"));
    }

    /**
     * Se muestra el formulario para editar un centro existente
     * @param Center $center Centro que se intenta editar
     * @return View
     */
    public function edit(Center $center)
    {
        return view("centers.edit", compact("center"));
    }

    /**
     * Se actualizan los datos de un centro existente en el sistema
     * @param Request $request Datos enviados desde el formulario de edicion del centro
     * @param Center $center Centro que se intenta actualizar
     * @return RedirectResponse
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

    /**
     * Se desactiva un centro dejandolo como is_active = false
     * @param Center $center Centro que se intenta desactivar
     * @return RedirectResponse
     */
    public function deactivate(Center $center)
    {
        $center->update(["is_active" => false]);
        return redirect()->route("centers.index")->with("success", "Centre deshabilitat correctament");
    }

    /**
     * Se activa un centro dejandolo como is_active = true
     * @param Center $center Centro que se intenta activar
     * @return RedirectResponse
     */
    public function activate(Center $center)
    {
        $center->update(["is_active" => true]);
        return redirect()->route("centers.index")->with("success", "Centre activat correctament");
    }
}
