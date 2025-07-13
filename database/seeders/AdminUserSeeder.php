<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
         $adminRole = Role::where('name', 'admin')->first();

        if (!$adminRole) {
            $adminRole = Role::create(['name' => 'admin']);
        }

        User::updateOrCreate(
            ['email' => 'praptigurung23@icloud.com'],
            [
                'name' => 'Prapti Gurung',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
            ]
        );
    }
}
