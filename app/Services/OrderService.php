<?php

namespace App\Services;

use App\Models\Enrollment;
use App\Models\Order;
use App\Models\ServicePlan;
use App\Models\ServicePurchase;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Notifications\PlatformNotification;

class OrderService
{
    public function createEnrollments(Order $order): void
    {
        if ($order->status === 'cancelled' || $order->status === 'refunded') return;

        foreach ($order->items as $item) {
            if ($item->itemable_type === 'App\Models\Course') {
                Enrollment::firstOrCreate([
                    'user_id' => $order->user_id,
                    'course_id' => $item->itemable_id,
                ], ['status' => 'active']);
            }

            if ($item->itemable_type === 'App\Models\ServicePlan') {
                $plan = ServicePlan::find($item->itemable_id);

                if ($plan && $plan->is_subscription) {
                    $now = now();
                    $periodEnd = $plan->billing_interval === 'yearly'
                        ? $now->copy()->addYear()
                        : $now->copy()->addMonth();

                    Subscription::create([
                        'user_id' => $order->user_id,
                        'service_plan_id' => $item->itemable_id,
                        'order_id' => $order->id,
                        'status' => $plan->trial_days ? 'trial' : 'active',
                        'trial_ends_at' => $plan->trial_days
                            ? $now->copy()->addDays($plan->trial_days)
                            : null,
                        'current_period_start' => $now,
                        'current_period_end' => $plan->trial_days
                            ? $now->copy()->addDays($plan->trial_days)
                            : $periodEnd,
                    ]);
                } else {
                    ServicePurchase::create([
                        'user_id' => $order->user_id,
                        'service_plan_id' => $item->itemable_id,
                        'order_id' => $order->id,
                        'status' => 'active',
                    ]);
                }
            }
        }

        if ($order->status === 'pending') {
            $order->updateQuietly(['status' => 'processing']);
        }
    }

    public function markPaid(Order $order): void
    {
        $order->update(['payment_status' => 'paid', 'payment_method' => 'manual']);

        Transaction::create([
            'order_id' => $order->id,
            'transaction_id' => 'MANUAL-' . strtoupper(uniqid()),
            'gateway' => 'manual',
            'amount' => $order->total,
            'status' => 'success',
        ]);

        try {
            $order->user->notify(new PlatformNotification(
                title: 'Payment Confirmed',
                body: "Your payment for order #{$order->order_number} has been confirmed. You now have access to your purchases.",
                url: route('orders.show', $order),
                icon: 'check-circle',
            ));
        } catch (\Exception $e) {}
    }
}
