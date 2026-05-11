<x-app-layout>
    <x-slot:title>Checkout - {{ config('app.name') }}</x-slot:title>

    <section class="py-12 max-w-5xl mx-auto px-4">
        <h1 class="font-display text-3xl font-bold mb-8">Checkout</h1>

        @livewire('checkout-form')
    </section>
</x-app-layout>
