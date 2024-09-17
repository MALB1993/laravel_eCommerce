<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $quantity = $this->faker->numberBetween(1, 5);
        $price = $this->faker->numberBetween(100, 1000);
        $subtotals = $price * $quantity;

        return [
            'order_id' => \App\Models\Order::factory(), // تولید یک order_id از فیکچر order
            'product_id' => \App\Models\Product::factory(), // تولید یک product_id از فیکچر product
            'product_variation' => \App\Models\ProductVariation::factory(), // تولید یک product_variation از فیکچر product_variation
            'price' => $price,
            'quantity' => $quantity,
            'subtotals' => $subtotals,
        ];
    }
}
