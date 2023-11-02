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


    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function getIsActiveAttribute($is_active)
    {
        return $is_active ? __('Enable') : __('Disable');
    }

}
