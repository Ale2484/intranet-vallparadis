<?php

use App\Http\Controllers\CenterController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
});


// Centros
Route::resource("centers", CenterController::class)->except("destroy");
Route::patch("/centers/{center}/disable", [CenterController::class, "disable"])->name("centers.disable");
Route::patch("/centers/{center}/enable", [CenterController::class, "enable"])->name("centers.enable");
