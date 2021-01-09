<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Lesson;
use Livewire\Component;

// WithFileUploads nos ayuda con el procesamiento de imagenes
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class LessonResources extends Component
{
    use WithFileUploads;

    public $lesson, $file;

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }

    public function render()
    {
        return view('livewire.instructor.lesson-resources');
    }

    public function save()
    {
        $this->validate([
            'file' => 'required'
        ]);

        $url = $this->file->store('resources');

        $this->lesson->resource()->create([
            'url' => $url
        ]);

        $this->lesson = Lesson::find($this->lesson->id);
    }

    // Metodo para poder descargar archivo al presionar 'download'
    public function download()
    {
        return response()->download(storage_path('app/public/' . $this->lesson->resource->url));
    }

    public function destroy()
    {
        //Con storage eliminamos la imagen de la carpeta storage
        Storage::delete($this->lesson->resource->url);

        // Luego la eliminamos en la BD
        $this->lesson->resource->delete();

        $this->lesson = Lesson::find($this->lesson->id);
    }
}

