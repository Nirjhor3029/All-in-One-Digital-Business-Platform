<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@apnarbusiness.com')->first();
        $user = User::where('email', 'user@apnarbusiness.com')->first();

        $courses = Course::where('slug', 'startup-foundation-101')->first();
        $webDev = Course::where('slug', 'web-development-bootcamp')->first();
        $automation = Course::where('slug', 'automation-masterclass')->first();

        $enrollments = [
            ['user_id' => $admin->id, 'course_id' => $courses->id, 'status' => 'completed', 'completed_at' => now()->subDays(10)],
            ['user_id' => $admin->id, 'course_id' => $webDev->id, 'status' => 'in_progress', 'completed_at' => null],
            ['user_id' => $user->id, 'course_id' => $automation->id, 'status' => 'in_progress', 'completed_at' => null],
            ['user_id' => $user->id, 'course_id' => $courses->id, 'status' => 'not_started', 'completed_at' => null],
            ['user_id' => $user->id, 'course_id' => $webDev->id, 'status' => 'not_started', 'completed_at' => null],
        ];

        foreach ($enrollments as $enrollment) {
            Enrollment::create($enrollment);
        }
    }
}