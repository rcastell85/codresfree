<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Leer usuarios')->only('index');    
        $this->middleware('can:Editar usuarios')->only('edit', 'update');
    }

    public function index()
    {
        return view('admin.users.index');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        // Accedemos al registro usuario y traemos la relacion 'roles' y con 'sync' actualizamos
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.edit', $user);
    }

}
