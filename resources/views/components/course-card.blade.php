@props(['course'])
<div class="bg-white rounded-card shadow-card hover:shadow-card-hover hover:-translate-y-1 transition-all duration-300 overflow-hidden group">
    <div class="relative overflow-hidden aspect-video bg-gray-100">
        <div class="w-full h-full flex items-center justify-center text-muted text-sm">Course Thumbnail</div>
        @if(isset($course['is_featured']) && $course['is_featured'])
            <div class="absolute top-3 left-3">
                <span class="bg-highlight text-white text-xs px-2 py-1 rounded-full font-medium">Featured</span>
            </div>
        @endif
    </div>
    <div class="p-5">
        @if(isset($course['category']))
            <span class="text-xs text-accent font-medium uppercase tracking-wide">{{ $course['category'] }}</span>
        @endif
        <h3 class="font-semibold text-base mt-1 line-clamp-2 leading-snug">{{ $course['title'] }}</h3>
        @if(isset($course['instructor']))
            <p class="text-sm text-muted mt-1">{{ $course['instructor'] }}</p>
        @endif
        <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100">
            <span class="text-xl font-bold text-primary">{{ $course['price'] }}</span>
            <a href="#" class="px-4 py-2 bg-accent text-white text-sm rounded-btn hover:bg-accent-hover transition font-medium">
                View
            </a>
        </div>
    </div>
</div>
