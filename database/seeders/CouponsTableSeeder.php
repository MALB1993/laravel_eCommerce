<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CouponsTableSeeder extends Seeder
{
    public function run()
    {
        $coupons = [
            [
                'name' => 'Summer Sale',
                'code' => 'SUMMER2024',
                'type' => 'percentage',
                'percentage' => 20,
                'amount' => null,
                'max_percentage_amount' => 50,
                'expired_at' => now()->addMonths(2),
                'description' => '20% off on all summer items. Max discount of $50.',
            ],
            [
                'name' => 'Black Friday Deal',
                'code' => 'BLACKFRIDAY',
                'type' => 'amount',
                'percentage' => null,
                'amount' => 100,
                'max_percentage_amount' => null,
                'expired_at' => now()->addMonth(),
                'description' => 'Save $100 on any purchase during Black Friday.',
            ],
            [
                'name' => 'Holiday Discount',
                'code' => 'HOLIDAY2024',
                'type' => 'percentage',
                'percentage' => 15,
                'amount' => null,
                'max_percentage_amount' => null,
                'expired_at' => now()->addWeeks(3),
                'description' => '15% off on holiday items.',
            ],
        ];

        foreach ($coupons as $coupon) {
            DB::table('coupons')->insert($coupon);
        }
    }
}
