<?php

namespace App\Models;

use App\Enums\BrandStatusEnum;
use App\Enums\ProductItemStatusEnum;
use App\Enums\SellerStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'discount',
        'status',
        'product_id',
        'seller_id'
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeSaleable(Builder $query): void
    {
         $query->whereHas('product', function ($productQueryBuilder) {
            return $productQueryBuilder->where('status', ProductItemStatusEnum::ACTIVE->value)
                ->whereHas('brand', function ($brandQueryBuilder) {
                    return $brandQueryBuilder->where('status', BrandStatusEnum::ACTIVE->value);
                });
        })
            ->whereHas('seller', function ($sellerQueryBuilder) {
                return $sellerQueryBuilder->where('status', SellerStatusEnum::ACTIVE->value);
            })
            ->where('status', ProductItemStatusEnum::ACTIVE->value)
            ->where('price', '>', 0);
    }
}
