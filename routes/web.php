<?php

use App\Http\Controllers\CenterController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UniformityController;
use App\Http\Controllers\UniformityRenovationController;





// Al login solo se puede acceder si el usuario no ha iniciado session
Route::middleware("guest")->group(function () {
    Route::get("/login", [UserController::class, "showLoginForm"])->name("login");
    Route::post("/login", [UserController::class, "login"]);
});

Route::middleware("auth")->group(function () {
    
    Route::get('/', function () {
        return view('dashboard');
    })->name("dashboard");

    // Uniformes
    Route::get("/users/{user}/uniformities/edit", [UniformityController::class, "edit"])->name('user.uniformity.edit');
    Route::patch("/users/{user}/uniformities/update", [UniformityController::class, "update"])->name('user.uniformity.update');


    
    //Usuarios
    Route::resource("users", UserController::class);
    Route::patch('/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
    Route::patch('/users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
    
    // Centros
    Route::resource("centers", CenterController::class)->except("destroy");
    Route::patch("/centers/{center}/disable", [CenterController::class, "disable"])->name("centers.disable");
    Route::patch("/centers/{center}/enable", [CenterController::class, "enable"])->name("centers.enable");
    
    // Proyectos  
    Route::resource('projects', ProjectController::class);
    Route::patch('/projects/{project}/deactivate', [ProjectController::class, 'deactivate'])->name('projects.deactivate');
    Route::patch('/projects/{project}/activate', [ProjectController::class, 'activate'])->name('projects.activate');
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


});