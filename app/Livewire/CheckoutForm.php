<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Order;
use App\Services\SslCommerzService;
use Livewire\Component;

class CheckoutForm extends Component
{
    public ?Cart $cart = null;
    public string $billingName = '';
    public string $billingEmail = '';
    public string $billingPhone = '';
    public string $billingAddress = '';

    protected function rules(): array
    {
        return [
            'billingName' => 'required|string|max:255',
            'billingEmail' => 'required|email|max:255',
            'billingPhone' => 'required|string|max:20',
            'billingAddress' => 'required|string',
        ];
    }

    public function mount(): void
    {
        $user = auth()->user();

        $this->cart = Cart::with(['items.itemable', 'coupon'])
            ->where('user_id', auth()->id())
            ->first();

        if ($user) {
            $this->billingName = $user->name;
            $this->billingEmail = $user->email;
        }
    }

    public function submit(): void
    {
        $this->validate();

        if (! $this->cart || $this->cart->items->isEmpty()) {
            $this->addError('form', 'Your cart is empty.');
            return;
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'subtotal' => $this->cart->subtotal(),
            'discount' => $this->cart->discount(),
            'total' => $this->cart->total(),
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'coupon_id' => $this->cart->coupon_id,
            'billing_name' => $this->billingName,
            'billing_email' => $this->billingEmail,
            'billing_phone' => $this->billingPhone,
            'billing_address' => $this->billingAddress,
        ]);

        foreach ($this->cart->items as $item) {
            $order->items()->create([
                'itemable_type' => $item->itemable_type,
                'itemable_id' => $item->itemable_id,
                'price' => $item->price,
            ]);
        }

        if ($this->cart->coupon) {
            $this->cart->coupon->increment('used_count');
        }

        $this->cart->items()->delete();
        $this->cart->update(['coupon_id' => null]);

        $sslCommerz = app(SslCommerzService::class);
        $response = $sslCommerz->initiatePayment($order);

        if ($response && ($response['status'] === 'SUCCESS' || isset($response['GatewayPageURL']))) {
            $this->redirect($response['GatewayPageURL']);
            return;
        }

        $this->redirect(route('checkout.success', $order));
    }

    public function render()
    {
        return view('livewire.checkout-form');
    }
}
