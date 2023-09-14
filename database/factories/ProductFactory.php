<?php

namespace Database\Factories;

use App\Enums\ProductStatusEnum;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'title'      => $this->faker->sentence,
            'content'    => $this->faker->paragraph,
            'unique_id'  => uniqid(),
            'brand_id'   => random_int(1, 100),
            'status'     => $this->faker->randomElement(ProductStatusEnum::cases()),
        ];
    }
}