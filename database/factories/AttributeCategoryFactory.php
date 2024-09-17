<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\AttributeCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'attribute_id' => $this->faker->numberBetween(1, 50), // فرض بر این است که ویژگی‌ها از id 1 تا 50 دارند
            'category_id' => $this->faker->numberBetween(1, 50), // فرض بر این است که دسته‌بندی‌ها از id 1 تا 50 دارند
            'is_filter' => $this->faker->boolean,
            'is_variation' => $this->faker->boolean,
        ];
    }
}
