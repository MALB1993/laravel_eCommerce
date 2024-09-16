<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $userIds = [1, 2, 3]; // Ensure these user IDs exist in the users table
        $addressIds = [1, 2, 3]; // Ensure these address IDs exist in the user_addresses table
        $couponIds = [1, 2]; // Ensure these coupon IDs exist in the coupons table

        $orders = [
            [
                'user_id' => $userIds[array_rand($userIds)],
                'address_id' => $addressIds[array_rand($addressIds)],
                'coupon_id' => $couponIds[array_rand($couponIds)],
                'status' => 1, // Example status
                'total_amount' => 2000,
                'delivery_amount' => 100,
                'coupon_amount' => 100,
                'paying_amount' => 2000 - 100,
                'payment_type' => 'online',
                'payment_status' => 1,
                'description' => 'Order for electronics',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userIds[array_rand($userIds)],
                'address_id' => $addressIds[array_rand($addressIds)],
                'coupon_id' => null,
                'status' => 0, // Example status
                'total_amount' => 1500,
                'delivery_amount' => 50,
                'coupon_amount' => 0,
                'paying_amount' => 1500,
                'payment_type' => 'cash',
                'payment_status' => 0,
                'description' => 'Order for books',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userIds[array_rand($userIds)],
                'address_id' => $addressIds[array_rand($addressIds)],
                'coupon_id' => null,
                'status' => 2, // Example status
                'total_amount' => 500,
                'delivery_amount' => null,
                'coupon_amount' => 0,
                'paying_amount' => 500,
                'payment_type' => 'pos',
                'payment_status' => 1,
                'description' => 'Order for groceries',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($orders as $order) {
            DB::table('orders')->insert($order);
        }
    }
}
