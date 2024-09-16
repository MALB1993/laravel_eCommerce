<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BannersTableSeeder extends Seeder
{
    public function run()
    {
        $banners = [
            [
                'image' => 'path/to/image1.jpg',
                'title' => 'Summer Sale',
                'text' => 'Huge discounts on summer collection!',
                'priority' => 1,
                'is_active' => 1,
                'type' => 'promotion',
                'button_text' => 'Shop Now',
                'button_link' => '/summer-sale',
                'button_icon' => 'shopping-cart',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => 'path/to/image2.jpg',
                'title' => 'New Arrivals',
                'text' => 'Check out the latest arrivals in our store.',
                'priority' => 2,
                'is_active' => 1,
                'type' => 'new_arrival',
                'button_text' => 'Explore',
                'button_link' => '/new-arrivals',
                'button_icon' => 'tags',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => 'path/to/image3.jpg',
                'title' => 'Holiday Special',
                'text' => 'Exclusive deals for the holiday season.',
                'priority' => 3,
                'is_active' => 0,
                'type' => 'holiday',
                'button_text' => 'See Deals',
                'button_link' => '/holiday-special',
                'button_icon' => 'gift',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more sample data as needed
        ];

        foreach ($banners as $banner) {
            DB::table('banners')->insert($banner);
        }
    }
}
