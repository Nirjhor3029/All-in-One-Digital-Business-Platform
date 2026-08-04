<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            TypeSeeder::class,
            CategorySeeder::class,
            SettingsSeeder::class,
            RoleAndPermissionSeeder::class,
            PageSeeder::class,
            ProjectSeeder::class,
            CourseSeeder::class,
            ServiceSeeder::class,
            PostSeeder::class,
            CouponSeeder::class,
            EnrollmentSeeder::class,
            OrderSeeder::class,
        ]);
    }
}