<?php

namespace Database\Factories;

use App\Enums\SellerStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller>
 */
class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status'    => $this->faker->randomElement(array_column(SellerStatusEnum::cases(), 'value')),
            'unique_id' => uniqid(),
            'title'     => $this->faker->sentence,
            'content'   => $this->faker->paragraph,
        ];
    }
}
