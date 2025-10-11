<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource("users", UserController::class);
Route::patch('/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
Route::patch('/users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');