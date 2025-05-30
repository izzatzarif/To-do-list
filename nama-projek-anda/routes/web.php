<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Halaman utama (redirect ke senarai tugasan)
Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

// Semua route CRUD automatik
Route::resource('tasks', TaskController::class);
