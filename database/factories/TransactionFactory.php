<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), // تولید یک user_id از فیکچر user
            'order_id' => \App\Models\Order::factory(), // تولید یک order_id از فیکچر order
            'amount' => $this->faker->numberBetween(1000, 100000),
            'ref_id' => $this->faker->optional()->uuid, // تولید شناسه مرجع به صورت اختیاری
            'token' => $this->faker->optional()->sha256, // تولید توکن به صورت اختیاری
            'description' => $this->faker->optional()->paragraph, // توضیحات به صورت اختیاری
            'gateway_name' => $this->faker->randomElement(['pay', 'zarinpal']), // انتخاب درگاه پرداخت
            'status' => $this->faker->numberBetween(0, 1), // وضعیت تراکنش
        ];
    }
}
