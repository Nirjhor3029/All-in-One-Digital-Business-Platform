<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\LectureProgress;

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

    public function myCourses()
    {
        $enrollments = Enrollment::with('course.instructor', 'course.category', 'course.sections.lectures')
            ->where('user_id', auth()->id())
            ->where('status', 'active')
            ->latest()
            ->get();

        $courses = $enrollments->pluck('course');

        $completedIds = LectureProgress::where('user_id', auth()->id())
            ->where('completed', true)
            ->pluck('lecture_id');

        $progressData = $courses->mapWithKeys(function ($course) use ($completedIds) {
            $allLectures = $course->sections->flatMap->lectures;
            $total = $allLectures->count();
            $completed = $allLectures->filter(fn ($l) => $completedIds->contains($l->id))->count();
            $progress = $total > 0 ? round(($completed / $total) * 100) : 0;
            return [$course->id => $progress];
        });

        return view('courses.my-courses', compact('courses', 'progressData'));
    }

    public function show(Course $course)
    {
        abort_unless($course->is_published, 404);

        $course->load(['instructor', 'category', 'sections.lectures', 'enrollments']);

        $isEnrolled = auth()->check() && $course->enrollments()
            ->where('user_id', auth()->id())
            ->exists();

        $inWishlist = auth()->check() && $course->wishlistedBy(auth()->user());

        return view('courses.show', compact('course', 'isEnrolled', 'inWishlist'));
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

        return redirect()->route('cart.add', ['course', $course->id]);
    }
}
