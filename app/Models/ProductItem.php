<?php

namespace App\Models;

use App\Enums\ProductItemStatusEnum;
use App\Enums\ProductStatusEnum;
use App\Enums\SellerStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use function Laravel\Prompts\select;

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
        $query->activeProduct()->activeSeller()->active()->where('price', '>', 0);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeActiveProduct(Builder $query): void
    {
        $query->whereHas('product', function ($productQueryBuilder) {
            return $productQueryBuilder->active()->activeBrand();
        });
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('status', ProductItemStatusEnum::ACTIVE->value);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeActiveSeller(Builder $query): void
    {
        $query->whereHas('seller', function ($sellerQueryBuilder) {
            return $sellerQueryBuilder->where('status', SellerStatusEnum::ACTIVE->value);
        });
    }

    public static function scopeBiggestDiscountProductId(Builder $query)
    {
        $query->select('product_id')->distinct()->orderBy('discount', 'DESC');
    }
}
