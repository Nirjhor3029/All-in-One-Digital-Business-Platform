<?php

namespace App\Http\Controllers;

use App\Models\Subscription;

class MySubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with(['servicePlan.service', 'order', 'paymentRecords'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('my-subscriptions.index', compact('subscriptions'));
    }

    public function cancel(Subscription $subscription)
    {
        abort_if($subscription->user_id !== auth()->id(), 403);

        if (! in_array($subscription->status, ['active', 'trial'])) {
            return back()->with('error', 'This subscription cannot be cancelled.');
        }

        $subscription->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        return back()->with('success', 'Subscription cancelled successfully.');
    }
}
