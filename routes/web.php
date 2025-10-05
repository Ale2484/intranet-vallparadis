<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;



// Al login solo se puede acceder si el usuario no ha iniciado session
Route::middleware("guest")->group(function () {
    Route::get("/login", [UserController::class, "showLoginForm"])->name("login");
    Route::post("/login", [UserController::class, "login"]);
});