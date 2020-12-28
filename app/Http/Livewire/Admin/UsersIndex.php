<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    // Con la sig propiedad indicamos que los estilos que queremos usar en la paginacion sean los de bootstrap
    protected $paginationTheme = 'bootstrap';

    public $search;

    public function render()
    {
        $users = User::where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                ->paginate(8);

        return view('livewire.admin.users-index', compact('users'));
    }

    // Este metodo resetea la propiedad 'page' del componente 'WithPagination' para que el buscador funcione en cualquier pagina del paginador
    // Se debe llamar cada vez que se presione un tecla, en el input con la prop 'wire:keydown'
    public function clean_page() {
        $this->reset('page');
    }
}
