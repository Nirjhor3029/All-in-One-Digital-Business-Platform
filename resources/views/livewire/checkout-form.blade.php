<div>
    <form wire:submit="submit">
        <div class="grid lg:grid-cols-5 gap-8">
            <div class="lg:col-span-3 space-y-6">
                <div class="bg-white rounded-card shadow-card p-6">
                    <h3 class="font-semibold text-lg mb-4">Billing Details</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" wire:model="billingName"
                                   class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                            @error('billingName') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" wire:model="billingEmail"
                                       class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                                @error('billingEmail') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                <input type="tel" wire:model="billingPhone"
                                       class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                                @error('billingPhone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <textarea wire:model="billingAddress" rows="3"
                                      class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent"></textarea>
                            @error('billingAddress') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-card shadow-card p-6 sticky top-24">
                    <h3 class="font-semibold text-lg mb-4">Order Summary</h3>

                    <div class="space-y-3 text-sm">
                        @if($cart)
                            @foreach($cart->items as $item)
                                <div class="flex justify-between">
                                    <span class="truncate">{{ $item->itemable->title ?? 'Item' }}</span>
                                    <span class="font-medium shrink-0">${{ number_format($item->price, 2) }}</span>
                                </div>
                            @endforeach
                        @endif

                        <div class="border-t pt-3 flex justify-between">
                            <span class="text-muted">Subtotal</span>
                            <span>${{ number_format($cart?->subtotal() ?? 0, 2) }}</span>
                        </div>

                        @if($cart && $cart->coupon)
                            <div class="flex justify-between text-success">
                                <span>Discount</span>
                                <span>-${{ number_format($cart->discount(), 2) }}</span>
                            </div>
                        @endif

                        <div class="border-t pt-3 flex justify-between font-semibold text-lg">
                            <span>Total</span>
                            <span>${{ number_format($cart?->total() ?? 0, 2) }}</span>
                        </div>
                    </div>

                    <button type="submit"
                            class="mt-6 w-full px-4 py-3 bg-accent text-white rounded-btn hover:bg-accent-hover transition font-semibold"
                            wire:loading.attr="disabled"
                            wire:target="submit">
                        <span wire:loading.remove wire:target="submit">Place Order</span>
                        <span wire:loading wire:target="submit">Processing...</span>
                    </button>

                    @error('form') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </form>
</div>
