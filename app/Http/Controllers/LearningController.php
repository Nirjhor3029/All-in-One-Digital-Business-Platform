<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecture;
use App\Models\LectureProgress;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function player(Course $course, Lecture $lecture)
    {
        abort_unless($course->is_published, 404);
        abort_if($lecture->section->course_id !== $course->id, 404);

        $course->load(['sections.lectures']);

        $progress = LectureProgress::firstOrCreate([
            'user_id' => auth()->id(),
            'lecture_id' => $lecture->id,
        ]);

        return view('learn.player', compact('course', 'lecture', 'progress'));
    }

    public function markComplete(Request $request, Lecture $lecture)
    {
        $progress = LectureProgress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'lecture_id' => $lecture->id,
            ],
            [
                'completed' => true,
                'completed_at' => now(),
            ]
        );

        if ($request->ajax()) {
            return response()->json(['status' => 'ok', 'progress' => $progress]);
        }

        return back()->with('success', 'Lecture marked as complete!');
    }

    public function progress(Course $course)
    {
        $totalLectures = $course->sections()->withCount('lectures')->get()->sum('lectures_count');
        $completedLectures = LectureProgress::where('user_id', auth()->id())
            ->whereIn('lecture_id', $course->sections()->with('lectures')->get()->pluck('lectures.*.id')->flatten())
            ->where('completed', true)
            ->count();

        $percentage = $totalLectures > 0 ? round(($completedLectures / $totalLectures) * 100) : 0;

        return response()->json([
            'total' => $totalLectures,
            'completed' => $completedLectures,
            'percentage' => $percentage,
        ]);
    }
}
