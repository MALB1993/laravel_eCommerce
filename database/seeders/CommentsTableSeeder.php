<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $products = DB::table('products')->pluck('id');
        $users = DB::table('users')->pluck('id');

        
        foreach ($products as $productId) {
            
            $randomUsers = $users->random(rand(1, 5));

            foreach ($randomUsers as $userId) {
                DB::table('comments')->insert([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'approved' => $faker->boolean(80), 
                    'text' => $faker->paragraph,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null
                ]);
            }
        }
    }
}
