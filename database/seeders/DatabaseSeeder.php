<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            AttributesTableSeeder::class,
            CategoriesTableSeeder::class,
            BrandsTableSeeder::class,
            ProductsTableSeeder::class,
            ProductImagesTableSeeder::class,
            TagsTableSeeder::class,
            ProductTagTableSeeder::class,
            CommentsTableSeeder::class,
            ProductRatesTableSeeder::class,
            AttributeCategoryTableSeeder::class,
            ProvincesTableSeeder::class,
            CitiesTableSeeder::class,
            UserAddressesTableSeeder::class,
            OrdersTableSeeder::class,
            ProductAttributesTableSeeder::class,
            ProductVariationsTableSeeder::class,
            TransactionsTableSeeder::class,
            WishlistTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            SettingsSeeder::class,
            BannersTableSeeder::class,
            ContactUsSeeder::class,
            CouponsTableSeeder::class,
        ]);
        
    }
}
