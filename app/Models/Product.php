<?php

namespace App\Models;

use App\Enums\BrandStatusEnum;
use App\Enums\ProductStatusEnum;
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
        'view_count',
        'status'
    ];

    protected $appends = [
        'price'
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
     * @return ProductItem|null
     */
    public function cheapestProductItem(): ?ProductItem
    {
        return $this->productItems()->orderBy('price', 'ASC')->first();
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
        $query->active()->saleableProductItem()->activeBrand();
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeSaleableProductItem(Builder $query): void
    {
        $query->whereHas('productItems', function ($productItemQueryBuilder) {
            return $productItemQueryBuilder->active()->where('price', '>', 0)->activeSeller();
        });
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('status', ProductStatusEnum::ACTIVE->value);
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

    public function getPriceAttribute()
    {
        return $this->cheapestProductItem()->price;
    }
}
