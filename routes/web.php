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
    Route::resource("courses", CourseController::class);
    Route::patch("/courses/{course}/deactivate", [CourseController::class, "deactivate"])->name('courses.deactivate');
    Route::patch("/courses/{course}/activate", [CourseController::class, "activate"])->name('courses.activate');
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

    // Comentarios seguimiento profesionales
    Route::post("/users/{user}/trackings/{tracking}/store", [CommentsTrackingController::class, "store"])->name("trackings.comments.store");

});