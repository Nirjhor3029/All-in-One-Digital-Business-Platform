<x-app-layout>
    <x-slot:title>{{ $service->title }} - {{ config('app.name') }}</x-slot:title>

    <section class="py-12 max-w-7xl mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2">
                <span class="text-xs text-accent font-medium uppercase tracking-wide">{{ $service->category?->name }}</span>
                <h1 class="font-display text-3xl font-bold mt-1">{{ $service->title }}</h1>
                <p class="text-muted mt-2">By <span class="text-primary font-medium">{{ $service->provider?->name }}</span></p>

                <div class="aspect-video bg-gray-100 rounded-card overflow-hidden mt-6">
                    @if($service->thumbnail)
                        <img src="{{ $service->thumbnail_url }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-muted">Service Preview</div>
                    @endif
                </div>

                <div class="prose prose-gray max-w-none mt-8">
                    {!! $service->long_description ?: nl2br(e($service->short_description ?? '')) !!}
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="space-y-4">
                    @foreach($service->plans as $plan)
                        <div class="bg-white rounded-card shadow-card p-6 border-2 {{ $plan->is_popular ? 'border-accent' : 'border-transparent' }}">
                            @if($plan->is_popular)
                                <span class="text-xs bg-accent/10 text-accent px-2 py-1 rounded-full font-medium">Popular</span>
                            @endif
                            <h3 class="font-display text-xl font-bold mt-2">{{ $plan->name }}</h3>
                            @if($plan->description)
                                <p class="text-sm text-muted mt-1">{{ $plan->description }}</p>
                            @endif

                            <div class="text-3xl font-bold text-primary mt-4">${{ number_format($plan->price, 2) }}</div>
                            @if($plan->delivery_time)
                                <p class="text-sm text-muted mt-1">{{ $plan->delivery_time }} delivery</p>
                            @endif

                            @if($plan->features)
                                <ul class="space-y-2 mt-5">
                                    @foreach($plan->features as $feature)
                                        <li class="flex items-start gap-2 text-sm">
                                            <svg class="w-4 h-4 text-success mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>{{ is_array($feature) ? ($feature['feature'] ?? '') : $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            @auth
                                <form method="POST" action="{{ route('cart.add', ['service-plan', $plan->id]) }}">
                                    @csrf
                                    <button type="submit"
                                            class="mt-6 w-full px-4 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold text-sm">
                                        Choose {{ $plan->name }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}"
                                   class="mt-6 block w-full text-center px-4 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold text-sm">
                                    Choose {{ $plan->name }}
                                </a>
                            @endauth
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
