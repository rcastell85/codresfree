<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(){
        return view('courses.index');
    }

    public function show(Course $course){

        $this->authorize('published', $course);

        $similars = Course::where('category_id', $course->category_id)
                    ->where('id', '!=', $course->id)
                    ->where('status', 3)
                    ->latest('id')
                    ->take(5)
                    ->get();

        return view('courses.show', compact('course', 'similars'));
    }

    public function enrolled(Course $course){

        $course->students()->attach(auth()->user()->id); //Guarda en DB course_user el id del user autentificado con attach()
        
        return redirect(route('courses.status', $course));
    }
}
