<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\ServicePlan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = Cart::with(['items.itemable', 'coupon'])
            ->where('user_id', auth()->id())
            ->first();

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, string $type, int $id): RedirectResponse
    {
        $model = match ($type) {
            'course' => Course::findOrFail($id),
            'service-plan' => ServicePlan::with('service')->findOrFail($id),
            default => abort(404),
        };

        if ($type === 'course' && (! $model->is_published ?? true)) {
            abort(404);
        }

        if ($type === 'service-plan' && (! $model->is_active || ! $model->service?->is_published)) {
            abort(404);
        }

        if ($model->is_free ?? false) {
            return redirect()->back()->with('error', 'Free items cannot be added to cart. Enroll directly.');
        }

        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        $exists = CartItem::where('cart_id', $cart->id)
            ->where('itemable_type', get_class($model))
            ->where('itemable_id', $model->id)
            ->exists();

        if ($exists) {
            return redirect()->route('cart.index')->with('info', 'Item already in cart.');
        }

        $price = $model->discount_price ?? $model->price ?? $model->starting_price ?? 0;

        CartItem::create([
            'cart_id' => $cart->id,
            'itemable_type' => get_class($model),
            'itemable_id' => $model->id,
            'price' => $price,
        ]);

        return redirect()->route('cart.index')->with('success', 'Item added to cart.');
    }

    public function remove(int $itemId): RedirectResponse
    {
        $cart = Cart::where('user_id', auth()->id())->firstOrFail();
        $item = CartItem::where('cart_id', $cart->id)->findOrFail($itemId);
        $item->delete();

        if ($cart->items()->count() === 0) {
            $cart->update(['coupon_id' => null]);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function applyCoupon(Request $request): RedirectResponse
    {
        $request->validate(['code' => 'required|string|max:50']);

        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (! $coupon || ! $coupon->isValid()) {
            return redirect()->back()->with('error', 'Invalid or expired coupon code.');
        }

        $cart = Cart::with('items')->where('user_id', auth()->id())->firstOrFail();

        if ($coupon->min_total && $cart->subtotal() < $coupon->min_total) {
            return redirect()->back()->with('error', "This coupon requires a minimum subtotal of \${$coupon->min_total}. Your current subtotal is \${$cart->subtotal()}.");
        }

        $cart->update(['coupon_id' => $coupon->id]);

        return redirect()->back()->with('success', 'Coupon applied successfully.');
    }

    public function removeCoupon(): RedirectResponse
    {
        $cart = Cart::where('user_id', auth()->id())->firstOrFail();
        $cart->update(['coupon_id' => null]);

        return redirect()->back()->with('success', 'Coupon removed.');
    }
}
