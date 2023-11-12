<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\ProductRate;
use App\Models\ProductVariation;
use App\Models\Tag;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

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
     * Summary of appends
     * @var array
     */
    protected $appends = [
        'quantity_check',
        'price_check',
        'sale_check'
    ];


    /**
     * Summary of scopeFilter
     * @param mixed $query
     * @return mixed
     */
    public function scopeFilter($query)
    {

        // attribute
        if(request()->has('attribute'))
        {
            foreach(request()->attribute as $attribute)
            {
                $query->whereHas('attributes', function($query) use($attribute) {

                    foreach(explode('-', $attribute) as $index => $item)
                    {
                        if($index == 0)
                        {
                            $query->where('value', $item);
                        }
                        else
                        {
                            $query->orWhere('value', $item);
                        }
                    }
                });
            }
        }

        // variations
        if(request()->has('variation'))
        {
            $query->whereHas('variations', function($query){
                foreach(explode('-', request()->variation) as $index => $variation)
                {
                    if($index == 0)
                    {
                        $query->where('value', $variation);
                    }
                    else
                    {
                        $query->orWhere('value', $variation);
                    }
                }
            });
        }

        // order by
        if(request()->has('sortBy'))
        {
            $sortBy = request()->sortBy;
            switch ($sortBy) {
                case 'max':
                    $query->orderByDesc(ProductVariation::select('price')->whereColumn('product_variations.product_id', 'products.id')->orderBy('sale_price','desc')->take(1));
                break;

                case 'min':
                    $query->orderBy(ProductVariation::select('price')->whereColumn('product_variations.product_id', 'products.id')->orderBy('sale_price','asc')->take(1));
                break;

                case 'latest':
                    $query->latest();
                break;

                case 'oldest':
                    $query->oldest();
                break;

                default:
                    $query;
                break;
            }
        }

        return $query;
    }



    /**
     * Summary of scopeSearch
     * @param mixed $query
     * @return mixed
     */
    public function scopeSearch($query)
    {
        $keyword = request()->search;

        if(request()->has('search') && trim($keyword) != '')
        {
            $query->where('name','LIKE', '%'.$keyword.'%');
        }

        return $query;
    }


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

    /**
     * Summary of getIsQuantityCheckAttribute
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasMany|int|object|null
     */
    public function getQuantityCheckAttribute()
    {
        return  $this->variations()->where('quantity','>',0)->first() ?? 0;
    }


    /**
     * Summary of getSalePriceAttribute
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasMany|bool|object|null
     */
    public function getSalePriceAttribute()
    {
        return  $this->variations()->where('quantity','>',0)->where('sale_price','!=',null)->where('date_on_sale_from','<',Carbon::now())->where('date_on_sale_to','>',Carbon::now())->orderBy('sale_price')->first() ?? false;
    }


    /**
     * Summary of getPriceCheckAttribute
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasMany|bool|object|null
     */
    public function getSaleCheckAttribute()
    {
        return  $this->variations()->where('quantity','>',0)->orderBy('price')->first() ?? false;
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


    /**
     * Summary of attributes
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    /**
     * Summary of attributes
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    /**
     * Summary of attributes
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }



    /**
     * Summary of rates
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rates()
    {
        return $this->hasMany(ProductRate::class);
    }
}
