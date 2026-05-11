<x-app-layout>
    <x-slot:title>Services - {{ config('app.name') }}</x-slot:title>

    <section class="py-12 max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="font-display text-4xl font-bold mb-4">Our Services</h1>
            <p class="text-muted max-w-2xl mx-auto">Professional digital services tailored to your needs.</p>
        </div>

        @if($featured->isNotEmpty())
            <section class="mb-16">
                <h2 class="font-display text-2xl font-bold mb-6">Featured Services</h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($featured as $service)
                        <x-service-card :service="$service" />
                    @endforeach
                </div>
            </section>
        @endif

        <section>
            <h2 class="font-display text-2xl font-bold mb-6">All Services</h2>
            @if($services->isEmpty())
                <div class="text-center py-16">
                    <p class="text-muted">No services available yet. Check back soon!</p>
                </div>
            @else
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($services as $service)
                        <x-service-card :service="$service" />
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $services->links() }}
                </div>
            @endif
        </section>
    </section>
</x-app-layout>
