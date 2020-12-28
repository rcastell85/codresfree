<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\Lesson;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CourseStatus extends Component
{
    use AuthorizesRequests;

    public $course, $current;

    // Con mount() asignamos a la prop $course el valor del curso que se viene por la ruta
    public function mount(Course $course){
        $this->course = $course;

        foreach($course->lessons as $lesson){
            if(!$lesson->completed){
                $this->current = $lesson;
                break;  
            }
        }

        if (!$this->current) {
            $this->current = $course->lessons->last();
        }

        $this->authorize('enrolled', $course);
    }

    public function render()
    {
        return view('livewire.course-status');
    }

    // Metodos
    public function changeLesson(Lesson $lesson)
    {
        $this->current = $lesson;
    }

    public function completed(){
        if($this->current->completed){
            // Eliminar registro lesson_user
            $this->current->users()->detach(auth()->user()->id);
        } else {
            // Agregar registro lesson_user
            $this->current->users()->attach(auth()->user()->id);
        }

        $this->current = Lesson::find($this->current->id);
        $this->course = Course::find($this->course->id);
    }

    // Propiedades computadas
    public function getIndexProperty()
    {
        /*// Con el metodo PLUCK generamos una nueva collecion en base a las lecciones pero solo con los ids de las mismas, para luego buscarlas en esa collecion
        $lessons_ids = $this->course->lessons->pluck('id');
        // Buscamos en la collecion que se creo, el registro que conicida con la lesson pasada por parametro
        return $lessons_ids->search($this->current->id);*/

        return $this->course->lessons->pluck('id')->search($this->current->id);
    }

    public function getPreviousProperty()
    {
        if ($this->index == 0) {
            return null;
        } else {
            return $this->course->lessons[$this->index - 1];
        }
    }

    public function getNextProperty()
    {
        if ($this->index == $this->course->lessons->count() - 1) {
            return null;
        } else {
            return $this->course->lessons[$this->index + 1];
        }
    }

    public function getAdvanceProperty()
    {
        $i = 0;

        foreach ($this->course->lessons as $lesson) {
            if ($lesson->completed) {
                $i++;
            }
        }

        $advance = ($i * 100) / ($this->course->lessons->count());

        return round($advance, 2);
    }
}
