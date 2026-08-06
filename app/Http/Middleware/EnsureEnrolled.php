<?php

namespace App\Http\Middleware;

use App\Models\Course;
use App\Models\Lecture;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEnrolled
{
    public function handle(Request $request, Closure $next): Response
    {
        $course = $request->route('course');
        $lecture = $request->route('lecture');

        if ($lecture instanceof Lecture && $lecture->is_free) {
            return $next($request);
        }

        if ($course instanceof Course) {
            if ($course->is_free) {
                return $next($request);
            }

            $enrolled = $course->enrollments()
                ->where('user_id', $request->user()->id)
                ->exists();

            if (! $enrolled && $course->user_id !== $request->user()->id) {
                abort(403, 'You are not enrolled in this course.');
            }
        }

        return $next($request);
    }
}
