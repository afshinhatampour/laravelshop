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

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'unique_id',
        'title',
        'content'
    ];

    /**
     * @return HasMany
     */
    public function productItems(): HasMany
    {
        return $this->hasMany(ProductItem::class);
    }

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public static function scopeSaleable(Builder $query): void
    {
        $query->whereHas('productItems', function ($productItemQueryBuilder) {
            return $productItemQueryBuilder->saleable();
        })->where('status', SellerStatusEnum::ACTIVE->value);
    }
}
