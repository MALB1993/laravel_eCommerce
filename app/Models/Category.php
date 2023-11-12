<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "categories";

    protected $fillable =   [
        'name',
        'slug',
        'parent_id',
        'is_active',
        'icon',
        'description'
    ];


    /**
     * Summary of parent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    /**
     * Summary of children
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    /**
     * Summary of getIsActiveAttribute
     * @param mixed $is_active
     * @return array|string|null
     */
    public function getIsActiveAttribute($is_active)
    {
        return $is_active ? __('Enable') : __('Disable');
    }

    /**
     * Summary of categories
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_category');
    }

    /**
     * Summary of children
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
