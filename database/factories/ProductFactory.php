<?php

namespace Database\Factories;

use App\Enums\ProductStatusEnum;
use App\Models\Brand;
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
            'title'     => $this->faker->sentence,
            'content'   => $this->faker->paragraph,
            'unique_id' => uniqid(),
            'brand_id'  => $this->faker->randomElement(Brand::all()->pluck('id')->toArray()),
            'status'    => $this->faker->randomElement(ProductStatusEnum::cases()),
        ];
    }
}
