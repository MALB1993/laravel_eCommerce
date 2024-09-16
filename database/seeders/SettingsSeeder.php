<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        DB::table('settings')->insert([
            [
                'image'        => $faker->imageUrl(),
                'brand'        => $faker->word,
                'address'      => $faker->address,
                'telephone'    => $faker->phoneNumber,
                'telephone2'   => $faker->phoneNumber,
                'longitude'    => $faker->longitude,
                'latitude'     => $faker->latitude,
                'telegram'     => $faker->userName,
                'instagram'    => $faker->userName,
                'facebook'     => $faker->userName,
                'twitter'      => $faker->userName,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
