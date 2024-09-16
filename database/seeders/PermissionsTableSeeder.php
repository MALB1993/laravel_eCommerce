<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        DB::table(config('permission.table_names.permissions'))->insert([
            [
                'name' => 'view_dashboard',
                'display_name' => 'View Dashboard',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'edit_posts',
                'display_name' => 'Edit Posts',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more permissions as needed
        ]);
    }
}
