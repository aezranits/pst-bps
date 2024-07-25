<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Role::create(['name' => 'admin', 'description' => 'Admin']);
        Role::create(['name' => 'petugas_pst', 'description' => 'Petugas PST']);
        Role::create(['name' => 'front_office', 'description' => 'Front Office']);
    }
}
