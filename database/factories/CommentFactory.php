<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50), // فرض بر این است که کاربران از id 1 تا 50 دارند
            'product_id' => $this->faker->numberBetween(1, 50), // فرض بر این است که محصولات از id 1 تا 50 دارند
            'approved' => $this->faker->boolean,
            'text' => $this->faker->text,
        ];
    }
}
