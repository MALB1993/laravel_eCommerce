<?php

namespace App\Models;

use App\Models\ProductImage;
use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(string[] $array)
 * @method static latest()
 */
class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    /**
     * Summary of table
     * @var string
     */
    protected $table = 'products';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return array
     */
    #[ArrayShape(['slug' => "string[]"])] public function sluggable(): array
    {
        return [
            'slug'  =>  [
                'source'    =>  'name'
            ]
        ];
    }

    /**
     * @param $is_active
     * @return string
     */
    public function getIsActiveAttribute($is_active): string
    {
        return $is_active ? 'فعال' : 'غیرفعال';
    }


    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    /**
     * @return HasMany
     */
    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }

    /**
     * @return HasMany
     */
    public function variations(): HasMany
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
