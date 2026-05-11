<x-app-layout>
    @push('styles')
    <style>
        .course-sidebar { height: calc(100vh - 64px); overflow-y: auto; }
    </style>
    @endpush

    @livewire('course-player', ['course' => $course, 'lecture' => $lecture])
</x-app-layout>
