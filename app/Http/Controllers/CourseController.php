<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['instructor', 'category', 'sections.lectures'])
            ->withCount('enrollments')
            ->published()
            ->latest()
            ->paginate(12);

        $featured = Course::with('instructor')
            ->withCount('enrollments')
            ->published()
            ->featured()
            ->take(6)
            ->get();

        return view('courses.index', compact('courses', 'featured'));
    }

    public function show(Course $course)
    {
        abort_unless($course->is_published, 404);

        $course->load(['instructor', 'category', 'sections.lectures', 'enrollments']);

        $isEnrolled = auth()->check() && $course->enrollments()
            ->where('user_id', auth()->id())
            ->exists();

        return view('courses.show', compact('course', 'isEnrolled'));
    }
}
