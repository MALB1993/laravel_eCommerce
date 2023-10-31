<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes, \Cviebrock\EloquentSluggable\Sluggable;

    protected $table = "brands";

    protected $fillable = [
        "name",
        "slug",
        "is_active"
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

    public function getIsActiveAttribute($is_active)
    {
        return  $is_active ? __('Enable') : __('Disable');
    }
}
