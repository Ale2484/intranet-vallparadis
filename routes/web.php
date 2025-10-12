<?php

use App\Http\Controllers\CenterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UniformityController;
use App\Http\Controllers\UniformityRenovationController;


Route::get("/", function () {
    return view("dashboard");
});

// Exportacion de taquillas
Route::get("/exportAllLockers", [UserController::class, "exportAllLockers"]);
Route::post("/exportLocker", [UserController::class, "exportLocker"])->name("exportLocker");

// Exportacion de uniformes
Route::get("/exportAllUniformity", [UniformityController::class, "exportAllUniformity"]);
Route::post("/exportUniformity", [UniformityController::class, "exportUniformity"])->name("exportUniformity");

// Exportacion de uniformes
Route::get("/exportAllUniformityRenovation", [UniformityRenovationController::class, "exportAllUniformityRenovation"]);
Route::get("/exportUniformityRenovations/{userId}", [UniformityRenovationController::class, "exportUniformityRenovation"])->name("exportUniformityRenovation");


// Centros
Route::resource("centers", CenterController::class)->except("destroy");
Route::patch("/centers/{center}/disable", [CenterController::class, "disable"])->name("centers.disable");
Route::patch("/centers/{center}/enable", [CenterController::class, "enable"])->name("centers.enable");
