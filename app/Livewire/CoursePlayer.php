<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Lecture;
use App\Models\LectureProgress;
use Livewire\Component;

class CoursePlayer extends Component
{
    public Course $course;
    public Lecture $currentLecture;
    public bool $completed = false;

    public function mount(Course $course, Lecture $lecture)
    {
        $this->course = $course;
        $this->currentLecture = $lecture;

        $progress = LectureProgress::where('user_id', auth()->id())
            ->where('lecture_id', $lecture->id)
            ->first();

        $this->completed = $progress?->completed ?? false;
    }

    public function toggleComplete()
    {
        LectureProgress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'lecture_id' => $this->currentLecture->id,
            ],
            [
                'completed' => !$this->completed,
                'completed_at' => !$this->completed ? now() : null,
            ]
        );

        $this->completed = !$this->completed;
    }

    public function getProgressPercentageProperty()
    {
        $allLectures = $this->course->sections->flatMap->lectures;
        $total = $allLectures->count();
        if ($total === 0) return 0;

        $completedIds = LectureProgress::where('user_id', auth()->id())
            ->whereIn('lecture_id', $allLectures->pluck('id'))
            ->where('completed', true)
            ->pluck('lecture_id');

        return round(($completedIds->count() / $total) * 100);
    }

    public function render()
    {
        $this->course->load(['sections.lectures']);

        $allLectures = $this->course->sections->flatMap(function ($section) {
            return $section->lectures->map(function ($lecture) use ($section) {
                $lecture->section_title = $section->title;
                return $lecture;
            });
        });

        $currentIndex = $allLectures->search(fn($l) => $l->id === $this->currentLecture->id);
        $prevLecture = $currentIndex > 0 ? $allLectures[$currentIndex - 1] : null;
        $nextLecture = $currentIndex < $allLectures->count() - 1 ? $allLectures[$currentIndex + 1] : null;

        $completedIds = LectureProgress::where('user_id', auth()->id())
            ->whereIn('lecture_id', $allLectures->pluck('id'))
            ->where('completed', true)
            ->pluck('lecture_id');

        return view('livewire.course-player', compact(
            'allLectures', 'currentIndex', 'prevLecture', 'nextLecture', 'completedIds'
        ));
    }
}
