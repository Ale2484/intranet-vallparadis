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
        $searchUsers = User::where("name", "like" , "%$request->search%")->get();
        $searchCenters = Center::where("name", "like" , "%$request->search%")->get();
        $searchProjects = Project::where("name", "like" , "%$request->search%")->get();
        $searchCourses = Course::where("name", "like" , "%$request->search%")->get();
        $searchGeneralServices = GeneralService::where("name", "like" , "%$request->search%")->get();
        $searchExternalContacts = ExternalContact::where("contact_person", "like" , "%$request->search%")->get();
        $searchComplementaryServices = ComplementaryService::where("name", "like" , "%$request->search%")->get();
        $searchRrhhs = RRHHTopic::where("topic", "like" , "%$request->search%")->get();
        $searchMaintenances = Maintenance::where("topic", "like" , "%$request->search%")->get();
        $searchDocuments = Document::where("name", "like", "%$request->search%")->where("documentstable_id", Session::get("active_center_id"))->get();

        if ($request->expectsJson()) {
            return response()->json(["Usuaris" => $searchUsers, "Centres" => $searchCenters, "Projectes" =>  $searchProjects, "Cursos" => $searchCourses, "Documents" => $searchDocuments, "Serveis generals" => $searchGeneralServices, "Contactes externs" => $searchExternalContacts, "Serveis complementaris" => $searchComplementaryServices, "Manteniments" => $searchMaintenances, "Temas pendents RRHH" => $searchRrhhs]);
        } elseif ($request->isMethod("get")) {
            return view("search.results", compact("searchUsers", "searchCenters", "searchProjects", "searchCourses", "searchDocuments", "searchGeneralServices", "searchExternalContacts", "searchComplementaryServices", "searchMaintenances", "searchRrhhs"));
        }
    }
}
