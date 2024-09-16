<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionsTableSeeder extends Seeder
{
    public function run()
    {
        $userIds = [1, 2, 3]; // Ensure these user IDs exist in the users table
        $orderIds = [1, 2, 3]; // Ensure these order IDs exist in the orders table

        $transactions = [
            [
                'user_id' => $userIds[array_rand($userIds)],
                'order_id' => $orderIds[array_rand($orderIds)],
                'amount' => 1500,
                'ref_id' => Str::random(10),
                'token' => Str::random(20),
                'description' => 'Payment for order #1',
                'gateway_name' => 'pay',
                'status' => 1, // Example status
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userIds[array_rand($userIds)],
                'order_id' => $orderIds[array_rand($orderIds)],
                'amount' => 2500,
                'ref_id' => Str::random(10),
                'token' => Str::random(20),
                'description' => 'Payment for order #2',
                'gateway_name' => 'zarinpal',
                'status' => 0, // Example status
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userIds[array_rand($userIds)],
                'order_id' => $orderIds[array_rand($orderIds)],
                'amount' => 500,
                'ref_id' => Str::random(10),
                'token' => Str::random(20),
                'description' => 'Payment for order #3',
                'gateway_name' => 'pay',
                'status' => 1, // Example status
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($transactions as $transaction) {
            DB::table('transactions')->insert($transaction);
        }
    }
}
