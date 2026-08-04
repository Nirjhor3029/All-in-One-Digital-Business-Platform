<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        $coupons = [
            [
                'code' => 'WELCOME10',
                'type' => 'percentage',
                'value' => 10,
                'min_total' => 100,
                'max_uses' => 100,
                'used_count' => 0,
                'expires_at' => now()->addMonths(3),
                'is_active' => true,
            ],
            [
                'code' => 'SAVE500',
                'type' => 'fixed',
                'value' => 500,
                'min_total' => 5000,
                'max_uses' => 50,
                'used_count' => 0,
                'expires_at' => now()->addMonths(2),
                'is_active' => true,
            ],
            [
                'code' => 'SUMMER25',
                'type' => 'percentage',
                'value' => 25,
                'min_total' => 200,
                'max_uses' => 200,
                'used_count' => 5,
                'expires_at' => now()->subDays(5),
                'is_active' => false,
            ],
            [
                'code' => 'FREESHIP',
                'type' => 'fixed',
                'value' => 100,
                'min_total' => 1000,
                'max_uses' => null,
                'used_count' => 0,
                'expires_at' => now()->addMonths(1),
                'is_active' => true,
            ],
        ];

        foreach ($coupons as $coupon) {
            Coupon::create($coupon);
        }
    }
}