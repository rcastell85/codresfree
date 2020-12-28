<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\instructor\CourseController;

Route::redirect('', 'instructor/courses');

Route::resource('courses', CourseController::class)->names('courses');