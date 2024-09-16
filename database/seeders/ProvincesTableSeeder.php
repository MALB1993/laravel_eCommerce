<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProvincesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // تعداد استان‌هایی که می‌خواهید اضافه کنید
        $numberOfProvinces = 10;

        for ($i = 0; $i < $numberOfProvinces; $i++) {
            DB::table('provinces')->insert([
                'name' => $faker->unique()->state, // نام استان تصادفی
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
