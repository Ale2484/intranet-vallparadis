<?php

namespace App\Http\Controllers;

use App\Models\ExternalContact;
use App\Models\Center;
use Illuminate\Http\Request;

class ExternalContactController extends Controller
{
    protected $paginateNumber = 21;

    public function index()
    {
        $externalContacts = ExternalContact::orderBy("created_at", "desc")->paginate($this->paginateNumber);
        $viewType = $_COOKIE['view_type'] ?? "card";
        return view("external_contacts.index", compact("externalContacts", "viewType"));
    }
    public function search(Request $request)
    {
        $pagination = "";
        $htmlContent = "";
        // Se obtiene la pagina, sino, se usa la pagina 1
        $page = $request->input("page", 1);
        $searchValue = $request->searchValue;
        $searchExternalContacts = ExternalContact::where("contact_person", "like" , "%$searchValue%")->paginate($this->paginateNumber, ["*"], "page", $page);
        if (!empty($searchExternalContacts)) {
            $viewType = $_COOKIE['view_type'] ?? "card";
            if ($viewType == "card") {
                foreach ($searchExternalContacts as $externalContact) {
                    $htmlContent .= view("components.external-contact-card", compact("externalContact"))->render();
                }
            } else{
                foreach ($searchExternalContacts as $externalContact) {
                    $htmlContent .= view("components.external-contact-table", compact("externalContact"))->render();
                }
            }

            // Se obtiene la paginacion
            $pagination = $searchExternalContacts->links()->render();
        }
        return response()->json(["htmlContent" => $htmlContent, "pagination" => $pagination]);
    }

    public function filter(Request $request)
    {
        $page = $request->input("page", 1);
        $order = $request->input("order", null);
        $status = $request->input("status", null);
        $query = ExternalContact::query();

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
                $query->orderBy("contact_person", "asc");
                break;
            case "za":
                $query->orderBy("contact_person", "desc");
                break;
            case "last-modified":
                $query->orderBy("updated_at", "desc");
                break;
            case "first-modified":
                $query->orderBy("updated_at", "asc");
                break;
        }

        // Se pagina la query
        $externalContacts = $query->paginate($this->paginateNumber, ["*"], "page", $page);

        // Lo mismo que con search, se obtienen los cursos que se obtienen en la query
        $htmlContent = "";
        $viewType = $_COOKIE['view_type'] ?? "card";
        if ($viewType == "card") {
            foreach ($externalContacts as $externalContact) {
                $htmlContent .= view("components.external-contact-card", compact("externalContact"))->render();
            }
            
        } else {
            foreach ($externalContacts as $externalContact) {
                $htmlContent .= view("components.external-contact-table", compact("externalContact"))->render();
            }
        }

        $pagination = $externalContacts->links()->render();

        return response()->json(["htmlContent" => $htmlContent, "pagination" => $pagination]);
    }


    public function create()
    {
        $centers = Center::all();
        $externalContact = new ExternalContact();
        return view("external_contacts.create", compact("externalContact", "centers"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "center_id" => "required|exists:centers,id",
            "category" => 'required|in:assistencial,"serveis generals"',
            "reason" => "required|string|max:255",
            "company_or_department" => "required|string|max:255",
            "contact_person" => "required|string|max:255",
            "phone" => "nullable|regex:/^\+\d{2,3}\s?\d{9}$/",
            "email" => "required|email|max:255",
            "observations" => "nullable|string",
            "is_active" => "boolean"
        ]);

        ExternalContact::create($validated);

        return redirect()->route("external-contacts.index")->with("success", "Contacte creat correctament.");
    }

    public function show(ExternalContact $externalContact)
    {
        return view("external_contacts.show", compact("externalContact"));
    }

    public function edit(ExternalContact $externalContact)
    {
        $centers = Center::all();
        return view("external_contacts.edit", compact("externalContact", "centers"));
    }

    public function update(Request $request, ExternalContact $externalContact)
    {
        $validated = $request->validate([
            "center_id" => "required|exists:centers,id",
            "category" => 'required|in:assistencial,"serveis generals"',
            "reason" => "required|string|max:255",
            "company_or_department" => "required|string|max:255",
            "contact_person" => "required|string|max:255",
            "phone" => "nullable|regex:/^\+\d{2,3}\s\d{9}$/",
            "email" => "required|email|max:255",
            "observations" => "nullable|string",
            "is_active" => "boolean"
        ]);

        $externalContact->update($validated);

        return redirect()->route("external-contacts.index")->with("success", "Contacte actualitzat correctament.");
    }
    public function deactivate(ExternalContact $externalContact)
    {
        $externalContact->update(["is_active" => false]);
        return redirect()->route("external-contacts.index")->with("success", "Contacte deshabilitat correctament");
    }

    public function activate(ExternalContact $externalContact)
    {
        $externalContact->update(["is_active" => true]);
        return redirect()->route("external-contacts.index")->with("success", "Contacte habilitat correctament");
    }
}
