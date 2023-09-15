<?php

namespace App\Models;

use App\Enums\ProductItemStatusEnum;
use App\Enums\SellerStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'unique_id',
        'brand_id',
        'status'
    ];

    /**
     * @return HasMany
     */
    public function productItems(): HasMany
    {
        return $this->hasMany(ProductItem::class);
    }

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return Builder
     */
    public static function saleableProductQueryBuilder(): Builder
    {
        return Product::whereHas('productItems', function ($productItemQueryBuilder) {
            return $productItemQueryBuilder->where('status', ProductItemStatusEnum::ACTIVE->value)
                ->where('price', '>', 0)->whereHas('seller', function ($sellerQueryBuilder) {
                    return $sellerQueryBuilder->where('status', SellerStatusEnum::ACTIVE->value);
                });
        })->where('status', ProductItemStatusEnum::ACTIVE->value);
    }
}
