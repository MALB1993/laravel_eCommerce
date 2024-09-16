<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AttributeCategoryTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // دریافت لیست تمامی ویژگی‌ها و دسته‌بندی‌ها
        $attributes = DB::table('attributes')->pluck('id');
        $categories = DB::table('categories')->pluck('id');

        // تعداد ویژگی‌ها برای هر دسته‌بندی
        $numberOfAttributesPerCategory = 3;

        foreach ($categories as $categoryId) {
            // انتخاب تصادفی ویژگی‌ها برای هر دسته‌بندی
            $randomAttributes = $attributes->random($numberOfAttributesPerCategory);

            foreach ($randomAttributes as $attributeId) {
                DB::table('attribute_category')->insert([
                    'attribute_id' => $attributeId,
                    'category_id' => $categoryId,
                    'is_filter' => $faker->boolean(50), // 50 درصد ویژگی‌ها به‌عنوان فیلتر
                    'is_variation' => $faker->boolean(50), // 50 درصد ویژگی‌ها به‌عنوان واریاسیون
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null
                ]);
            }
        }
    }
}
