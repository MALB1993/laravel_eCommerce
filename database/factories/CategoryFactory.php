<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parent_id' => $this->faker->numberBetween(0, 10), // یا اگر نیاز به تطابق با دسته‌های موجود دارید، مقادیر معتبر وارد کنید
            'name' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->optional()->text,
            'is_active' => $this->faker->boolean(80), // 80% احتمال فعال بودن
            'icon' => $this->faker->optional()->imageUrl(100, 100, 'abstract'),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
