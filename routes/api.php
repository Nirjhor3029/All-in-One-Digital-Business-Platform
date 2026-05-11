<?php

use App\Http\Controllers\Api\SubscriptionVerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/subscriptions/verify', [SubscriptionVerificationController::class, 'verify'])
    ->name('api.subscriptions.verify');
