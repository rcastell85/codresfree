<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([ 'name' => 'Admin' ]);

        // Con el metodo attach relacionamos role con permission a traves del id de los permisos
        $role->permissions()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ,11]);

        $role = Role::create([ 'name' => 'Instructor' ]);

        // El metodo 'syncPermissions' es parecido al metodo 'attach' pero se hace la relacion con el nombre del permiso y no con el id
        $role->syncPermissions(['Crear cursos', 'Leer cursos', 'Actualizar cursos', 'Eliminar cursos']);
    }
}
