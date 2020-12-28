<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
                    'name' => 'Robert',
                    'email' => 'rcastell@mail.com',
                    'password' => bcrypt('12345678')
                ]);
    
        // 'assignRole' es un metodo de laravel permissions con el cual podemos asignar un rol con el nombre del mismo o los mismmos
        $user->assignRole('Admin');

        User::factory(99)->create();
    }
}
