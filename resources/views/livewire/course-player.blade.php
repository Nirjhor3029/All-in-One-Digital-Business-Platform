<div class="flex flex-col lg:flex-row">
    {{-- Main Content --}}
    <div class="flex-1 min-w-0">
        <div class="bg-black aspect-video flex items-center justify-center">
            @if($currentLecture->video_url && (str_contains($currentLecture->video_url, 'youtube') || str_contains($currentLecture->video_url, 'youtu.be')))
                @php
                    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $currentLecture->video_url, $matches);
                    $youtubeId = $matches[1] ?? null;
                @endphp
                @if($youtubeId)
                    <iframe class="w-full h-full" src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                            frameborder="0" allowfullscreen
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
                    </iframe>
                @endif
            @elseif($currentLecture->video_url && str_contains($currentLecture->video_url, 'vimeo'))
                @php
                    preg_match('/(?:vimeo\.com\/)(\d+)/', $currentLecture->video_url, $matches);
                    $vimeoId = $matches[1] ?? null;
                @endphp
                @if($vimeoId)
                    <iframe class="w-full h-full" src="https://player.vimeo.com/video/{{ $vimeoId }}"
                            frameborder="0" allowfullscreen></iframe>
                @endif
            @elseif($currentLecture->video_url)
                <video controls class="w-full h-full" src="{{ $currentLecture->video_url }}"></video>
            @else
                <div class="text-white/50 text-center">
                    <p class="text-lg font-medium">{{ $currentLecture->title }}</p>
                    <p class="text-sm mt-2">Video player placeholder</p>
                </div>
            @endif
        </div>

        <div class="max-w-4xl mx-auto px-4 py-6">
            <h1 class="font-display text-2xl font-bold">{{ $currentLecture->title }}</h1>

            <div class="flex items-center gap-4 mt-3">
                <button wire:click="toggleComplete"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-btn text-sm font-medium transition
                        {{ $completed ? 'bg-success/10 text-success' : 'bg-gray-100 text-muted hover:bg-gray-200' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="{{ $completed ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : 'M9 12l2 2 4-4' }}"/>
                    </svg>
                    {{ $completed ? 'Completed' : 'Mark as Complete' }}
                </button>
            </div>

            @if($currentLecture->content)
                <div class="prose prose-gray max-w-none mt-6">
                    {!! $currentLecture->content !!}
                </div>
            @endif

            @if($courseCompleted)
                <div class="mt-6 p-4 bg-success/5 border border-success/20 rounded-card">
                    <div class="flex items-center gap-3">
                        <svg class="w-8 h-8 text-success shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="font-semibold text-success">Course Completed!</p>
                            <p class="text-sm text-muted">Congratulations on finishing this course.</p>
                            @if($certificate)
                                <a href="{{ route('certificates.download', $certificate) }}"
                                   class="inline-flex items-center gap-1 text-sm font-medium text-accent hover:text-accent-hover mt-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Download Certificate
                                </a>
                            @else
                                <p class="text-xs text-muted mt-1">Generating certificate...</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                @if($prevLecture)
                    <a href="{{ route('learn.player', [$course, $prevLecture]) }}"
                       class="inline-flex items-center gap-2 px-4 py-2 text-sm text-muted hover:text-primary transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Previous
                    </a>
                @else
                    <div></div>
                @endif

                <span class="text-sm text-muted">{{ $currentIndex + 1 }} / {{ $allLectures->count() }}</span>

                @if($nextLecture)
                    <a href="{{ route('learn.player', [$course, $nextLecture]) }}"
                       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium bg-accent text-white rounded-btn hover:bg-accent-hover transition">
                        Next
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="lg:w-80 shrink-0 border-l border-gray-200 bg-white course-sidebar">
        <div class="p-4 border-b border-gray-100">
            <h3 class="font-semibold text-sm">{{ $course->title }}</h3>
            <div class="mt-2 bg-gray-100 rounded-full h-1.5 overflow-hidden">
                <div class="bg-accent h-full rounded-full transition-all duration-500" style="width: {{ $this->progressPercentage }}%"></div>
            </div>
            <p class="text-xs text-muted mt-1">{{ $this->progressPercentage }}% complete</p>
        </div>
        <div class="divide-y divide-gray-100">
            @foreach($allLectures as $index => $lecture)
                <a href="{{ route('learn.player', [$course, $lecture]) }}"
                   class="flex items-center gap-3 px-4 py-3 text-sm transition
                   {{ $lecture->id === $currentLecture->id ? 'bg-accent/5 border-l-2 border-accent' : 'hover:bg-gray-50' }}">
                    <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs shrink-0
                        {{ $completedIds->contains($lecture->id) ? 'bg-success text-white' : ($lecture->id === $currentLecture->id ? 'bg-accent text-white' : 'bg-gray-200 text-muted') }}">
                        {{ $index + 1 }}
                    </span>
                    <div class="min-w-0">
                        <p class="truncate {{ $lecture->id === $currentLecture->id ? 'font-medium text-accent' : '' }}">
                            {{ $lecture->title }}
                        </p>
                        <p class="text-xs text-muted">{{ gmdate('i:s', $lecture->duration) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
