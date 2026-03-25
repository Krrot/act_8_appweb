<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['nombreRol' => 'Sales'],
            ['nombreRol' => 'Purchasing'],
            ['nombreRol' => 'Warehouse'],
            ['nombreRol' => 'Route'],
            ['nombreRol' => 'Customer'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}