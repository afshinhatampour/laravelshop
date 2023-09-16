<?php

namespace App\Models;

use App\Enums\BrandStatusEnum;
use App\Enums\ProductItemStatusEnum;
use App\Enums\SellerStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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

    public function saleableProductItems()
    {
        return $this->hasMany(ProductItem::class)->saleable();
    }

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeSaleable(Builder $query): void
    {
        $query
            ->saleableProductItem()
            ->activeBrand()
            ->where('status', ProductItemStatusEnum::ACTIVE->value);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeSaleableProductItem(Builder $query): void
    {
        $query->whereHas('productItems', function ($productItemQueryBuilder) {
            return $productItemQueryBuilder->where('status', ProductItemStatusEnum::ACTIVE->value)
                ->where('price', '>', 0)->activeSeller();
        });
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeActiveBrand(Builder $query): void
    {
        $query->whereHas('brand', function ($brandQueryBuilder) {
            return $brandQueryBuilder->where('status', BrandStatusEnum::ACTIVE->value);
        });
    }
}
