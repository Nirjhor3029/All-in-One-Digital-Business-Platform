<x-app-layout>
    <x-slot:title>Portfolio - {{ config('app.name') }}</x-slot:title>

    <section class="py-12 max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="font-display text-4xl font-bold mb-4">Our Portfolio</h1>
            <p class="text-muted max-w-2xl mx-auto">Real products our own team has engineered end-to-end — a look at what we build, not just what we sell.</p>
        </div>

        @if($projects->isEmpty())
            <div class="text-center py-16">
                <p class="text-muted">No portfolio projects published yet. Check back soon!</p>
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $project)
                    <div class="bg-white rounded-card shadow-card hover:shadow-card-hover hover:-translate-y-1 transition-all duration-300 overflow-hidden p-6">
                        <div class="w-12 h-12 rounded-card flex items-center justify-center mb-4" style="background: {{ $project->color }}1a;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="{{ $project->color }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                                <path d="{{ $project->icon_path }}"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-lg mb-2">{{ $project->title }}</h3>
                        <p class="text-muted text-sm mb-4">{{ $project->description }}</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($project->tech_stack as $tech)
                                <span class="text-xs px-2.5 py-1 rounded-full bg-surface-container text-secondary">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="text-center mt-16 pt-12 border-t border-gray-100">
            <h2 class="font-display text-2xl font-bold mb-3">Want something like this built for your business?</h2>
            <p class="text-muted mb-6 max-w-xl mx-auto">Whether it's a ready-made product or something fully custom, let's talk about what you need.</p>
            <a href="{{ url('/contact') }}" class="inline-block px-6 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-medium">
                Contact us
            </a>
        </div>
    </section>
</x-app-layout>
