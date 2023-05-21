<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
