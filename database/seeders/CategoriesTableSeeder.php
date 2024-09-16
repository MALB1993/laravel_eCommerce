<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('categories')->insert([
                'parent_id' => $faker->numberBetween(0, 5),
                'name' => $faker->word,
                'slug' => Str::slug($faker->unique()->words(2, true)),
                'description' => $faker->sentence,
                'is_active' => $faker->boolean(80),
                'icon' => $faker->optional()->imageUrl(50, 50, 'icons'),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ]);
        }
    }
}
