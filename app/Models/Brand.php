<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Lang;
use JetBrains\PhpStorm\ArrayShape;

class Brand extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    /**
     * Summary of table
     * @var string
     */
    protected $table = 'brands';

    /**
     * @var array
     */
    protected $guarded = [];



    /**
     * Summary of sluggable
     * @return array<array>
     */
    #[ArrayShape([
        'slug' => "string[]"
    ])]
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
