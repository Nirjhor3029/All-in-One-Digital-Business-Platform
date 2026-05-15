<x-app-layout>
    @section('title', $page->meta_title ?: $page->title . ' — ' . config('app.name'))
    @section('meta_description', $page->meta_description)

    <section class="py-20 max-w-4xl mx-auto px-4">
        <h1 class="font-display text-4xl font-bold mb-6">{{ $page->title }}</h1>
        <div class="prose prose-gray max-w-none">
            {!! $page->content !!}
        </div>
    </section>
</x-app-layout>
