<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class BrandsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('brands')->insert([
                'name' => $faker->company,
                'slug' => Str::slug($faker->unique()->company),
                'is_active' => $faker->boolean(80),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ]);
        }
    }
}
