<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserAddressesTableSeeder extends Seeder
{
    public function run()
    {
        // Sample data for users, provinces, and cities
        $userIds = [1, 2, 3]; // Ensure these user IDs exist in the users table
        $provinceIds = [1, 2, 3]; // Ensure these province IDs exist in the provinces table
        $cityIds = [1, 2, 3]; // Ensure these city IDs exist in the cities table

        foreach ($userIds as $userId) {
            DB::table('user_addresses')->insert([
                'user_id' => $userId,
                'title' => 'Home Address ' . Str::random(5),
                'address' => '123 Sample Street, Sample City',
                'cellphone' => '123-456-7890',
                'postal_code' => '12345',
                'province_id' => $provinceIds[array_rand($provinceIds)],
                'city_id' => $cityIds[array_rand($cityIds)],
                'longitude' => '40.7128',
                'latitude' => '-74.0060',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
