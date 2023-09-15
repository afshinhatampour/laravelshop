<?php

namespace Database\Factories;

use App\Enums\BrandStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brandTitle = $this->faker->sentence;
        return [
            'title'  => $brandTitle,
            'slug'   => str_replace(' ', '_', $brandTitle),
            'status' => $this->faker->randomElement(array_column(BrandStatusEnum::cases(), 'value')),
        ];
    }
}
