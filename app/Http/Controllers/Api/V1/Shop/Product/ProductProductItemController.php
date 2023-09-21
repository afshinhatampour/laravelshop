<?php

namespace App\Http\Controllers\Api\V1\Shop\Product;

use App\Http\Controllers\Api\ApiController;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductProductItemController extends ApiController
{
    /**
     * @param int $productId
     * @return JsonResponse
     */
    public function show(int $productId)
    {
        return $this->success('',
            Product::where('id', $productId)->first());
    }
}
