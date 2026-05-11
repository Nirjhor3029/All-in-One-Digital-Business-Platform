<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');
Route::post('/courses/{course:slug}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/courses/{course:slug}/learn/{lecture:slug}', [LearningController::class, 'player'])
        ->middleware('enrolled')
        ->withoutScopedBindings()
        ->name('learn.player');
    Route::post('/lectures/{lecture}/complete', [LearningController::class, 'markComplete'])
        ->name('lectures.complete');
    Route::get('/courses/{course:slug}/progress', [LearningController::class, 'progress'])
        ->name('courses.progress');
});

Route::get('/about', fn () => view('pages.about'))->name('about');
Route::get('/contact', fn () => view('pages.contact'))->name('contact');
Route::get('/faq', fn () => view('pages.faq'))->name('faq');
Route::get('/privacy-policy', fn () => view('pages.privacy'))->name('privacy');
Route::get('/terms', fn () => view('pages.terms'))->name('terms');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Cart
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{type}/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{itemId}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/apply-coupon', [App\Http\Controllers\CartController::class, 'applyCoupon'])->name('cart.apply-coupon');
    Route::post('/cart/remove-coupon', [App\Http\Controllers\CartController::class, 'removeCoupon'])->name('cart.remove-coupon');

    // Checkout
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/failed/{order}', [App\Http\Controllers\CheckoutController::class, 'failed'])->name('checkout.failed');

    // Wishlist
    Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{type}/{id}', [App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Payment (no auth middleware — SSLCommerz calls these)
Route::post('/payment/success', [App\Http\Controllers\PaymentController::class, 'sslSuccess'])->name('payment.success');
Route::post('/payment/fail', [App\Http\Controllers\PaymentController::class, 'sslFail'])->name('payment.fail');
Route::post('/payment/cancel', [App\Http\Controllers\PaymentController::class, 'sslCancel'])->name('payment.cancel');
Route::post('/payment/ipn', [App\Http\Controllers\PaymentController::class, 'sslIpn'])->name('payment.ipn');

require __DIR__.'/auth.php';
