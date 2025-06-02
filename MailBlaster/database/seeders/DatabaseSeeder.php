<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecuta el seeder de roles y permisos
        $this->call(RolePermissionSeeder::class);

        // Crea usuario administrador
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('administrador');

        // Crea usuario publicista
        $publicista = User::factory()->create([
            'name' => 'Publicista',
            'email' => 'publicista@mail.com',
            'password' => bcrypt('password'),
        ]);
        $publicista->assignRole('publicista');
    }
}
