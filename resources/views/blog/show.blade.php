<x-app-layout>
    <x-slot:title>{{ $post->meta_title ?? $post->title }} - {{ config('app.name') }}</x-slot:title>

    <section class="py-12 max-w-4xl mx-auto px-4">
        <div class="mb-8 text-center">
            @if($post->category)
                <span class="text-xs text-accent font-medium uppercase tracking-wide">{{ $post->category->name }}</span>
            @endif
            <h1 class="font-display text-4xl font-bold mt-2">{{ $post->title }}</h1>
            <div class="flex items-center justify-center gap-3 mt-4 text-sm text-muted">
                <span>{{ $post->author?->name }}</span>
                <span>&middot;</span>
                <span>{{ $post->published_at->format('M d, Y') }}</span>
                <span>&middot;</span>
                <span>{{ $post->approved_comments_count ?? $post->approvedComments->count() }} comment(s)</span>
            </div>
        </div>

        @if($post->featured_image)
            <div class="aspect-video rounded-card overflow-hidden mb-8">
                <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="prose prose-lg max-w-none">
            {!! $post->content !!}
        </div>

        @if($post->tags->isNotEmpty())
            <div class="flex flex-wrap gap-2 mt-8 pt-8 border-t border-gray-100">
                @foreach($post->tags as $tag)
                    <a href="{{ route('blog.tag', $tag->slug) }}"
                       class="px-3 py-1 text-xs rounded-full bg-gray-100 text-primary/70 hover:bg-accent/10 hover:text-accent transition font-medium">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif

        @if($related->isNotEmpty())
            <div class="mt-12 pt-8 border-t border-gray-100">
                <h2 class="font-display text-2xl font-bold mb-6">Related Posts</h2>
                <div class="grid sm:grid-cols-3 gap-6">
                    @foreach($related as $rel)
                        <a href="{{ route('blog.show', $rel->slug) }}" class="group">
                            <div class="aspect-video bg-gray-100 rounded-card overflow-hidden mb-3">
                                @if($rel->featured_image)
                                    <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
                            <h3 class="font-semibold text-sm group-hover:text-accent transition line-clamp-2">{{ $rel->title }}</h3>
                            <span class="text-xs text-muted">{{ $rel->published_at->format('M d, Y') }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mt-12 pt-8 border-t border-gray-100">
            <h2 class="font-display text-2xl font-bold mb-6">Comments</h2>
            @livewire('comment-section', ['post' => $post])
        </div>
    </section>
</x-app-layout>
