<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => $this->faker->imageUrl(), // تولید لینک تصویر تصادفی
            'brand' => $this->faker->company, // تولید نام برند تصادفی
            'address' => $this->faker->address, // تولید آدرس تصادفی
            'telephone' => $this->faker->phoneNumber, // تولید شماره تلفن تصادفی
            'telephone2' => $this->faker->phoneNumber, // تولید شماره تلفن دوم تصادفی
            'longitude' => $this->faker->longitude, // تولید موقعیت جغرافیایی طول
            'latitude' => $this->faker->latitude, // تولید موقعیت جغرافیایی عرض
            'telegram' => 'https://t.me/' . $this->faker->userName, // تولید لینک تلگرام تصادفی
            'instagram' => 'https://instagram.com/' . $this->faker->userName, // تولید لینک اینستاگرام تصادفی
            'facebook' => 'https://facebook.com/' . $this->faker->userName, // تولید لینک فیس‌بوک تصادفی
            'twitter' => 'https://twitter.com/' . $this->faker->userName, // تولید لینک توییتر تصادفی
        ];
    }
}
