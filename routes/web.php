<?php

use App\Http\Controllers\CenterController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
});


Route::resource("centers", CenterController::class);