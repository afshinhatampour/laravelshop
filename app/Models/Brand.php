<?php

namespace App\Models;

use App\Enums\BrandStatusEnum;
use App\Enums\ProductItemStatusEnum;
use App\Enums\ProductStatusEnum;
use App\Enums\SellerStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return Builder
     */
    public static function saleableBrandsQueryBuilder(): Builder
    {
        return Brand::whereHas('products', function ($productQueryBuilder) {
            return $productQueryBuilder->where('status', ProductStatusEnum::ACTIVE->value)
                ->whereHas('productItems', function ($productItemQueryBuilder) {
                    return $productItemQueryBuilder->where('status', ProductItemStatusEnum::ACTIVE->value)
                        ->where('price', '>', 0)->whereHas('seller', function ($sellerQueryBuilder) {
                            return $sellerQueryBuilder->where('status', SellerStatusEnum::ACTIVE->value);
                        });
                });
        })->where('status', BrandStatusEnum::ACTIVE->value);
    }
}
