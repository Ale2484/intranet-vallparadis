<?php

use App\Http\Controllers\CenterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource("users", UserController::class);
Route::patch('/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
Route::patch('/users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');

// Centros
Route::resource("centers", CenterController::class)->except("destroy");
Route::patch("/centers/{center}/disable", [CenterController::class, "disable"])->name("centers.disable");
Route::patch("/centers/{center}/enable", [CenterController::class, "enable"])->name("centers.enable");
