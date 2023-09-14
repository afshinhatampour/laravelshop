<?php

namespace App\Models;

use App\Enums\ProductItemStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
     * @return Builder
     */
    public static function hasActiveProductItems(): Builder
    {
        return Product::whereHas('productItems', function ($query) {
            return $query->where('status', ProductItemStatusEnum::ACTIVE->value);
        });
    }
}
