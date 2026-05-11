<x-app-layout>
    <x-slot:title>My Subscriptions - {{ config('app.name') }}</x-slot:title>

    <section class="py-12 max-w-6xl mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <h1 class="font-display text-3xl font-bold">My Subscriptions</h1>
        </div>

        @if($subscriptions->isEmpty())
            <div class="text-center py-16">
                <svg class="w-24 h-24 text-gray-200 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                <h2 class="text-2xl font-display font-semibold text-gray-400 mb-2">No subscriptions yet</h2>
                <p class="text-muted mb-8">Subscribe to a service to get started.</p>
                <a href="{{ route('services.index') }}" class="inline-flex items-center px-8 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold">
                    Browse Services
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($subscriptions as $sub)
                    @php
                        $service = $sub->servicePlan?->service;
                        $plan = $sub->servicePlan;
                    @endphp
                    <div class="bg-white rounded-card shadow-card overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 text-xs text-muted uppercase tracking-wide mb-1">
                                        <span>{{ $service?->category?->name ?? 'Service' }}</span>
                                        <span class="px-2 py-0.5 rounded-full text-xs font-medium
                                            @if($sub->status === 'active') bg-green-100 text-green-700
                                            @elseif($sub->status === 'trial') bg-blue-100 text-blue-700
                                            @elseif($sub->status === 'suspended') bg-red-100 text-red-700
                                            @else bg-gray-100 text-gray-500
                                            @endif">
                                            {{ ucfirst($sub->status) }}
                                        </span>
                                        @if($sub->is_on_trial)
                                            <span class="text-blue-500 font-medium">Trial until {{ $sub->trial_ends_at->format('M d, Y') }}</span>
                                        @endif
                                    </div>
                                    <h3 class="font-display text-xl font-bold">{{ $service?->title ?? 'Unknown Service' }}</h3>
                                    <p class="text-sm text-muted mt-0.5">{{ $plan?->name }} — ${{ number_format($plan?->price ?? 0, 2) }}/{{ $plan?->billing_interval ?? 'mo' }}</p>
                                </div>
                                <div class="text-right shrink-0">
                                    <a href="{{ route('orders.show', $sub->order_id) }}" class="text-xs text-accent hover:underline">View Order</a>
                                </div>
                            </div>

                            @if($sub->current_period_end)
                                <div class="mt-4 flex items-center gap-2 text-sm text-muted">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    @if($sub->is_on_trial)
                                        <span>Trial period — billing starts {{ $sub->trial_ends_at->format('M d, Y') }}</span>
                                    @elseif(in_array($sub->status, ['active', 'trial']))
                                        <span>Next billing: {{ $sub->current_period_end->format('M d, Y') }}</span>
                                    @else
                                        <span>Period ended {{ $sub->current_period_end->format('M d, Y') }}</span>
                                    @endif
                                </div>
                            @endif

                            @if($sub->days_overdue > 0 && in_array($sub->status, ['active', 'trial']))
                                <div class="mt-3 flex items-center gap-2 text-sm text-warning">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                    <span>Payment overdue by {{ $sub->days_overdue }} day(s). Please pay to avoid suspension.</span>
                                </div>
                            @endif

                            @if(in_array($sub->status, ['active', 'trial']))
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <form action="{{ route('subscriptions.cancel', $sub) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to cancel this subscription?')">
                                        @csrf
                                        <button type="submit" class="text-sm text-red-500 hover:text-red-700 transition font-medium">
                                            Cancel Subscription
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</x-app-layout>
