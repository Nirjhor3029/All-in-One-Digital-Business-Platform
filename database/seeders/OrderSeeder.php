<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ServicePlan;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@apnarbusiness.com')->first();
        $user = User::where('email', 'user@apnarbusiness.com')->first();

        $automationCourse = Course::where('slug', 'automation-masterclass')->first();
        $scaleCourse = Course::where('slug', 'the-scale-framework')->first();
        $welcomeCoupon = Coupon::where('code', 'WELCOME10')->first();

        // Order 1: Admin purchased Automation course + SaaS Product plan
        $order1 = Order::create([
            'user_id' => $admin->id,
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'subtotal' => 22000,
            'discount' => 2200,
            'total' => 19800,
            'status' => 'delivered',
            'payment_status' => 'paid',
            'payment_method' => 'sslcommerz',
            'coupon_id' => $welcomeCoupon->id,
            'billing_name' => 'Super Admin',
            'billing_email' => 'admin@apnarbusiness.com',
            'billing_phone' => '+8801700000000',
            'billing_address' => 'Dhaka, Bangladesh',
        ]);
        OrderItem::create(['order_id' => $order1->id, 'itemable_type' => Course::class, 'itemable_id' => $automationCourse->id, 'price' => 12000]);
        $saasPlan = ServicePlan::where('name', 'Professional')->first();
        if ($saasPlan) {
            OrderItem::create(['order_id' => $order1->id, 'itemable_type' => ServicePlan::class, 'itemable_id' => $saasPlan->id, 'price' => 10000]);
        }
        Transaction::create([
            'order_id' => $order1->id,
            'transaction_id' => 'TXN-' . strtoupper(Str::random(12)),
            'gateway' => 'sslcommerz',
            'amount' => 19800,
            'status' => 'completed',
            'gateway_response' => json_encode(['status' => 'success', 'gateway' => 'sslcommerz']),
        ]);

        // Order 2: User purchased Scale Framework course
        $order2 = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'subtotal' => 15000,
            'discount' => 3000,
            'total' => 12000,
            'status' => 'processing',
            'payment_status' => 'paid',
            'payment_method' => 'bkash',
            'coupon_id' => $welcomeCoupon->id,
            'billing_name' => 'Regular User',
            'billing_email' => 'user@apnarbusiness.com',
            'billing_phone' => '+8801700000001',
            'billing_address' => 'Chittagong, Bangladesh',
        ]);
        OrderItem::create(['order_id' => $order2->id, 'itemable_type' => Course::class, 'itemable_id' => $scaleCourse->id, 'price' => 12000]);
        Transaction::create([
            'order_id' => $order2->id,
            'transaction_id' => 'TXN-' . strtoupper(Str::random(12)),
            'gateway' => 'bkash',
            'amount' => 12000,
            'status' => 'completed',
            'gateway_response' => json_encode(['status' => 'success', 'method' => 'bkash']),
        ]);

        // Order 3: User - Failed Payment
        $order3 = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'subtotal' => 8000,
            'discount' => 0,
            'total' => 8000,
            'status' => 'cancelled',
            'payment_status' => 'failed',
            'payment_method' => 'sslcommerz',
            'billing_name' => 'Regular User',
            'billing_email' => 'user@apnarbusiness.com',
            'billing_phone' => '+8801700000001',
            'billing_address' => 'Chittagong, Bangladesh',
        ]);
        OrderItem::create(['order_id' => $order3->id, 'itemable_type' => Course::class, 'itemable_id' => $scaleCourse->id, 'price' => 8000]);
        Transaction::create([
            'order_id' => $order3->id,
            'transaction_id' => 'TXN-' . strtoupper(Str::random(12)),
            'gateway' => 'sslcommerz',
            'amount' => 8000,
            'status' => 'failed',
            'gateway_response' => json_encode(['status' => 'FAILED', 'error' => 'Card declined']),
        ]);
    }
}