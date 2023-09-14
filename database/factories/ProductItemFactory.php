<?php

namespace Database\Factories;

use App\Enums\ProductItemStatusEnum;
use App\Models\Product;
use App\Models\Seller;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductItem>
 */
class ProductItemFactory extends Factory
{
    /**
     * @return array|array
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'price'      => random_int(10, 1000),
            'discount'   => random_int(0, 25),
            'status'     => $this->faker->randomElement(array_column(ProductItemStatusEnum::cases(), 'value')),
            'product_id' => $this->faker->randomElement(Product::all()->pluck('id')->toArray()),
            'seller_id'  => random_int(1, 20)
        ];
    }
}
