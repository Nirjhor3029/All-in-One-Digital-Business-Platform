<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Coupon;
use Livewire\Component;

class CartComponent extends Component
{
    public ?Cart $cart = null;
    public string $couponCode = '';

    protected $listeners = ['cartUpdated' => '$refresh'];

    public function mount(): void
    {
        $this->loadCart();
    }

    public function loadCart(): void
    {
        $this->cart = Cart::with(['items.itemable', 'coupon'])
            ->where('user_id', auth()->id())
            ->first();
    }

    public function removeItem(int $itemId): void
    {
        $cart = Cart::where('user_id', auth()->id())->firstOrFail();
        $item = $cart->items()->findOrFail($itemId);
        $item->delete();

        if ($cart->items()->count() === 0) {
            $cart->update(['coupon_id' => null]);
        }

        $this->loadCart();
        $this->dispatch('cart-updated');
    }

    public function applyCoupon(): void
    {
        $this->validate(['couponCode' => 'required|string|max:50']);

        $coupon = Coupon::where('code', strtoupper($this->couponCode))->first();

        if (! $coupon || ! $coupon->isValid()) {
            $this->addError('couponCode', 'Invalid or expired coupon code.');
            return;
        }

        $cart = Cart::where('user_id', auth()->id())->firstOrFail();

        if ($coupon->min_total && $cart->subtotal() < $coupon->min_total) {
            $this->addError('couponCode', "This coupon requires a minimum subtotal of \${$coupon->min_total}. Your current subtotal is \${$cart->subtotal()}.");
            return;
        }

        $cart->update(['coupon_id' => $coupon->id]);
        $this->couponCode = '';
        $this->loadCart();
    }

    public function removeCoupon(): void
    {
        $cart = Cart::where('user_id', auth()->id())->firstOrFail();
        $cart->update(['coupon_id' => null]);
        $this->loadCart();
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
