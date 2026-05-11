<x-app-layout>
    <x-slot:title>My Orders - {{ config('app.name') }}</x-slot:title>

    <section class="py-12 max-w-4xl mx-auto px-4">
        <h1 class="font-display text-3xl font-bold mb-8">My Orders</h1>

        @if($orders->isEmpty())
            <div class="text-center py-16">
                <svg class="w-24 h-24 text-gray-200 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <h2 class="text-2xl font-display font-semibold text-gray-400 mb-2">No orders yet</h2>
                <p class="text-muted mb-8">Start by enrolling in a course.</p>
                <a href="{{ route('courses.index') }}" class="inline-flex items-center px-8 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold">
                    Browse Courses
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($orders as $order)
                    <a href="{{ route('orders.show', $order) }}"
                       class="block bg-white rounded-card shadow-card p-5 hover:shadow-card-hover transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="font-semibold">#{{ $order->order_number }}</span>
                                <span class="text-sm text-muted ml-3">{{ $order->created_at->format('d M Y, h:i A') }}</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="text-sm font-semibold">${{ number_format($order->total, 2) }}</span>
                                <span class="text-xs px-2.5 py-1 rounded-full font-medium
                                    {{ $order->payment_status === 'paid' ? 'bg-success/10 text-success' : '' }}
                                    {{ $order->payment_status === 'unpaid' ? 'bg-yellow-50 text-yellow-600' : '' }}
                                    {{ $order->payment_status === 'failed' ? 'bg-red-50 text-red-500' : '' }}
                                    {{ $order->payment_status === 'refunded' ? 'bg-gray-100 text-gray-500' : '' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-muted">
                            {{ $order->items->count() }} item(s) — {{ $order->billing_name }}
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @endif
    </section>
</x-app-layout>
