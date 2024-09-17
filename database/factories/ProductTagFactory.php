<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ProductTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\ProductTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 50), // فرض بر این است که محصولات از id 1 تا 50 دارند
            'tag_id' => $this->faker->numberBetween(1, 50), // فرض بر این است که برچسب‌ها از id 1 تا 50 دارند
        ];
    }
}
