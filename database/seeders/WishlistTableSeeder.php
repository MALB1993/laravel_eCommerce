<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WishlistTableSeeder extends Seeder
{
    public function run()
    {
        $userIds = [1, 2, 3]; // Ensure these user IDs exist in the users table
        $productIds = [1, 2, 3, 4, 5]; // Ensure these product IDs exist in the products table

        $wishlists = [
            [
                'user_id' => $userIds[array_rand($userIds)],
                'product_id' => $productIds[array_rand($productIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userIds[array_rand($userIds)],
                'product_id' => $productIds[array_rand($productIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userIds[array_rand($userIds)],
                'product_id' => $productIds[array_rand($productIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more sample data as needed
        ];

        foreach ($wishlists as $wishlist) {
            DB::table('wishlist')->insert($wishlist);
        }
    }
}
