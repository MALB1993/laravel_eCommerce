<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class Brand extends Model
{
    use HasFactory, Sluggable;

    /**
     * Summary of table
     * @var string
     */
    protected $table = 'brands';

    protected $guarded = [];



    /**
     * Summary of sluggable
     * @return array<array>
     */
    public function sluggable(): array
    {
        return [
            'slug'  =>  [

                'source'  =>  'name'

            ]
        ];
    }


    /**
     * Summary of getIsActiveAttribute
     * @param mixed $is_active
     * @return string
     */
    public function getIsActiveAttribute($is_active)
    {
        return $is_active ? 'فعال' : 'غیر فعال';
    }

}
