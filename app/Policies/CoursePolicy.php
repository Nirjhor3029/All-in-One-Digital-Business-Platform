<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Course $course): bool
    {
        return $course->is_published || $user->id === $course->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Course $course): bool
    {
        return $user->id === $course->user_id || $user->hasRole('Super Admin');
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->id === $course->user_id || $user->hasRole('Super Admin');
    }

    public function viewLectures(User $user, Course $course): bool
    {
        if ($course->is_free || $user->id === $course->user_id || $user->hasRole('Super Admin')) {
            return true;
        }

        return $course->enrollments()
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->exists();
    }
}
