<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes, Sluggable;

    protected $table = "products";

    protected $fillable = [
        'name',
        'slug',
        'brand_id',
        'category_id',
        'primary_image',
        'description',
        'status',
        'is_active',
        'delivery_amount',
        'delivery_amount_per_product'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    /**
     * Summary of getRouteKeyName
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Summary of getIsActiveAttribute
     * @param mixed $is_active
     * @return array|string|null
     */
    public function getIsActiveAttribute($is_active)
    {
        return  $is_active ? __('Enable') : __('Disable');
    }



    public function tags()
    {
        return $this->belongsToMany(Tag::class,'product_tag');
    }




    /**
     * Summary of brand
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    /**
     * Summary of category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
