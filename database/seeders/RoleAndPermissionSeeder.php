<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Users
            'user.list', 'user.create', 'user.edit', 'user.delete',
            // Courses
            'course.list', 'course.create', 'course.edit', 'course.delete',
            // Sections
            'section.list', 'section.create', 'section.edit', 'section.delete',
            // Lectures
            'lecture.list', 'lecture.create', 'lecture.edit', 'lecture.delete',
            // Categories
            'category.list', 'category.create', 'category.edit', 'category.delete',
            // Types
            'type.list', 'type.create', 'type.edit', 'type.delete',
            // Roles & Permissions
            'role.list', 'role.create', 'role.edit', 'role.delete',
            'permission.list', 'permission.create', 'permission.edit', 'permission.delete',
            // Settings
            'setting.list', 'setting.edit',
        ];

        foreach ($permissions as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(Permission::all());

        $userRole = Role::firstOrCreate(['name' => 'User', 'guard_name' => 'web']);

        $admin = User::where('email', 'admin@apnarbusiness.com')->first();
        if ($admin) {
            $admin->assignRole('Super Admin');
        }
    }
}
