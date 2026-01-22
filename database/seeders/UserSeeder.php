<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener roles
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        // Crear o actualizar Admin
        $admin = User::updateOrCreate(
            ['usuario' => 'admin'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin1234'),
            ]
        );

        // Asignar rol admin
        if ($adminRole) {
            $admin->roles()->syncWithoutDetaching([$adminRole->id]);
        }

        // Crear o actualizar Usuario
        $user = User::updateOrCreate(
            ['usuario' => 'user'],
            [
                'name' => 'Usuario',
                'password' => Hash::make('user1234'),
            ]
        );

        // Asignar rol user
        if ($userRole) {
            $user->roles()->syncWithoutDetaching([$userRole->id]);
        }
    }
}