<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductImagesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $products = DB::table('products')->get();

        foreach ($products as $product) {

            for ($i = 0; $i < 3; $i++) {
                DB::table('product_images')->insert([
                    'product_id' => $product->id,
                    'image' => $faker->imageUrl(640, 480, 'product'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
