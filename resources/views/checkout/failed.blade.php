<x-app-layout>
    <x-slot:title>Payment Failed - {{ config('app.name') }}</x-slot:title>

    <section class="py-16 max-w-2xl mx-auto px-4 text-center">
        <div class="bg-white rounded-card shadow-card p-10">
            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>

            <h1 class="font-display text-3xl font-bold mb-4">Payment Failed</h1>
            <p class="text-muted mb-2">Something went wrong with your payment.</p>
            <p class="text-sm text-muted mb-8">Please try again or contact support.</p>

            @if(isset($order) && $order->id)
                <p class="text-sm text-muted mb-6">Order #{{ $order->order_number }}</p>
            @endif

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('checkout.index') }}"
                   class="inline-flex items-center px-6 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold">
                    Try Again
                </a>
                <a href="{{ route('cart.index') }}"
                   class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-btn hover:bg-gray-50 transition font-semibold">
                    Return to Cart
                </a>
            </div>
        </div>
    </section>
</x-app-layout>
