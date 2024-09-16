<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        DB::table(config('permission.table_names.roles'))->insert([
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'editor',
                'display_name' => 'Editor',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more roles as needed
        ]);
    }
}
