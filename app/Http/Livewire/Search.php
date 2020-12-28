<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Course;

class Search extends Component
{
    public $search;

    public function render()
    {
        return view('livewire.search');
    }

    //Para el buscador usaremos una propiedad computada(siempre deben empezar con 'get', luego cualquier nombre y terminar con 'Property')
    //Para obtener el resultado de una prop. computada en vista, su obtiene con $this y la palabra del medio('results' en este caso), se obvia 'get' y 'property'
    public function getResultsProperty(){
        return Course::where('title', 'LIKE', '%' . $this->search . '%')
                        ->where('status', 3)
                        ->take(8)
                        ->get();
    }
}
