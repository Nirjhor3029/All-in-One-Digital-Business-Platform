<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;

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

    public function enroll(Course $course)
    {
        abort_unless($course->is_published, 404);

        if ($course->is_free) {
            Enrollment::firstOrCreate([
                'user_id' => auth()->id(),
                'course_id' => $course->id,
            ], ['status' => 'active']);

            $firstLecture = $course->sections->first()?->lectures->first();

            if ($firstLecture) {
                return redirect()->route('learn.player', [$course, $firstLecture]);
            }

            return redirect()->route('courses.show', $course)
                ->with('success', 'Enrolled successfully! Content coming soon.');
        }

        return redirect()->route('courses.show', $course)
            ->with('error', 'This course requires payment. Payment system coming soon.');
    }
}
