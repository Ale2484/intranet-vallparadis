<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\ComplementaryService;
use App\Models\Course;
use App\Models\Document;
use App\Models\ExternalContact;
use App\Models\GeneralService;
use App\Models\Project;
use App\Models\User;
use App\Models\RRHHTopic;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GeneralSearchController extends Controller
{
    public function generalSearch(Request $request)
    {
        $request->validate(["search" => "required"]);
        // Se obtienen los datos de todos los modelos
        $searchUsers = User::where("name", "like" , "%$request->search%")->where("center", Session::get("active_center_id"))->get();
        $searchCenters = auth()->user()->role == "administracio" || auth()->user()->role == "equip_directiu" ? Center::where("name", "like" , "%$request->search%")->get() : collect();
        $searchProjects = Project::where("name", "like" , "%$request->search%")->where("center", Session::get("active_center_id"))->get();
        $searchCourses = Course::where("name", "like" , "%$request->search%")->where("center_id", Session::get("active_center_id"))->get();
        $searchGeneralServices = auth()->user()->role == "administracio" || auth()->user()->role == "equip_directiu" ? GeneralService::where("name", "like" , "%$request->search%")->where("center_id", Session::get("active_center_id"))->get() : collect();
        $searchExternalContacts = ExternalContact::where("contact_person", "like" , "%$request->search%")->where("center_id", Session::get("active_center_id"))->get();
        $searchComplementaryServices = ComplementaryService::where("name", "like" , "%$request->search%")->where("center_id", Session::get("active_center_id"))->get();
        $searchRrhhs = auth()->user()->role == "equip_directiu" ? RRHHTopic::where("topic", "like" , "%$request->search%")->where("center", Session::get("active_center_id"))->get() : collect();
        $searchMaintenances = auth()->user()->role == "administracio" || auth()->user()->role == "equip_directiu" ? Maintenance::where("topic", "like" , "%$request->search%")->where("center", Session::get("active_center_id"))->get() : collect();
        $searchDocuments = Document::where("name", "like", "%$request->search%")->where("documentstable_id", Session::get("active_center_id"))->get();

        if ($request->expectsJson()) {
            return response()->json(["Usuaris" => $searchUsers, "Centres" => $searchCenters, "Projectes" =>  $searchProjects, "Cursos" => $searchCourses, "Documents" => $searchDocuments, "Serveis generals" => $searchGeneralServices, "Contactes externs" => $searchExternalContacts, "Serveis complementaris" => $searchComplementaryServices, "Manteniments" => $searchMaintenances, "Temas pendents RRHH" => $searchRrhhs]);
        } elseif ($request->isMethod("get")) {
            return view("search.results", compact("searchUsers", "searchCenters", "searchProjects", "searchCourses", "searchDocuments", "searchGeneralServices", "searchExternalContacts", "searchComplementaryServices", "searchMaintenances", "searchRrhhs"));
        }
    }
}
