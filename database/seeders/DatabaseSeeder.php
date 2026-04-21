<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        // Create admin user
        User::create([
            'nombreUsuario' => 'admin',
            'contrasena' => Hash::make('admin123'),
            'nombre' => 'Administrator',
            'nombreApellido' => '',
            'rolId' => 1, // Admin role
            'activo' => true,
        ]);

        $this->call(TestDataSeeder::class);
    }
}
