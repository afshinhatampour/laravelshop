<?php

namespace App\Http\Controllers\Api\V1\Shop\Product;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Shop\HomePageProductFeedResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BiggestDiscountProductController extends ApiController
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return HomePageProductFeedResource::collection(
            Product::saleable()->inRandomOrder()->limit(4)->get()
        );
    }
}
