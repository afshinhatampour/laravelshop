<?php

namespace Database\Factories;

use App\Enums\CategoryStatusEnum;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;
        return [
            'title'     => $title,
            'slug'      => Str::slug($title),
            'status'    => $this->faker->randomElement(array_column(CategoryStatusEnum::cases(), 'value')),
            'parent_id' => null,
        ];
    }
}
