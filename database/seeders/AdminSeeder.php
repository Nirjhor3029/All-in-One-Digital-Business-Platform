<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@apnarbusiness.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@apnarbusiness.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'is_active' => true,
        ]);
    }
}
