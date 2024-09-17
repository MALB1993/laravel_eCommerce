<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductAttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\ProductAttribute::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'attribute_id' => $this->faker->numberBetween(1, 50), // فرض بر این است که ویژگی‌ها از id 1 تا 50 دارند
            'product_id' => $this->faker->numberBetween(1, 50), // فرض بر این است که محصولات از id 1 تا 50 دارند
            'value' => $this->faker->word,
            'is_active' => $this->faker->boolean,
        ];
    }
}
