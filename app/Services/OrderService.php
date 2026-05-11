<?php

namespace App\Services;

use App\Models\Enrollment;
use App\Models\Order;
use App\Models\ServicePurchase;
use App\Models\Transaction;

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
                ServicePurchase::create([
                    'user_id' => $order->user_id,
                    'service_plan_id' => $item->itemable_id,
                    'order_id' => $order->id,
                    'status' => 'active',
                ]);
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
    }
}
