<?php

use App\Http\Controllers\CenterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource("centers", CenterController::class);