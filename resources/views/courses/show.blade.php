<x-app-layout>
    <section class="py-12 max-w-7xl mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2">
                <div class="aspect-video bg-gray-200 rounded-card overflow-hidden mb-6">
                    @if($course->thumbnail)
                        <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-muted">Course Thumbnail</div>
                    @endif
                </div>

                <span class="text-xs text-accent font-medium uppercase tracking-wide">{{ $course->category?->name }}</span>
                <h1 class="font-display text-3xl font-bold mt-1">{{ $course->title }}</h1>

                <div class="flex items-center gap-4 mt-4 text-sm text-muted">
                    <span>By <span class="text-primary font-medium">{{ $course->instructor?->name }}</span></span>
                    <span>{{ $course->sections->sum(fn($s) => $s->lectures->count()) }} lectures</span>
                    <span>{{ $course->duration_formatted }}</span>
                </div>

                <div class="prose prose-gray max-w-none mt-8">
                    {!! $course->long_description ? $course->long_description : nl2br(e($course->short_description ?? '')) !!}
                </div>

                @if($course->sections->count() > 0)
                <div class="mt-10">
                    <h2 class="font-display text-2xl font-bold mb-6">Course Curriculum</h2>
                    <div class="space-y-3">
                        @foreach($course->sections as $section)
                        <div class="bg-white rounded-card shadow-card overflow-hidden" x-data="{ open: true }">
                            <button @click="open = !open" class="w-full px-5 py-4 flex items-center justify-between text-left hover:bg-gray-50 transition">
                                <div>
                                    <h3 class="font-semibold">{{ $section->title }}</h3>
                                    <p class="text-sm text-muted">{{ $section->lectures->count() }} lectures</p>
                                </div>
                                <svg :class="{'rotate-180': open}" class="w-5 h-5 text-muted transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" x-collapse>
                                <div class="border-t border-gray-100 divide-y divide-gray-50">
                                    @foreach($section->lectures as $lecture)
                                    <div class="flex items-center gap-3 px-5 py-3 text-sm">
                                        <svg class="w-4 h-4 text-muted shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="flex-1">{{ $lecture->title }}</span>
                                        @if($lecture->is_free)
                                            <span class="text-xs bg-accent/10 text-accent px-2 py-0.5 rounded-full font-medium">Free</span>
                                        @endif
                                        <span class="text-xs text-muted">{{ gmdate('i:s', $lecture->duration) }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-card shadow-card p-6 sticky top-24">
                    <div class="text-3xl font-bold text-primary">৳ {{ $course->current_price }}</div>
                    @if($course->discount_price && $course->discount_price < $course->price)
                        <div class="text-sm text-muted line-through">৳ {{ number_format($course->price, 2) }}</div>
                    @endif

                    <ul class="space-y-3 mt-6 text-sm">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Full lifetime access
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $course->sections->sum(fn($s) => $s->lectures->count()) }} lectures
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Certificate of completion
                        </li>
                    </ul>

                    @auth
                        @if($isEnrolled)
                            @php $firstLecture = $course->sections->first()?->lectures->first(); @endphp
                            @if($firstLecture)
                                <a href="{{ route('learn.player', [$course, $firstLecture]) }}"
                                   class="mt-6 block w-full text-center px-4 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold">
                                    Start Learning
                                </a>
                            @else
                                <div class="mt-6 block w-full text-center px-4 py-3 bg-gray-200 text-gray-500 rounded-btn font-semibold">
                                    Content Coming Soon
                                </div>
                            @endif
                        @else
                            <form method="POST" action="{{ route('courses.enroll', $course) }}">
                                @csrf
                                <button type="submit"
                                        class="mt-6 block w-full text-center px-4 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold">
                                    Enroll Now
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('register') }}"
                           class="mt-6 block w-full text-center px-4 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold">
                            Enroll Now
                        </a>
                        <p class="text-xs text-center text-muted mt-2">Create an account to enroll</p>
                    @endauth
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
