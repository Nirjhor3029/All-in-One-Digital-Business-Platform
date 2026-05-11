<x-app-layout>
    <x-slot:title>Order Placed - {{ config('app.name') }}</x-slot:title>

    <section class="py-16 max-w-2xl mx-auto px-4 text-center">
        <div class="bg-white rounded-card shadow-card p-10">
            <div class="w-20 h-20 {{ $order->payment_status === 'paid' ? 'bg-success/10' : 'bg-yellow-50' }} rounded-full flex items-center justify-center mx-auto mb-6">
                @if($order->payment_status === 'paid')
                    <svg class="w-10 h-10 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                @else
                    <svg class="w-10 h-10 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                @endif
            </div>

            <h1 class="font-display text-3xl font-bold mb-4">Order Placed!</h1>
            <p class="text-muted mb-2">Thank you for your order.</p>
            <p class="text-sm text-muted mb-8">Order #{{ $order->order_number }}</p>

            @if($order->payment_status !== 'paid')
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6 text-sm text-yellow-700">
                    <p class="font-medium">Payment pending</p>
                    <p class="mt-1">Your order has been received. We will notify you once the payment is confirmed.</p>
                </div>
            @endif

            <div class="bg-gray-50 rounded-lg p-4 mb-8 text-sm">
                <div class="flex justify-between mb-2">
                    <span class="text-muted">Total</span>
                    <span class="font-semibold">${{ number_format($order->total, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-muted">Payment</span>
                    <span class="font-semibold capitalize {{ $order->payment_status === 'paid' ? 'text-success' : 'text-yellow-600' }}">{{ $order->payment_status }}</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('orders.show', $order) }}"
                   class="inline-flex items-center px-6 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold">
                    View Order
                </a>
                <a href="{{ route('orders.index') }}"
                   class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-btn hover:bg-gray-50 transition font-semibold">
                    My Orders
                </a>
                <a href="{{ route('courses.index') }}"
                   class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-btn hover:bg-gray-50 transition font-semibold">
                    Browse Courses
                </a>
            </div>
        </div>
    </section>
</x-app-layout>
