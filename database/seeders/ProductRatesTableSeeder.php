<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductRatesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        
        $products = DB::table('products')->pluck('id');
        $users = DB::table('users')->pluck('id');


        $numberOfRatingsPerProduct = 5;

        foreach ($products as $productId) {
            
            $randomUsers = $users->random($numberOfRatingsPerProduct);

            foreach ($randomUsers as $userId) {
                DB::table('product_rates')->insert([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'rate' => $faker->numberBetween(1, 5), 
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
