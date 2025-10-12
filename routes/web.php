<?php

use App\Http\Controllers\CenterController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
});


Route::resource("centers", CenterController::class);

Route::resource('projects', ProjectController::class);
Route::patch('/projects/{project}/deactivate', [ProjectController::class, 'deactivate'])->name('projects.deactivate');
Route::patch('/projects/{project}/activate', [ProjectController::class, 'activate'])->name('projects.activate');
Route::delete('/project-documents/{document}', [ProjectController::class, 'deleteDocument'])->name('project-documents.destroy');