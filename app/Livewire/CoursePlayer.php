<?php

namespace App\Livewire;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lecture;
use App\Models\LectureProgress;
use App\Jobs\GenerateCertificate;
use App\Notifications\PlatformNotification;
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

        if ($this->completed && $this->isCourseCompleted()) {
            $enrollment = Enrollment::where('user_id', auth()->id())
                ->where('course_id', $this->course->id)
                ->first();

            if ($enrollment && !Certificate::where('enrollment_id', $enrollment->id)->exists()) {
                GenerateCertificate::dispatch($enrollment);
                auth()->user()->notify(new PlatformNotification(
                    title: 'Course Completed!',
                    body: "Congratulations! You've completed {$this->course->title}. Your certificate is being generated.",
                    url: route('courses.my-courses'),
                    icon: 'academic-cap',
                ));
            }
        }
    }

    protected function isCourseCompleted(): bool
    {
        $allLectures = $this->course->sections->flatMap->lectures;
        $total = $allLectures->count();
        if ($total === 0) return false;

        $completedIds = LectureProgress::where('user_id', auth()->id())
            ->whereIn('lecture_id', $allLectures->pluck('id'))
            ->where('completed', true)
            ->pluck('lecture_id');

        return $completedIds->count() >= $total;
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

        $courseCompleted = $allLectures->count() > 0 && $completedIds->count() >= $allLectures->count();

        $certificate = null;
        if ($courseCompleted) {
            $enrollment = \App\Models\Enrollment::where('user_id', auth()->id())
                ->where('course_id', $this->course->id)
                ->first();
            $certificate = $enrollment ? \App\Models\Certificate::where('enrollment_id', $enrollment->id)->first() : null;
        }

        return view('livewire.course-player', compact(
            'allLectures', 'currentIndex', 'prevLecture', 'nextLecture', 'completedIds',
            'courseCompleted', 'certificate'
        ));
    }
}
