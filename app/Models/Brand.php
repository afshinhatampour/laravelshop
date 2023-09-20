<?php

namespace App\Models;

use App\Enums\BrandStatusEnum;
use App\Enums\ProductStatusEnum;
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
     * @param Builder $query
     * @return void
     */
    public function scopeSaleable(Builder $query): void
    {
        $query->whereHas('products', function ($productQueryBuilder) {
            return $productQueryBuilder->where('status', ProductStatusEnum::ACTIVE->value)->SaleableProductItem();
        })->where('status', BrandStatusEnum::ACTIVE->value);
    }
}
