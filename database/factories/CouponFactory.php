<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'code' => $this->faker->unique()->word,
            'type' => $this->faker->randomElement(['amount', 'percentage']),
            'amount' => $this->faker->optional()->numberBetween(1000, 10000),
            'percentage' => $this->faker->optional()->numberBetween(1, 100),
            'max_percentage_amount' => $this->faker->optional()->numberBetween(1000, 5000),
            'expired_at' => $this->faker->dateTimeBetween('now', '+1 year'),
            'description' => $this->faker->optional()->paragraph,
        ];
    }
}
