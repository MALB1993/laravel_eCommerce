<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductTagTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $products = DB::table('products')->get();
        $tags = DB::table('tags')->get();

        foreach ($products as $product) {
            
            $randomTags = $tags->random(rand(1, 3));

            foreach ($randomTags as $tag) {
                DB::table('product_tag')->insert([
                    'product_id' => $product->id,
                    'tag_id' => $tag->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
