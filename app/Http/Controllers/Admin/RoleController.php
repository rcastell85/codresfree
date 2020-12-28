<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        // Pasamos middlewares con el constructor de la siguiente manera: middleware('nombre permiso')->only('metodo al que le queeremos aplicar este middlewarew')
        $this->middleware('can:Listar rol')->only('index');
        $this->middleware('can:Crear rol')->only('create', 'store');
        $this->middleware('can:Editar rol')->only('edit', 'update');
        $this->middleware('can:Eliminar rol')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required'
        ]);

        // Creamos un nuevo rol
        $role = Role::create([
            'name' => $request->name
        ]);
        
        // Accedemos a la relacion roles-permisos y agregamos el array 'permissions'
        $role->permissions()->attach($request->permissions);

        // Redirigimos a index con el metodo 'with' que nos sirve para enviar un mensaje de sesion
        return redirect()->route('admin.roles.index')->with('info', 'El rol se creó satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required'
        ]);

        $role->update([
            'name' => $request->name
        ]);

        // Accedemos a la relacion roles-permisos y con el metodo 'sync' borramos info anterior y agregamos la que viene en el request
        $role->permissions()->sync($request->permissions);

        // Redirigimos a vista edit
        return redirect()->route('admin.roles.edit', $role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.roles.index')->with('info', 'El rol fue eliminado exitosamente');
    }
}
