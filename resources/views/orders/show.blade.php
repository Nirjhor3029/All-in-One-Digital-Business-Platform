<x-app-layout>
    <x-slot:title>Order #{{ $order->order_number }}</x-slot:title>

    <section class="py-12 max-w-4xl mx-auto px-4">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('orders.index') }}" class="text-accent hover:text-accent-hover transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h1 class="font-display text-3xl font-bold">Order #{{ $order->order_number }}</h1>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-card shadow-card p-6">
                    <h3 class="font-semibold text-lg mb-4">Order Items</h3>
                    <div class="divide-y divide-gray-100">
                        @foreach($order->items as $item)
                            <div class="flex items-center justify-between py-3">
                                <div>
                                    <p class="font-medium">{{ $item->itemable?->title ?? 'Item' }}</p>
                                    <p class="text-xs text-muted">{{ class_basename($item->itemable_type) }}</p>
                                </div>
                                <span class="font-semibold">${{ number_format($item->price, 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if($order->transactions->isNotEmpty())
                    <div class="bg-white rounded-card shadow-card p-6">
                        <h3 class="font-semibold text-lg mb-4">Payment History</h3>
                        <div class="space-y-3">
                            @foreach($order->transactions as $txn)
                                <div class="flex items-center justify-between text-sm">
                                    <div>
                                        <span class="font-medium">{{ ucfirst($txn->gateway) }}</span>
                                        <span class="text-muted ml-2">{{ $txn->transaction_id ?? 'N/A' }}</span>
                                    </div>
                                    <span class="text-xs px-2 py-0.5 rounded-full font-medium
                                        {{ $txn->status === 'success' ? 'bg-success/10 text-success' : '' }}
                                        {{ $txn->status === 'failed' || $txn->status === 'cancel' ? 'bg-red-50 text-red-500' : '' }}
                                        {{ $txn->status === 'pending' ? 'bg-yellow-50 text-yellow-600' : '' }}">
                                        {{ ucfirst($txn->status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="space-y-4">
                <div class="bg-white rounded-card shadow-card p-6">
                    <h3 class="font-semibold text-lg mb-4">Order Status</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-muted">Status</span>
                            <span class="font-medium capitalize">{{ $order->status }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-muted">Payment</span>
                            <span class="font-medium capitalize">{{ $order->payment_status }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-muted">Subtotal</span>
                            <span>${{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        @if($order->discount > 0)
                            <div class="flex justify-between text-success">
                                <span>Discount</span>
                                <span>-${{ number_format($order->discount, 2) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between font-bold text-lg pt-3 border-t border-gray-100">
                            <span>Total</span>
                            <span>${{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-card shadow-card p-6">
                    <h3 class="font-semibold text-lg mb-3">Billing Details</h3>
                    <div class="text-sm space-y-1 text-muted">
                        <p class="text-primary font-medium">{{ $order->billing_name }}</p>
                        <p>{{ $order->billing_email }}</p>
                        <p>{{ $order->billing_phone }}</p>
                        <p>{{ $order->billing_address }}</p>
                    </div>
                </div>

                @if($order->payment_status === 'unpaid')
                    <a href="{{ route('checkout.index') }}"
                       class="block w-full text-center px-4 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold">
                        Retry Payment
                    </a>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
