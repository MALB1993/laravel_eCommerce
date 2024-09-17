<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\ProductVariation::class;

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
            'price' => $this->faker->numberBetween(100, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'sku' => $this->faker->optional()->word,
            'sale_price' => $this->faker->optional()->numberBetween(100, 1000),
            'date_on_sale_from' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
            'date_on_sale_to' => $this->faker->optional()->dateTimeBetween('now', '+1 year'),
        ];
    }
}
