<?php

namespace App\Http\Controllers;

use App\Models\ExternalContact;
use App\Models\Center;
use Illuminate\Http\Request;

class ExternalContactController extends Controller
{
    public function index(Request $request)
    {
        $query = ExternalContact::query();
        $status = $request->input("status");
        if ($status == "active") {
            $query->where("is_active", true);
        } elseif ($status == "inactive") {
            $query->where("is_active", false);
        }
        $externalContacts = $query->orderBy("created_at", "desc")->get();
        $viewType = $_COOKIE['view_type'] ?? "card";
        return view("external_contacts.index", compact("externalContacts", "viewType"));
    }
    public function search(Request $request)
    {
        $htmlContent = "";
        $searchValue = $request->searchValue;
        $orderBy = $request->orderBy;
        $status = $request->status;

        $query = ExternalContact::query();

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
            default:
                $query->orderBy("created_at", "desc");
        }

        $externalContacts = $query->get();
        if ($externalContacts->isNotEmpty()) {
            $viewType = $_COOKIE['view_type'] ?? "card";
            if ($viewType == "card") {
                foreach ($externalContacts as $externalContact) {
                    $htmlContent .= view("components.external-contact-card", compact("externalContact"))->render();
                }
            } else{
                foreach ($externalContacts as $externalContact) {
                    $htmlContent .= view("components.external-contact-table", compact("externalContact"))->render();
                }
            }

        }
        return response()->json(["htmlContent" => $htmlContent]);
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
            "category" => 'required|in:assistencial,"serveis generals"',
            "reason" => "required|string|max:255",
            "company_or_department" => "required|string|max:255",
            "contact_person" => "required|string|max:255",
            "phone" => "nullable|regex:/^\+\d{2,3}\s?\d{9}$/",
            "email" => "required|email|max:255",
            "observations" => "nullable|string",
            "is_active" => "boolean"
        ]);
        $validated["center_id"] = auth()->user()->center;
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
            "category" => 'required|in:assistencial,"serveis generals"',
            "reason" => "required|string|max:255",
            "company_or_department" => "required|string|max:255",
            "contact_person" => "required|string|max:255",
            "phone" => "nullable|regex:/^\+\d{2,3}\s\d{9}$/",
            "email" => "required|email|max:255",
            "observations" => "nullable|string",
            "is_active" => "boolean"
        ]);
        $validated["center_id"] = auth()->user()->center;
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
