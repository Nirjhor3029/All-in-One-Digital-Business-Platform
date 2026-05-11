<x-app-layout>
    <x-slot:title>{{ $category->name ?? ($tag->name ?? 'Blog') }} - {{ config('app.name') }}</x-slot:title>

    <section class="py-12 max-w-6xl mx-auto px-4">
        @if(!isset($category) && !isset($tag))
            @if($featured->isNotEmpty())
                <div class="mb-12">
                    <h1 class="font-display text-4xl font-bold mb-8">Blog</h1>
                    <div class="grid md:grid-cols-3 gap-6">
                        @foreach($featured as $post)
                            <a href="{{ route('blog.show', $post->slug) }}" class="group bg-white rounded-card shadow-card hover:shadow-card-hover transition-shadow overflow-hidden">
                                <div class="aspect-video bg-gray-100 overflow-hidden">
                                    @if($post->featured_image)
                                        <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-muted text-sm">No Image</div>
                                    @endif
                                </div>
                                <div class="p-5">
                                    @if($post->category)
                                        <span class="text-xs text-accent font-medium uppercase tracking-wide">{{ $post->category->name }}</span>
                                    @endif
                                    <h3 class="font-semibold text-lg mt-1 group-hover:text-accent transition line-clamp-2">{{ $post->title }}</h3>
                                    <p class="text-sm text-muted mt-2 line-clamp-2">{{ $post->excerpt }}</p>
                                    <div class="flex items-center gap-3 mt-4 text-xs text-muted">
                                        <span>{{ $post->author?->name }}</span>
                                        <span>&middot;</span>
                                        <span>{{ $post->published_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @else
            <div class="mb-8">
                <h1 class="font-display text-3xl font-bold">
                    @isset($category) Category: {{ $category->name }} @endisset
                    @isset($tag) Tag: {{ $tag->name }} @endisset
                </h1>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            <div class="flex-1">
                @if($posts->isEmpty())
                    <div class="text-center py-16">
                        <svg class="w-24 h-24 text-gray-200 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <h2 class="text-2xl font-display font-semibold text-gray-400 mb-2">No posts yet</h2>
                        <p class="text-muted">Check back later for new content.</p>
                    </div>
                @else
                    <div class="grid sm:grid-cols-2 gap-6">
                        @foreach($posts as $post)
                            <a href="{{ route('blog.show', $post->slug) }}" class="group bg-white rounded-card shadow-card hover:shadow-card-hover transition-shadow overflow-hidden">
                                <div class="aspect-video bg-gray-100 overflow-hidden">
                                    @if($post->featured_image)
                                        <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-muted text-sm">No Image</div>
                                    @endif
                                </div>
                                <div class="p-5">
                                    @if($post->category)
                                        <span class="text-xs text-accent font-medium uppercase tracking-wide">{{ $post->category->name }}</span>
                                    @endif
                                    <h3 class="font-semibold text-base mt-1 group-hover:text-accent transition line-clamp-2">{{ $post->title }}</h3>
                                    <p class="text-sm text-muted mt-2 line-clamp-2">{{ $post->excerpt }}</p>
                                    <div class="flex items-center gap-3 mt-4 text-xs text-muted">
                                        <span>{{ $post->author?->name }}</span>
                                        <span>&middot;</span>
                                        <span>{{ $post->published_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-8">{{ $posts->links() }}</div>
                @endif
            </div>

            <aside class="lg:w-72 shrink-0">
                <div class="sticky top-24 space-y-6">
                    @livewire('blog-search')

                    @if(isset($categories))
                        <div class="bg-white rounded-card shadow-card p-5">
                            <h4 class="font-semibold text-sm uppercase tracking-wide text-muted mb-3">Categories</h4>
                            <div class="space-y-2">
                                <a href="{{ route('blog.index') }}" class="block text-sm @if(!isset($category) && !isset($tag)) text-accent font-medium @else text-primary/70 hover:text-accent @endif transition">All</a>
                                @foreach($categories as $cat)
                                    <a href="{{ route('blog.category', $cat->slug) }}"
                                       class="block text-sm @if(isset($category) && $category->id === $cat->id) text-accent font-medium @else text-primary/70 hover:text-accent @endif transition flex justify-between">
                                        <span>{{ $cat->name }}</span>
                                        <span class="text-muted text-xs">({{ $cat->posts_count }})</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if(isset($tags))
                        <div class="bg-white rounded-card shadow-card p-5">
                            <h4 class="font-semibold text-sm uppercase tracking-wide text-muted mb-3">Tags</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($tags as $t)
                                    <a href="{{ route('blog.tag', $t->slug) }}"
                                       class="px-3 py-1 text-xs rounded-full @if(isset($tag) && $tag->id === $t->id) bg-accent text-white @else bg-gray-100 text-primary/70 hover:bg-accent/10 hover:text-accent @endif transition font-medium">
                                        {{ $t->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </aside>
        </div>
    </section>
</x-app-layout>
