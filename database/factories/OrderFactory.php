<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), // تولید یک user_id از فیکچر user
            'address_id' => \App\Models\UserAddress::factory(), // تولید یک address_id از فیکچر user_address
            'coupon_id' => \App\Models\Coupon::factory()->optional(), // تولید یک coupon_id به صورت اختیاری
            'status' => $this->faker->numberBetween(0, 3), // وضعیت سفارش می‌تواند بین 0 و 3 باشد
            'total_amount' => $this->faker->numberBetween(1000, 10000),
            'delivery_amount' => $this->faker->optional()->numberBetween(100, 1000),
            'coupon_amount' => $this->faker->numberBetween(0, 5000),
            'paying_amount' => $this->faker->numberBetween(1000, 10000),
            'payment_type' => $this->faker->randomElement(['pos', 'cash', 'shabaNumber', 'card_to_card', 'online']),
            'payment_status' => $this->faker->numberBetween(0, 1), // وضعیت پرداخت می‌تواند 0 یا 1 باشد
            'description' => $this->faker->optional()->paragraph,
        ];
    }
}
