<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'brand_id' => $this->faker->numberBetween(1, 10), // فرض بر این است که برندها از id 1 تا 10 دارند
            'category_id' => $this->faker->numberBetween(1, 10), // فرض بر این است که دسته‌بندی‌ها از id 1 تا 10 دارند
            'slug' => $this->faker->slug,
            'primary_image' => 'path/to/image.jpg',
            'description' => $this->faker->text,
            'status' => $this->faker->boolean,
            'is_active' => $this->faker->boolean,
            'delivery_amount' => $this->faker->numberBetween(0, 100),
            'delivery_amount_per_product' => $this->faker->numberBetween(0, 10),
        ];
    }
}
