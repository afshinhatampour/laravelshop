<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\Category;
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
        Brand::factory(50)->create();
        User::factory(100)->create();
        Product::factory(46)->create();
        Seller::factory(50)->create();
        ProductItem::factory(1000)->create();
        Category::factory(50)->create();
    }
}
