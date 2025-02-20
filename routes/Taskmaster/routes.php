<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TaskMaster\ControllerTaskMaster;

Route::get('/taskmaster', [ControllerTaskMaster::class, 'index'])->middleware(['auth', 'verified'])->name('taskmaster.index');
Route::post('/taskmaster/new-activity', [ControllerTaskMaster::class, 'create'])->middleware(['auth', 'verified'])->name('taskmaster.create');


Route::get('/prueba', [ControllerTaskMaster::class, 'prueba'])->middleware(['auth', 'verified'])->name('prueba.index');
