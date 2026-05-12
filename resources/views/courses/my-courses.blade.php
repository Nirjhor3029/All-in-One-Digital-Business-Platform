<x-app-layout>
    <x-slot:title>My Courses - {{ config('app.name') }}</x-slot:title>

    <section class="py-12 max-w-6xl mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <h1 class="font-display text-3xl font-bold">My Courses</h1>
        </div>

        @if($courses->isEmpty())
            <div class="text-center py-16">
                <svg class="w-24 h-24 text-gray-200 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <h2 class="text-2xl font-display font-semibold text-gray-400 mb-2">No courses yet</h2>
                <p class="text-muted mb-8">Enroll in a course to get started.</p>
                <a href="{{ route('courses.index') }}" class="inline-flex items-center px-8 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold">
                    Browse Courses
                </a>
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                    <div class="bg-white rounded-card shadow-card hover:shadow-card-hover transition-shadow overflow-hidden group">
                        <a href="{{ route('courses.show', $course->slug) }}">
                            <div class="aspect-video bg-gray-100 overflow-hidden">
                                @if($course->thumbnail)
                                    <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-muted text-sm">No Thumbnail</div>
                                @endif
                            </div>
                        </a>
                        <div class="p-5">
                            @if($course->category)
                                <span class="text-xs text-accent font-medium uppercase tracking-wide">{{ $course->category->name }}</span>
                            @endif
                            <a href="{{ route('courses.show', $course->slug) }}">
                                <h3 class="font-semibold text-base mt-1 line-clamp-2 hover:text-accent transition">{{ $course->title }}</h3>
                            </a>
                            <p class="text-sm text-muted mt-1">{{ $course->instructor?->name }}</p>

                            @php $progress = $progressData[$course->id] ?? 0; @endphp
                            <div class="mt-4">
                                <div class="flex items-center justify-between text-xs text-muted mb-1">
                                    <span>Progress</span>
                                    <span>{{ $progress }}%</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-1.5">
                                    <div class="bg-accent h-1.5 rounded-full transition-all" style="width: {{ $progress }}%"></div>
                                </div>
                            </div>

                            @php
                                $firstLecture = $course->sections->first()?->lectures->first();
                                $hasCertificate = isset($certificates[$course->id]);
                            @endphp
                            @if($hasCertificate)
                                <a href="{{ route('certificates.download', $certificates[$course->id]) }}"
                                   class="mt-4 block w-full text-center px-4 py-2 bg-success text-white text-sm rounded-btn hover:bg-green-600 transition font-medium">
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Certificate
                                    </span>
                                </a>
                            @elseif($firstLecture)
                                <a href="{{ route('learn.player', [$course, $firstLecture]) }}"
                                   class="mt-4 block w-full text-center px-4 py-2 bg-accent text-white text-sm rounded-btn hover:bg-accent-hover transition font-medium">
                                    {{ $progress > 0 ? 'Continue' : 'Start Learning' }}
                                </a>
                            @else
                                <div class="mt-4 block w-full text-center px-4 py-2 bg-gray-100 text-gray-400 text-sm rounded-btn font-medium">
                                    Content Coming Soon
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</x-app-layout>
