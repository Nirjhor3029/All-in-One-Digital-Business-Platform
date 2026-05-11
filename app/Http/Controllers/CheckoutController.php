<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Services\SslCommerzService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View
    {
        $cart = Cart::with(['items.itemable', 'coupon'])
            ->where('user_id', auth()->id())
            ->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $user = auth()->user();

        return view('checkout.index', compact('cart', 'user'));
    }

    public function process(Request $request): RedirectResponse
    {
        $request->validate([
            'billing_name' => 'required|string|max:255',
            'billing_email' => 'required|email|max:255',
            'billing_phone' => 'required|string|max:20',
            'billing_address' => 'required|string',
        ]);

        $cart = Cart::with(['items.itemable', 'coupon'])
            ->where('user_id', auth()->id())
            ->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'subtotal' => $cart->subtotal(),
            'discount' => $cart->discount(),
            'total' => $cart->total(),
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'coupon_id' => $cart->coupon_id,
            'billing_name' => $request->billing_name,
            'billing_email' => $request->billing_email,
            'billing_phone' => $request->billing_phone,
            'billing_address' => $request->billing_address,
        ]);

        foreach ($cart->items as $item) {
            $order->items()->create([
                'itemable_type' => $item->itemable_type,
                'itemable_id' => $item->itemable_id,
                'price' => $item->price,
            ]);
        }

        if ($cart->coupon_id && $cart->coupon) {
            $cart->coupon->increment('used_count');
        }

        $cart->items()->delete();
        $cart->update(['coupon_id' => null]);

        $sslCommerz = app(SslCommerzService::class);
        $response = $sslCommerz->initiatePayment($order);

        if ($response && ($response['status'] === 'SUCCESS' || isset($response['GatewayPageURL']))) {
            return redirect()->away($response['GatewayPageURL']);
        }

        $order->update(['payment_status' => 'failed']);
        return redirect()->route('checkout.failed', $order)
            ->with('error', 'Payment gateway initiation failed. Please try again.');
    }

    public function success(Order $order): View
    {
        abort_if($order->user_id !== auth()->id(), 403);
        return view('checkout.success', compact('order'));
    }

    public function failed(Order $order): View
    {
        abort_if($order->user_id !== auth()->id(), 403);
        return view('checkout.failed', compact('order'));
    }
}
