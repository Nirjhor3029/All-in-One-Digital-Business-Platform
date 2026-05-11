@props(['course'])
<div class="bg-white rounded-card shadow-card hover:shadow-card-hover hover:-translate-y-1 transition-all duration-300 overflow-hidden group">
    <a href="{{ route('courses.show', $course->slug) }}">
        <div class="relative overflow-hidden aspect-video bg-gray-100">
            <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                 onerror="this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center text-muted text-sm\'>No Thumbnail</div>'">
            @if($course->is_featured)
                <div class="absolute top-3 left-3">
                    <span class="bg-highlight text-white text-xs px-2 py-1 rounded-full font-medium">Featured</span>
                </div>
            @endif
            @if($course->is_new)
                <div class="absolute top-3 right-3">
                    <span class="bg-success text-white text-xs px-2 py-1 rounded-full font-medium">New</span>
                </div>
            @endif
        </div>
    </a>
    <div class="p-5">
        @if($course->category)
            <span class="text-xs text-accent font-medium uppercase tracking-wide">{{ $course->category->name }}</span>
        @endif
        <a href="{{ route('courses.show', $course->slug) }}">
            <h3 class="font-semibold text-base mt-1 line-clamp-2 leading-snug hover:text-accent transition">{{ $course->title }}</h3>
        </a>
        <p class="text-sm text-muted mt-1">{{ $course->instructor?->name }}</p>
        @if($course->enrollments_count)
            <p class="text-xs text-muted mt-1">{{ number_format($course->enrollments_count) }} enrolled</p>
        @endif
        <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100">
            <div>
                <span class="text-xl font-bold text-primary">৳ {{ $course->current_price }}</span>
                @if($course->discount_price && $course->discount_price < $course->price)
                    <span class="text-sm text-muted line-through ml-2">৳ {{ number_format($course->price, 2) }}</span>
                @endif
            </div>
            <a href="{{ route('courses.show', $course->slug) }}"
               class="px-4 py-2 bg-accent text-white text-sm rounded-btn hover:bg-accent-hover transition font-medium">
                View
            </a>
        </div>
    </div>
</div>
