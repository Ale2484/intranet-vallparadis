<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $courses = Course::all();
        return view("courses.index", compact("courses"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $course = new Course();
        $centers = Center::all();
        $users = User::all();
        $registeredUsers = [];
        return view("courses.create", compact("course", "centers", "users", "registeredUsers"));
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
        Course::create($validate);
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
        // Se obtienen todos los usuarios registrados en el curso
        $registeredUsers = $course->users;
        return view("courses.edit", compact("course", "centers", "users", "registeredUsers"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
