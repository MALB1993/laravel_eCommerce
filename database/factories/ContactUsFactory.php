<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactUsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\ContactUs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name, // تولید نام تصادفی
            'email' => $this->faker->unique()->safeEmail, // تولید ایمیل تصادفی
            'subject' => $this->faker->sentence, // تولید موضوع تصادفی
            'text' => $this->faker->paragraph, // تولید متن پیام تصادفی
        ];
    }
}
