<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();

        $user = User::where('email', 'pst@test.com')->first();

        if ($adminRole && $user) {
            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => $adminRole->id,
            ]);
        }
    }
}
