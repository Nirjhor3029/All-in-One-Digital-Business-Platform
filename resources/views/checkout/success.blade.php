<x-app-layout>
    <x-slot:title>Payment Successful - {{ config('app.name') }}</x-slot:title>

    <section class="py-16 max-w-2xl mx-auto px-4 text-center">
        <div class="bg-white rounded-card shadow-card p-10">
            <div class="w-20 h-20 bg-success/10 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <h1 class="font-display text-3xl font-bold mb-4">Payment Successful!</h1>
            <p class="text-muted mb-2">Thank you for your purchase.</p>
            <p class="text-sm text-muted mb-8">Order #{{ $order->order_number }}</p>

            <div class="bg-gray-50 rounded-lg p-4 mb-8 text-sm">
                <div class="flex justify-between mb-2">
                    <span class="text-muted">Amount Paid</span>
                    <span class="font-semibold">${{ number_format($order->total, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-muted">Status</span>
                    <span class="text-success font-semibold">{{ ucfirst($order->payment_status) }}</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center px-6 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold">
                    Go to Dashboard
                </a>
                <a href="{{ route('courses.index') }}"
                   class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-btn hover:bg-gray-50 transition font-semibold">
                    Browse More Courses
                </a>
            </div>
        </div>
    </section>
</x-app-layout>
