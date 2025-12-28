<?php

namespace App\Http\Controllers;

use App\Exports\CoursesExport;
use App\Models\Center;
use App\Models\Course;
use App\Models\CourseSchedule;
use App\Models\CourseUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class CourseController extends Controller
{
    protected $paginateNumber = 21;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::orderBy("created_at", "desc")->paginate($this->paginateNumber);
        $viewType = $_COOKIE['view_type'] ?? "card";
        return view("courses.index", compact("courses", "viewType"));
    }

    public function search(Request $request)
    {
        $pagination = "";
        $htmlContent = "";
        // Se obtiene la pagina, sino, se usa la pagina 1
        $page = $request->input("page", 1);
        $searchValue = $request->searchValue;
        $searchCourses = Course::where("name", "like" , "%$searchValue%")->paginate($this->paginateNumber, ["*"], "page", $page);
        if (!empty($searchCourses)) {
            // Se obtiene el tipo de vista
            $viewType = $_COOKIE['view_type'] ?? "card";

            if ($viewType == "card") {
                foreach ($searchCourses as $course) {
                    $htmlContent .= view("components.course-card", compact("course"))->render();
                }
            } else{
                foreach ($searchCourses as $course) {
                    $htmlContent .= view("components.course-table", compact("course"))->render();
                }
            }
            // Se obtiene la paginacion
            $pagination = $searchCourses->links()->render();
        }
        return response()->json(["htmlContent" => $htmlContent, "pagination" => $pagination]);
    }

    public function filter(Request $request)
    {
        $page = $request->input("page", 1);
        $order = $request->input("order", null);
        $status = $request->input("status", null);
        $query = Course::query();

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
        }

        // Se pagina la query
        $courses = $query->paginate($this->paginateNumber, ["*"], "page", $page);

        // Lo mismo que con search, se obtienen los cursos que se obtienen en la query
        $htmlContent = "";
        $viewType = $_COOKIE['view_type'] ?? "card";
        if ($viewType == "card") {
            foreach ($courses as $course) {
                $htmlContent .= view("components.course-card", compact("course"))->render();
            }
        } else{
            foreach ($courses as $course) {
                $htmlContent .= view("components.course-table", compact("course"))->render();
            }
        }
        $pagination = $courses->links()->render();

        return response()->json(["htmlContent" => $htmlContent, "pagination" => $pagination]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $course = new Course();
        $users = User::all();
        $daysOfWeek = ["Dilluns", "Dimarts", "Dimecres", "Dijous", "Divendres", "Dissabte", "Diumenge"];
        // Se pasa el registeredUsers a coleccion porque sino cuando se usan algunos metodos especificos da problemas
        $registeredUsers = collect([]);
        return view("courses.create", compact("course", "users", "registeredUsers", "daysOfWeek"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "name" => "required|string",
            "code" => "required|string",
            "hours" => "required|numeric",
            "type" => "required|string",
            "modality" => "required|string",
            "description" => "nullable",
            "start_date" => "required|date",
            "end_date" => "required|date",
            "assistant" => "required|exists:users,id",
            "is_active" => "required|boolean",
        ]);
        $validate["center_id"] = auth()->user()->center;
        // Se crea el curso
        $newCourse = Course::create($validate);

        if (!empty($request->userIds)) {
            // Se crean los registros de los usuarios que se inscriben al curso
            $userIds = explode(",", $request->userIds);
            $registeredUsers = [];
            foreach ($userIds as $userId) {
                $registeredUsers[] = [
                    "user_id" => $userId,
                    "course_id" => $newCourse->id,
                    "certificate" => "PENDENT",
                ];
            }
            if (!empty($registeredUsers)) {
                DB::table("course_users")->insert($registeredUsers);
            }
        }
        // Se crea el horario
        if (!empty($request->schedules)) {
            foreach ($request->schedules as $day => $times) {
                if (isset($times["start_time"]) && isset($times["end_time"])) {
                    // Se pasa el formato a Horas:Minutos
                    $times["start_time"] =  \Carbon\Carbon::parse($times["start_time"])->format("H:i");
                    $times["end_time"] =  \Carbon\Carbon::parse($times["end_time"])->format("H:i");
                    CourseSchedule::create(["course_id" => $newCourse->id, "day_of_week" => $day, "start_time" => $times["start_time"], "end_time" => $times["end_time"]]);
                }
            }
        }
        
        return redirect()->route("courses.index")->with("success", "Curs creat correctament");

    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        if ($course->modality == "presential") {
            $course->modality = "Presencial";
        } elseif ($course->modality == "mixed") {
            $course->modality = "Mixte";
        } elseif ($course->modality == "online") {
            $course->modality = "Online";
        }
        $usersPreview = $course->users()->withPivot('certificate')->limit(4)->get();
        $totalUsers = $course->users;
        $schedules = $course->schedule;
        return view("courses.show", compact("course", "usersPreview", "totalUsers", "schedules"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $users = User::all();
        $daysOfWeek = ["Dilluns", "Dimarts", "Dimecres", "Dijous", "Divendres", "Dissabte", "Diumenge"];
        $schedules = $course->schedule()->get()->keyBy('day_of_week')->toArray();

        // Se obtienen todos los usuarios registrados en el curso
        $registeredUsers = $course->users;
        return view("courses.edit", compact("course", "users", "registeredUsers", "daysOfWeek", "schedules"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validate = $request->validate([
            "name" => "required|string",
            "code" => "required|string",
            "hours" => "required|numeric|max:90000.99",
            "type" => "required|string",
            "modality" => "required|string",
            "description" => "nullable",
            "start_date" => "required|date",
            "end_date" => "required|date",
            "assistant" => "required|exists:users,id",
            "is_active" => "required|boolean",
        ]);
        $validate["center_id"] = auth()->user()->center;

        $course->update($validate);
        
        // Se obtienen los usuarios pasados en la request incluyendo los usuarios que ya estaban inscritos en el curso
        $userIds = !empty($request->userIds) ? explode(",", $request->userIds) : [];
        // Se obtienen los usuarios inscritos al curso
        $registeredUsers = $course->users->pluck("id")->toArray();
        
        if (!empty($userIds)) {
            // Se obtienen SOLO los nuevos usuarios que se han pasado en el formulario
            $newRegisteredUsersId = array_diff($userIds, $registeredUsers);
            if (!empty($newRegisteredUsersId)) {
                $newRegisteredUsers = [];
                foreach ($newRegisteredUsersId as $newUserId) {
                    $newRegisteredUsers[] = [
                        "user_id" => $newUserId,
                        "course_id" => $course->id,
                        "certificate" => "PENDENT",
                    ];
                } 
                // Se insertan los registros de los nuevos usuarios
                DB::table("course_users")->insert($newRegisteredUsers);
            }
        }
        // Se obtienen los usuarios que no se han enviado en el formulario pero estaban inscritos al curso
        $deletedRegisteredUsers = array_diff($registeredUsers, $userIds);
        if (!empty($deletedRegisteredUsers)) {
            CourseUser::where("course_id", $course->id)->whereIn("user_id", $deletedRegisteredUsers)->delete();
        }
        
        // Actualizacion de horario
        if (!empty($request->schedules)) {
            foreach ($request->schedules as $day => $times) {
                if (isset($times["start_time"]) && isset($times["end_time"])) {
                    $editDay = CourseSchedule::where("course_id", $course->id)->where("day_of_week", $day)->first();
                    // Si el registro existia previamente se modifica, sino se crea uno nuevo
                    if (isset($editDay)) {
                        $editDay->update(["start_time" => $times["start_time"], "end_time" => $times["end_time"]]);
                    } else{
                        CourseSchedule::create(["course_id" => $course->id, "day_of_week" => $day, "start_time" => $times["start_time"], "end_time" => $times["end_time"]]);
                    }
                }
            }
        }
        return redirect()->route("courses.index")->with("success", "Curs modificat correctament");
    }

    // Metodo que muestra todos los usuarios que pertenecen a un curso
    public function showCourseUsers(Course $course)
    {
        $courseUsers = $course->users()->withPivot("certificate")->get();
        return view("courses.users", compact("courseUsers", "course"));
    }


    public function giveCertificate(Course $course, User $user)
    {
        $courseUser = CourseUser::where("course_id", $course->id)->where( "user_id", $user->id)->firstOrFail();
        if ($courseUser && $courseUser->certificate == "PENDENT") {
            $courseUser->update(["certificate" => "ENTREGAT"]);
            return redirect()->route("courses.show", $course)->with("success", "Certificat lliurat correctament");
        } else{
            return back()->with("error", "Error en intentar donar el certificat a l'usuari seleccionat");
        }
    }
    public function removeCertificate(Course $course, User $user)
    {
        $courseUser = CourseUser::where("course_id", $course->id)->where( "user_id", $user->id)->firstOrFail();
        if ($courseUser && $courseUser->certificate == "ENTREGAT") {
            $courseUser->update(["certificate" => "PENDENT"]);
            return redirect()->route("courses.show", $course)->with("success", "Certificat tret correctament");
        } else{
            return back()->with("error", "Error en intentar treure el certificat a l'usuari seleccionat");
        }
    }

    public function exportAllCourses()
    {
        return Excel::download(new CoursesExport, "courses.xlsx");
    }

    public function deactivate(Course $course)
    {
        $course->update(["is_active" => false]);
        return redirect()->route("courses.index")->with("success", "Curs deshabilitat correctament");
    }

    public function activate(Course $course)
    {
        $course->update(["is_active" => true]);
        return redirect()->route("courses.index")->with("success", "Curs habilitat correctament");
    }
}
