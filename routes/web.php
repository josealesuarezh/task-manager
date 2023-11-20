<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('tasks');
});

Route::patch('tasks/{task}/reorder', [\App\Http\Controllers\TaskController::class, 'reorder']);
Route::resource('tasks', \App\Http\Controllers\TaskController::class);
Route::resource('projects', \App\Http\Controllers\TaskController::class);
