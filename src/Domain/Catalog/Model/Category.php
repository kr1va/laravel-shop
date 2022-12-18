<?php

namespace Domain\Catalog\Model;

use Domain\Catalog\Collections\BrandCollection;
use Domain\Catalog\QueryBuilders\CategoryQueryBuilder;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Support\Traits\Models\HasSlug;


/**
 * @method static Category|CategoryQueryBuilder query();
 */
class Category extends Model
{
    use HasFactory;
    use HasSlug;


    protected $fillable = [
        'title',
        'on_home_page',
        'sorting'
    ];


    protected static function boot()
    {
        parent::boot();
    }

    public function newCollection(array $models = []): BrandCollection
    {
        return new BrandCollection($models);
    }

    public function newEloquentBuilder($query): CategoryQueryBuilder
    {
        return new CategoryQueryBuilder($query);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
