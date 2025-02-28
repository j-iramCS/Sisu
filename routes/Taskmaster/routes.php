<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TaskMaster\ControllerTaskMaster;
use App\Http\Controllers\TaskMaster\ControllerTeams;


Route::get('/taskmaster/home', [ControllerTaskMaster::class, 'index'])->middleware(['auth', 'verified'])->name('taskmaster.index');
Route::post('/taskmaster/new-activity', [ControllerTaskMaster::class, 'create'])->middleware(['auth', 'verified'])->name('taskmaster.create');


Route::get('/taskmaster/teams', [ControllerTeams::class, 'index'])->middleware(['auth', 'verified'])->name('taskmaster.index.teams');