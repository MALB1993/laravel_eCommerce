<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductAttributesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // دریافت لیست تمامی محصولات و ویژگی‌ها
        $products = DB::table('products')->pluck('id');
        $attributes = DB::table('attributes')->pluck('id');

        // تعداد ویژگی‌ها برای هر محصول
        $numberOfAttributesPerProduct = 3;

        foreach ($products as $productId) {
            // انتخاب تصادفی ویژگی‌ها برای هر محصول
            $randomAttributes = $attributes->random($numberOfAttributesPerProduct);

            foreach ($randomAttributes as $attributeId) {
                DB::table('product_attributes')->insert([
                    'attribute_id' => $attributeId,
                    'product_id' => $productId,
                    'value' => $faker->word, // مقدار تصادفی برای ویژگی
                    'is_active' => $faker->boolean(80), // 80 درصد ویژگی‌ها فعال
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null
                ]);
            }
        }
    }
}
