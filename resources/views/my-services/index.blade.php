<x-app-layout>
    <x-slot:title>My Services - {{ config('app.name') }}</x-slot:title>

    <section class="py-12 max-w-6xl mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <h1 class="font-display text-3xl font-bold">My Services</h1>
        </div>

        @if($purchases->isEmpty())
            <div class="text-center py-16">
                <svg class="w-24 h-24 text-gray-200 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
                <h2 class="text-2xl font-display font-semibold text-gray-400 mb-2">No services yet</h2>
                <p class="text-muted mb-8">Purchase a service to get started.</p>
                <a href="{{ route('services.index') }}" class="inline-flex items-center px-8 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold">
                    Browse Services
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($purchases as $purchase)
                    @php
                        $service = $purchase->servicePlan?->service;
                        $plan = $purchase->servicePlan;
                    @endphp
                    <div class="bg-white rounded-card shadow-card overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 text-xs text-muted uppercase tracking-wide mb-1">
                                        <span>{{ $service?->category?->name ?? 'Service' }}</span>
                                        @if($purchase->is_delivered)
                                            <span class="inline-flex items-center gap-1 text-success">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Delivered
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 text-warning">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Pending
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="font-display text-xl font-bold">{{ $service?->title ?? 'Unknown Service' }}</h3>
                                    <p class="text-sm text-muted mt-0.5">{{ $plan?->name }}</p>
                                </div>
                                <div class="text-right shrink-0">
                                    <div class="text-lg font-bold">${{ number_format($plan?->price ?? 0, 2) }}</div>
                                    <a href="{{ route('orders.show', $purchase->order_id) }}" class="text-xs text-accent hover:underline">View Order</a>
                                </div>
                            </div>

                            @if($purchase->is_delivered)
                                <div class="mt-5 pt-5 border-t border-gray-100 space-y-3">
                                    @if($purchase->download_url)
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm font-medium text-gray-700">Download</span>
                                            <a href="{{ $purchase->download_url }}" target="_blank"
                                               class="inline-flex items-center gap-1.5 px-4 py-2 bg-accent text-white text-sm rounded-btn hover:bg-accent-hover transition font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                Download
                                            </a>
                                        </div>
                                    @endif
                                    @if($purchase->credentials)
                                        <div>
                                            <span class="text-sm font-medium text-gray-700 block mb-1">Credentials / Access Info</span>
                                            <div class="bg-gray-50 rounded-lg p-3 text-sm text-gray-600 font-mono">{!! nl2br(e($purchase->credentials)) !!}</div>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="mt-5 pt-5 border-t border-gray-100">
                                    <div class="flex items-center gap-2 text-sm text-warning">
                                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>Awaiting delivery — the provider will share access details soon.</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</x-app-layout>
