<?php

use App\Http\Controllers\CenterController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('dashboard');
})->name("dashboard");

// Al login solo se puede acceder si el usuario no ha iniciado session
Route::middleware("guest")->group(function () {
    Route::get("/login", [UserController::class, "showLoginForm"])->name("login");
    Route::post("/login", [UserController::class, "login"]);
});

Route::middleware("auth")->group(function () {
    //Usuarios
    Route::resource("users", UserController::class);
    Route::patch('/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
    Route::patch('/users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
    
    // Centros
    Route::resource("centers", CenterController::class)->except("destroy");
    Route::patch("/centers/{center}/disable", [CenterController::class, "disable"])->name("centers.disable");
    Route::patch("/centers/{center}/enable", [CenterController::class, "enable"])->name("centers.enable");
    
    // proyectos  
    Route::resource('projects', ProjectController::class);
    Route::patch('/projects/{project}/deactivate', [ProjectController::class, 'deactivate'])->name('projects.deactivate');
    Route::patch('/projects/{project}/activate', [ProjectController::class, 'activate'])->name('projects.activate');
    Route::delete('/project-documents/{document}', [ProjectController::class, 'deleteDocument'])->name('project-documents.destroy');

});