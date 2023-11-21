<?php

namespace App\Models;

use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static latest()
 */
class Attribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "attributes";

    protected $fillable = ['name'];


    public function getRouteKeyName()
    {
        return 'name';
    }


    /**
     * Summary of categories
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'attribute_category');
    }

    /**
     * Summary of values
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values()
    {
        return $this->hasMany(ProductAttribute::class)->select('attribute_id','value')->distinct();
    }


    /**
     * Summary of values
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variationsValues()
    {
        return $this->hasMany(ProductVariation::class)->select('attribute_id','value')->distinct();
    }
}
