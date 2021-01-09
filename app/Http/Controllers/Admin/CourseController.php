<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 2)->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }
}
