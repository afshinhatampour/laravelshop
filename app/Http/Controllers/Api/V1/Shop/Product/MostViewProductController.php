<?php

namespace App\Http\Controllers\Api\V1\Shop\Product;

use App\Enums\ProductItemStatusEnum;
use App\Enums\ProductStatusEnum;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Shop\HomePageProductFeedResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MostViewProductController extends ApiController
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return HomePageProductFeedResource::collection(
            Product::inRandomOrder()
                ->where('status', ProductStatusEnum::ACTIVE->value)
                ->whereHas('productItems', function ($query) {
                    return $query->where('status', ProductItemStatusEnum::ACTIVE->value);
                })
                ->limit(4)
                ->get()
        );
    }
}
