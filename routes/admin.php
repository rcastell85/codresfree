<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;

Route::get('', [HomeController::class, 'index'])->middleware('can:Ver dashboard')->name('home');

Route::resource('roles', RoleController::class)->names('roles');

// Con el metodo 'only' podemos especificar cuales son las rutas que queremos crear en el CRUD
Route::resource('users', UserController::class)->only(['index', 'edit', 'update'])->names('users');

Route::get('courses', [CourseController::class, 'index'])->name('courses.index');