<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WishlistController extends Controller
{
    public function index(): View
    {
        $wishlists = Wishlist::with('wishlistable')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('wishlist.index', compact('wishlists'));
    }

    public function toggle(string $type, int $id): RedirectResponse
    {
        $modelClass = match ($type) {
            'course' => \App\Models\Course::class,
            default => abort(404),
        };

        $model = $modelClass::findOrFail($id);

        $existing = Wishlist::where('user_id', auth()->id())
            ->where('wishlistable_type', $modelClass)
            ->where('wishlistable_id', $model->id)
           ->first();

        if ($existing) {
            $existing->delete();
            return redirect()->back()->with('success', 'Removed from wishlist.');
        }

        Wishlist::create([
            'user_id' => auth()->id(),
            'wishlistable_type' => $modelClass,
            'wishlistable_id' => $model->id,
        ]);

        return redirect()->back()->with('success', 'Added to wishlist.');
    }
}
