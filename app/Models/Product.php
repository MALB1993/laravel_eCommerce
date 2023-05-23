<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JetBrains\PhpStorm\ArrayShape;

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
}
