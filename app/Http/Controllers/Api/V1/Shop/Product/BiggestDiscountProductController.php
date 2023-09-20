<?php

namespace App\Http\Controllers\Api\V1\Shop\Product;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Shop\HomePageProductFeedResource;
use App\Models\Product;
use App\Models\ProductItem;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BiggestDiscountProductController extends ApiController
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return HomePageProductFeedResource::collection(
            Product::whereIn('id',
                ProductItem::saleable()->biggestDiscountProductId()->limit(5)->get()->pluck('product_id')->toArray())
                ->saleable()->get()
        );
    }
}
