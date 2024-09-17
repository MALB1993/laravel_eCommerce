<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // ایجاد 10 کاربر تصادفی
        \App\Models\User::factory(10)->create();

        // ایجاد یک کاربر مشخص
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // ایجاد داده‌های مربوط به مدل‌های دیگر
        \App\Models\Brand::factory(5)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Product::factory(20)->create();
        \App\Models\ProductImage::factory(40)->create();
        \App\Models\ProductRate::factory(50)->create();
        \App\Models\Tag::factory(10)->create();
        \App\Models\ProductAttribute::factory(50)->create();
        \App\Models\ProductVariation::factory(50)->create();
        \App\Models\Province::factory(5)->create();
        \App\Models\City::factory(15)->create();
        \App\Models\UserAddress::factory(10)->create();
        \App\Models\Coupon::factory(5)->create();
        \App\Models\Order::factory(10)->create();
        \App\Models\OrderItem::factory(20)->create();
        \App\Models\Transaction::factory(10)->create();
        \App\Models\Wishlist::factory(15)->create();
        \App\Models\Banner::factory(5)->create();
    }
}
