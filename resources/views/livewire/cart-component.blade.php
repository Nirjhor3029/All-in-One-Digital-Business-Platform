<div>
    @if(!$cart || $cart->items->isEmpty())
        <div class="text-center py-24">
            <svg class="w-24 h-24 text-gray-200 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
            </svg>
            <h2 class="text-2xl font-display font-semibold text-gray-400 mb-2">Your cart is empty</h2>
            <p class="text-muted mb-8">Looks like you haven't added anything yet.</p>
            <a href="{{ route('courses.index') }}" class="inline-flex items-center px-8 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold">
                Browse Courses
            </a>
        </div>
    @else
        <div class="grid lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="font-display text-xl font-bold">Cart Items ({{ $cart->items->count() }})</h2>
                </div>

                @foreach($cart->items as $item)
                    @php
                        $isServicePlan = $item->itemable_type === 'App\Models\ServicePlan';
                        if ($isServicePlan) {
                            $plan = $item->itemable;
                            $service = $plan?->service;
                            $img = $service?->thumbnail_url;
                            $title = $service?->title . ' — ' . $plan?->name;
                            $provider = $service?->provider?->name;
                            $typeLabel = 'Service';
                            $itemLink = $service ? route('services.show', $service->slug) : '#';
                        } else {
                            $img = $item->itemable?->thumbnail_url;
                            $title = $item->itemable->title ?? 'Item';
                            $provider = method_exists($item->itemable, 'instructor') ? $item->itemable?->instructor?->name : null;
                            $typeLabel = class_basename($item->itemable_type);
                            $itemLink = $item->itemable?->slug ? route('courses.show', $item->itemable->slug) : '#';
                        }
                    @endphp
                    <div class="bg-white rounded-card shadow-card p-5 flex items-start gap-5 hover:shadow-card-hover transition-shadow">
                        <div class="w-28 h-20 shrink-0 rounded-lg overflow-hidden bg-gray-100">
                            @if($img)
                                <img src="{{ $img }}" alt="{{ $title }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-muted text-xs">
                                    No Image
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <a href="{{ $itemLink }}">
                                <h3 class="font-semibold text-base truncate hover:text-accent transition">{{ $title }}</h3>
                            </a>
                            <p class="text-xs text-muted mt-0.5">{{ $typeLabel }}</p>
                            @if($provider)
                                <p class="text-xs text-muted mt-1">By {{ $provider }}</p>
                            @endif
                        </div>

                        <div class="text-right shrink-0">
                            <div class="font-bold text-lg text-primary">${{ number_format($item->price, 2) }}</div>
                            <button wire:click="removeItem({{ $item->id }})"
                                    wire:loading.attr="disabled"
                                    wire:target="removeItem({{ $item->id }})"
                                    class="text-sm text-red-400 hover:text-red-600 mt-2 transition">
                                <span wire:loading.remove wire:target="removeItem({{ $item->id }})">Remove</span>
                                <span wire:loading wire:target="removeItem({{ $item->id }})">Removing...</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-card shadow-card p-6 sticky top-24">
                    <h3 class="font-display font-bold text-lg mb-5 pb-4 border-b border-gray-100">Order Summary</h3>

                    <div class="space-y-3 text-sm">
                        @foreach($cart->items as $item)
                            @php
                                $summaryTitle = $item->itemable_type === 'App\Models\ServicePlan'
                                    ? ($item->itemable?->service?->title ?? '') . ' — ' . ($item->itemable?->name ?? '')
                                    : ($item->itemable->title ?? 'Item');
                            @endphp
                            <div class="flex justify-between text-sm">
                                <span class="text-muted truncate mr-2">{{ \Illuminate\Support\Str::limit($summaryTitle, 30) }}</span>
                                <span class="font-medium shrink-0">${{ number_format($item->price, 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-100 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-muted">Subtotal</span>
                            <span class="font-medium">${{ number_format($cart->subtotal(), 2) }}</span>
                        </div>

                        @if($cart->coupon)
                            <div class="flex justify-between text-sm text-success">
                                <span>Discount</span>
                                <span>-${{ number_format($cart->discount(), 2) }}</span>
                            </div>
                            <button wire:click="removeCoupon"
                                    class="text-xs text-red-400 hover:text-red-600 transition">
                                Remove coupon
                            </button>
                        @endif

                        <div class="flex justify-between font-bold text-lg pt-3 border-t border-gray-100">
                            <span>Total</span>
                            <span>${{ number_format($cart->total(), 2) }}</span>
                        </div>
                    </div>

                    @if(!$cart->coupon)
                        <form wire:submit="applyCoupon" class="mt-5 pt-4 border-t border-gray-100">
                            <label class="block text-xs font-medium text-gray-600 mb-1.5 uppercase tracking-wide">Coupon Code</label>
                            <div class="flex gap-2">
                                <input type="text" wire:model="couponCode" placeholder="Enter code"
                                       class="flex-1 rounded-lg border-gray-300 text-sm focus:border-accent focus:ring-accent px-3 py-2">
                                <button type="submit"
                                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium shrink-0">
                                    Apply
                                </button>
                            </div>
                            @error('couponCode') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </form>
                    @endif

                    <a href="{{ route('checkout.index') }}"
                       class="mt-6 flex items-center justify-center gap-2 w-full px-4 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold">
                        Proceed to Checkout
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>

                    <a href="{{ route('courses.index') }}"
                       class="mt-3 flex items-center justify-center gap-1 w-full text-center px-4 py-2 text-sm text-accent hover:text-accent-hover transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
