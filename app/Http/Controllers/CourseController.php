<?php

namespace App\Http\Controllers;

use App\Exports\CoursesExport;
use App\Models\Center;
use App\Models\Course;
use App\Models\CourseSchedule;
use App\Models\CourseUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;


/**
 * Controlador encargado de gestionar los cursos
 *
 * Permite listar, crear, editar, visualizar y cambiar el estado de los cursos,
 * tambien gestionar sus usuarios, horarios y certificados de los usuarios inscritos
 */
class CourseController extends Controller
{
    /**
     * Se muestran todos los cursos con opcion de filtrar por estado
     * @param Request $request Filtro que se aplica en el estado de los cursos, activos/inativos
     * @return View
     */
    public function index(Request $request)
    {
        $query = Course::query();
        $status = $request->input("status");
        if ($status == "active") {
            $query->where("is_active", true);
        } elseif ($status == "inactive") {
            $query->where("is_active", false);
        }
        $courses = $query->orderBy("created_at", "desc")->get();
        $viewType = $_COOKIE['view_type'] ?? "card";
        return view("courses.index", compact("courses", "viewType"));
    }

    /**
     * Se filtran y ordenan los cursos para devolver el listado de componentes rendereizados
     * @param Request $request Contiene el texto de busqueda, el orden y el estado de los cursos
     * @return JsonResponse
     */
    public function search(Request $request)
    {
        $htmlContent = "";
        $searchValue = $request->searchValue;
        $orderBy = $request->orderBy;
        $status = $request->status;

        $query = Course::query();

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

        $courses = $query->get();

        if ($courses->isNotEmpty()) {
            // Se obtiene el tipo de vista
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
        }
        return response()->json(["htmlContent" => $htmlContent]);
    }

    /**
     * Se muestra el formulario para crear un nuevo curso
     * @return View
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
     * Se crea un nuevo curso con sus usuarios inscritos, horario y su asistente
     * @param Request $request Datos enviados desde el formulario de creacion del curso
     * @return RedirectResponse
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
        $validate["center_id"] = Session::get("active_center_id");
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
     * Se muestra en detalle un curso concreto con sus usuarios y horarios
     * @param Course $course Curso que se intenta visualizar
     * @return View
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
     * Se muestra el formulario para editar un curso existente
     * @param Course $course Curso que se intenta editar
     * @return View
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
     * Se actualizan los datos de un curso existente, incluyendo sus usuarios inscritos, su horario y su asistente
     * @param Request $request Datos enviados desde el formulario de edicion del curso
     * @param Course $course Curso que se intenta actualizar
     * @return RedirectResponse
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

    /**
     * Se muestran todos los usuarios inscritos en un curso y los certificados de cada usuario inscrito
     * @param Course $course Curso del que se intenta visualizar sus usuarios inscritos
     * @return View
     */
    public function showCourseUsers(Course $course)
    {
        $courseUsers = $course->users()->withPivot("certificate")->get();
        return view("courses.users", compact("courseUsers", "course"));
    }

    /**
     * Se marca como entregado el certificado de un usuario en un curso
     * @param Course $course Curso al que pertenece el certificado
     * @param User $user Usuario al que se le entrega el certificado
     * @return RedirectResponse
     */
    public function giveCertificate(Course $course, User $user)
    {
        $courseUser = CourseUser::where("course_id", $course->id)->where( "user_id", $user->id)->firstOrFail();
        if ($courseUser && $courseUser->certificate == "PENDENT") {
            $courseUser->update(["certificate" => "LLIURAT"]);
            return redirect()->route("courses.show", $course)->with("success", "Certificat lliurat correctament");
        } else{
            return back()->with("error", "Error en intentar donar el certificat a l'usuari seleccionat");
        }
    }

    /**
     * Se quita el certificado entregado a un usuario en un curso
     * @param Course $course Curso al que pertenece el certificado
     * @param User $user Usuario al que se le intenta quitar el certificado
     * @return RedirectResponse
     */
    public function removeCertificate(Course $course, User $user)
    {
        $courseUser = CourseUser::where("course_id", $course->id)->where( "user_id", $user->id)->firstOrFail();
        if ($courseUser && $courseUser->certificate == "LLIURAT") {
            $courseUser->update(["certificate" => "PENDENT"]);
            return redirect()->route("courses.show", $course)->with("success", "Certificat retirat correctament");
        } else{
            return back()->with("error", "Error en intentar treure el certificat a l'usuari seleccionat");
        }
    }

    /**
     * Se exportan todos los cursos del sistema a un archivo Excel
     * @return BinaryFileResponse
     */
    public function exportAllCourses()
    {
        return Excel::download(new CoursesExport, "courses.xlsx");
    }

    /**
     * Se desactiva un curso dejandolo como is_active = false
     * @param Course $course Curso que se intenta desactivar
     * @return RedirectResponse
     */
    public function deactivate(Course $course)
    {
        $course->update(["is_active" => false]);
        return redirect()->route("courses.index")->with("success", "Curs deshabilitat correctament");
    }

    /**
     * Se activa un curso dejandolo como is_active = true
     * @param Course $course Curso que se intenta activar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate(Course $course)
    {
        $course->update(["is_active" => true]);
        return redirect()->route("courses.index")->with("success", "Curs habilitat correctament");
    }
}
