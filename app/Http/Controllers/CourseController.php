<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Course;
use App\Models\CourseSchedule;
use App\Models\CourseUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::orderBy("created_at", "asc")->paginate(20);
        return view("courses.index", compact("courses"));
    }

    public function search(Request $request)
    {
        $pagination = "";
        $htmlContent = "";
        // Se obtiene la pagina, sino, se usa la pagina 1
        $page = $request->input("page", 1);
        $searchValue = $request->searchValue;
        $searchCourses = Course::where("name", "like" , "%$searchValue%")->paginate(20, ["*"], "page", $page);
        if (!empty($searchCourses)) {
            foreach ($searchCourses as $course) {
                $htmlContent .= view("components.course-card", compact("course"))->render();
            }
            // Se obtiene la paginacion
            $pagination = $searchCourses->links()->render();
        }
        return response()->json(["htmlContent" => $htmlContent, "pagination" => $pagination]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $course = new Course();
        $centers = Center::all();
        $users = User::all();
        $daysOfWeek = ["Dilluns", "Dimarts", "Dimecres", "Dijous", "Divendres", "Disabte", "Diumenge"];
        // Se pasa el registeredUsers a coleccion porque sino cuando se usan algunos metodos especificos da problemas
        $registeredUsers = collect([]);
        return view("courses.create", compact("course", "centers", "users", "registeredUsers", "daysOfWeek"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "center_id" => "required|exists:centers,id",
            "code" => "required|string",
            "hours" => "required|numeric",
            "type" => "required|string",
            "modality" => "required|string",
            "name" => "required|string",
            "description" => "nullable",
            "start_date" => "required|date",
            "end_date" => "required|date",
            "assistant" => "required|exists:users,id",
            "is_active" => "required|boolean",
        ]);
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
        $usersPreview = $course->users()->limit(4)->get();
        $totalUsers = $course->users;
        $schedules = $course->schedule;
        return view("courses.show", compact("course", "usersPreview", "totalUsers", "schedules"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $centers = Center::all();
        $users = User::all();
        $daysOfWeek = ["Dilluns", "Dimarts", "Dimecres", "Dijous", "Divendres", "Disabte", "Diumenge"];
        $schedules = $course->schedule()->get()->keyBy('day_of_week')->toArray();

        // Se obtienen todos los usuarios registrados en el curso
        $registeredUsers = $course->users;
        return view("courses.edit", compact("course", "centers", "users", "registeredUsers", "daysOfWeek", "schedules"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validate = $request->validate([
            "center_id" => "required|exists:centers,id",
            "code" => "required|string",
            "hours" => "required|numeric",
            "type" => "required|string",
            "modality" => "required|string",
            "name" => "required|string",
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
        return redirect()->route("courses.index")->with("success", "Curs creat correctament");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function deactivate(Course $course)
    {
        $course->update(["is_active" => false]);
        return redirect()->route("courses.index")->with("success", "Curs deshabilitat correctament");
    }

    public function activate(Course $course)
    {
        $course->update(["is_active" => true]);
        return redirect()->route("courses.index")->with("success", "Curs deshabilitat correctament");
    }
}
