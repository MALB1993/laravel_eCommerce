<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('products')->insert([
                'name' => $faker->word,
                'brand_id' => DB::table('brands')->inRandomOrder()->first()->id,
                'category_id' => DB::table('categories')->inRandomOrder()->first()->id,
                'slug' => Str::slug($faker->unique()->words(3, true)),
                'primary_image' => $faker->imageUrl(640, 480, 'product'),
                'description' => $faker->paragraph,
                'status' => 1,
                'is_active' => $faker->boolean(80),
                'delivery_amount' => $faker->numberBetween(1000, 5000),
                'delivery_amount_per_product' => $faker->numberBetween(100, 500),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ]);
        }
        
    }
}
