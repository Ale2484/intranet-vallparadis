<?php

use App\Http\Controllers\CenterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UniformityController;
use App\Http\Controllers\UniformityRenovationController;
use App\Http\Controllers\CommentsTrackingController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\EvaluationController;
use Illuminate\Support\Facades\Auth;



// Al login solo se puede acceder si el usuario no ha iniciado session
Route::middleware("guest")->group(function () {
    Route::get("/login", [UserController::class, "showLoginForm"])->name("login");
    Route::post("/login", [UserController::class, "login"]);
});



Route::middleware("auth")->group(function () {
    
    Route::get('/', function () {
        return view('dashboard');
    })->name("dashboard");

    // Cursos
    // Primero se establece el /courses/exportAll porque sino da problemas con la ruta /courses/show (se supoerpone)
    Route::get("/courses/exportAll", [CourseController::class, "exportAllCourses"])->name('courses.exportAll');
    Route::resource("courses", CourseController::class);
    Route::patch("/courses/{course}/deactivate", [CourseController::class, "deactivate"])->name('courses.deactivate');
    Route::patch("/courses/{course}/activate", [CourseController::class, "activate"])->name('courses.activate');
    Route::get("/courses/{course}/users/", [CourseController::class, "showCourseUsers"])->name('courses.users');
    Route::patch("/courses/{course}/{user}/giveCertificate", [CourseController::class, "giveCertificate"])->name('courses.giveCertificate');
    Route::patch("/courses/{course}/{user}/removeCertificate", [CourseController::class, "removeCertificate"])->name('courses.removeCertificate');
    Route::post("/courses/search", [CourseController::class, "search"])->name("courses.search");
    // Uniformes
    Route::get("/users/{user}/uniformities/edit", [UniformityController::class, "edit"])->name('user.uniformity.edit');
    Route::patch("/users/{user}/uniformities/update", [UniformityController::class, "update"])->name('user.uniformity.update');

    
    //Usuarios
    Route::resource("users", UserController::class);
    Route::patch('/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
    Route::patch('/users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
    Route::post("/users/search", [UserController::class, "search"])->name('users.search');
    Route::post("/logout", [UserController::class, "logout"])->name("users.logout");
    Route::get("/logout", function () {
        if (Auth::check()) {return redirect()->route("dashboard");}
        return redirect()->route("login");
    });
    
    // Centros
    Route::resource("centers", CenterController::class)->except("destroy");
    Route::patch("/centers/{center}/deactivate", [CenterController::class, "deactivate"])->name("centers.deactivate");
    Route::patch("/centers/{center}/activate", [CenterController::class, "activate"])->name("centers.activate");
    Route::post("/centers/search", [CenterController::class, "search"])->name("centers.search");

    // Proyectos  
    Route::resource('projects', ProjectController::class);
    Route::patch('/projects/{project}/deactivate', [ProjectController::class, 'deactivate'])->name('projects.deactivate');
    Route::patch('/projects/{project}/activate', [ProjectController::class, 'activate'])->name('projects.activate');
    Route::post("/projects/search", [ProjectController::class, "search"])->name("projects.search");
    Route::delete('/project-documents/{document}', [ProjectController::class, 'deleteDocument'])->name('project-documents.destroy');

    // Exportacion de taquillas
    Route::get("/exportAllLockers", [UserController::class, "exportAllLockers"])->name("exportAllLockers");
    Route::get("/exportLocker/{userId}", [UserController::class, "exportLocker"])->name("exportLocker");

    // Exportacion de uniformes
    Route::get("/exportAllUniformity", [UniformityController::class, "exportAllUniformity"])->name("exportAllUniformity");
    Route::get("/exportUniformity/{userId}", [UniformityController::class, "exportUniformity"])->name("exportUniformity");

    // Exportacion de uniformes
    Route::get("/exportAllUniformityRenovation", [UniformityRenovationController::class, "exportAllUniformityRenovation"])->name("exportAllUniformityRenovation");
    Route::get("/exportUniformityRenovation/{userId}", [UniformityRenovationController::class, "exportUniformityRenovation"])->name("exportUniformityRenovation");

    // Seguimiento de profesionales
    Route::get("/users/{user}/trackings", [TrackingController::class, "index"])->name("trackings.index");
    Route::get("/users/{user}/trackings/{tracking}", [TrackingController::class, "show"])->name("trackings.show");
    Route::post("/users/{user}/trackings/store", [TrackingController::class, "store"])->name("trackings.store");
    Route::patch('/users/{user}/trackings/{tracking}/deactivate', [TrackingController::class, 'deactivate'])->name('trackings.deactivate');
    

    // Comentarios seguimiento profesionales
    Route::post("/users/{user}/trackings/{tracking}/store", [CommentsTrackingController::class, "store"])->name("trackings.comments.store");

    // Evaluacion de profesionales
    Route::get("/users/{user}/evaluations", [EvaluationController::class, "index"])->name("evaluations.index");
    Route::get("/users/{user}/evaluations/create", [EvaluationController::class, "create"])->name("evaluations.create");
    Route::post("/users/{user}/evaluations/store", [EvaluationController::class, "store"])->name("evaluations.store");
});