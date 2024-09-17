<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Banner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => $this->faker->imageUrl(), // تولید URL تصادفی برای تصویر
            'title' => $this->faker->optional()->sentence, // تولید عنوان تصادفی به صورت اختیاری
            'text' => $this->faker->optional()->paragraph, // تولید متن تصادفی به صورت اختیاری
            'priority' => $this->faker->optional()->numberBetween(1, 10), // اولویت به صورت اختیاری
            'is_active' => $this->faker->boolean, // فعال یا غیرفعال بودن بنر
            'type' => $this->faker->randomElement(['homepage', 'category', 'product']), // نوع بنر
            'button_text' => $this->faker->optional()->word, // متن دکمه به صورت اختیاری
            'button_link' => $this->faker->optional()->url, // لینک دکمه به صورت اختیاری
            'button_icon' => $this->faker->optional()->word, // آیکون دکمه به صورت اختیاری
        ];
    }
}
