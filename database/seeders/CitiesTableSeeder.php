<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // دریافت لیست تمامی استان‌ها
        $provinces = DB::table('provinces')->pluck('id');

        // تعداد شهرهایی که می‌خواهید اضافه کنید
        $numberOfCitiesPerProvince = 5;

        foreach ($provinces as $provinceId) {
            for ($i = 0; $i < $numberOfCitiesPerProvince; $i++) {
                DB::table('cities')->insert([
                    'province_id' => $provinceId,
                    'name' => $faker->city, // نام شهر تصادفی
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
