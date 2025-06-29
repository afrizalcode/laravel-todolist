<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::post('/tasks/{task}/done', [TaskController::class, 'markAsDone'])->name('tasks.done');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');