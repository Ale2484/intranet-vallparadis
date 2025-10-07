<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UniformityController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/exportAllLockers', [UserController::class, 'exportAllLockers']);
Route::post('/exportLocker',[UserController::class, 'exportLocker'])->name('exportLocker');

Route::get('/exportAllUniformity', [UniformityController::class, 'exportAllUniformity']);
Route::post('/exportUniformity',[UniformityController::class, 'exportUniformity'])->name('exportUniformity');