<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductVariationsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // دریافت لیست تمامی محصولات و ویژگی‌ها
        $products = DB::table('products')->pluck('id');
        $attributes = DB::table('attributes')->pluck('id');

        // تعداد واریاسیون‌ها برای هر محصول
        $numberOfVariationsPerProduct = 3;

        foreach ($products as $productId) {
            // انتخاب تصادفی ویژگی‌ها برای هر محصول
            $randomAttributes = $attributes->random($numberOfVariationsPerProduct);

            foreach ($randomAttributes as $attributeId) {
                DB::table('product_variations')->insert([
                    'attribute_id' => $attributeId,
                    'product_id' => $productId,
                    'value' => $faker->word, // مقدار تصادفی برای ویژگی
                    'price' => $faker->numberBetween(1000, 10000), // قیمت تصادفی بین 1000 تا 10000
                    'quantity' => $faker->numberBetween(1, 100), // مقدار تصادفی بین 1 تا 100
                    'sku' => $faker->uuid, // شناسه SKU تصادفی
                    'sale_price' => $faker->optional()->numberBetween(1000, 9000), // قیمت فروش تصادفی (اختیاری)
                    'date_on_sale_from' => $faker->optional()->dateTimeBetween('now', '+1 month'), // تاریخ شروع فروش (اختیاری)
                    'date_on_sale_to' => $faker->optional()->dateTimeBetween('+1 month', '+2 months'), // تاریخ پایان فروش (اختیاری)
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null
                ]);
            }
        }
    }
}
