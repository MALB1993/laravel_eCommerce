<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\UserAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), // تولید یک user_id از فیکچر user
            'title' => $this->faker->word,
            'address' => $this->faker->address,
            'cellphone' => $this->faker->phoneNumber,
            'postal_code' => $this->faker->postcode,
            'province_id' => \App\Models\Province::factory(), // تولید یک province_id از فیکچر province
            'city_id' => \App\Models\City::factory(), // تولید یک city_id از فیکچر city
            'longitude' => $this->faker->optional()->longitude,
            'latitude' => $this->faker->optional()->latitude,
        ];
    }
}
