<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Brand::factory(100)->create();
        User::factory(1000)->create();
        Product::factory(1000)->create();
        Seller::factory(50)->create();
        ProductItem::factory(5000)->create();
    }
}
