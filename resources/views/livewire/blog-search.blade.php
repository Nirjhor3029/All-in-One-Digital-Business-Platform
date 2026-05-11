<div class="bg-white rounded-card shadow-card p-5">
    <h4 class="font-semibold text-sm uppercase tracking-wide text-muted mb-3">Search</h4>
    <div class="relative" x-data="{ open: false }">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search posts..."
               class="w-full rounded-lg border-gray-200 text-sm"
               @focus="open = true" @click.away="open = false">

        @if(strlen($search) >= 2)
            <div x-show="open" class="absolute top-full left-0 right-0 mt-1 bg-white rounded-lg shadow-lg border border-gray-100 z-10 max-h-60 overflow-y-auto">
                @if($results->isEmpty())
                    <p class="px-4 py-3 text-sm text-muted">No results found.</p>
                @else
                    @foreach($results as $post)
                        <a href="{{ route('blog.show', $post->slug) }}" class="block px-4 py-3 hover:bg-gray-50 transition" @click="open = false">
                            <span class="text-sm font-medium line-clamp-1">{{ $post->title }}</span>
                            <span class="text-xs text-muted">{{ $post->category?->name }} &middot; {{ $post->published_at->format('M d, Y') }}</span>
                        </a>
                    @endforeach
                @endif
            </div>
        @endif
    </div>
</div>
