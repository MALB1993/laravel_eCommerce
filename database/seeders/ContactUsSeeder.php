<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ContactUsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        DB::table('contact_us')->insert([
            [
                'name'    => $faker->name,
                'email'   => $faker->email,
                'subject' => $faker->sentence,
                'text'    => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'    => $faker->name,
                'email'   => $faker->email,
                'subject' => $faker->sentence,
                'text'    => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more rows as needed
        ]);
    }
}
