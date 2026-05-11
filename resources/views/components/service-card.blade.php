@props(['service'])
<div class="bg-white rounded-card shadow-card hover:shadow-card-hover hover:-translate-y-1 transition-all duration-300 overflow-hidden group">
    <a href="{{ route('services.show', $service->slug) }}">
        <div class="relative overflow-hidden aspect-video bg-gray-100">
            <img src="{{ $service->thumbnail_url }}" alt="{{ $service->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                 onerror="this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center text-muted text-sm\'>No Thumbnail</div>'">
            @if($service->is_featured)
                <div class="absolute top-3 left-3">
                    <span class="bg-highlight text-white text-xs px-2 py-1 rounded-full font-medium">Featured</span>
                </div>
            @endif
        </div>
    </a>
    <div class="p-5">
        @if($service->category)
            <span class="text-xs text-accent font-medium uppercase tracking-wide">{{ $service->category->name }}</span>
        @endif
        <a href="{{ route('services.show', $service->slug) }}">
            <h3 class="font-semibold text-base mt-1 line-clamp-2 leading-snug hover:text-accent transition">{{ $service->title }}</h3>
        </a>
        <p class="text-sm text-muted mt-1">{{ $service->provider?->name }}</p>
        <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100">
            <div>
                <span class="text-xl font-bold text-primary">${{ number_format($service->starting_price, 2) }}</span>
                <span class="text-xs text-muted ml-1">starting</span>
            </div>
            <a href="{{ route('services.show', $service->slug) }}"
               class="px-4 py-2 bg-accent text-white text-sm rounded-btn hover:bg-accent-hover transition font-medium">
                View Plans
            </a>
        </div>
    </div>
</div>
