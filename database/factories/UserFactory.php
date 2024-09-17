<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'cellphone' => $this->faker->phoneNumber,
            'avatar' => $this->faker->imageUrl(640, 480, 'people'),
            'status' => $this->faker->numberBetween(0, 1),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => $this->faker->optional()->dateTime(),
            'password' => bcrypt('password'), // یا از Hash::make استفاده کنید
            'provider_name' => 'website',
            'remember_token' => Str::random(10),
        ];
    }
}
