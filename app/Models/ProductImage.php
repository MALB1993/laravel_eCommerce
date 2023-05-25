<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class ProductImage extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'product_images';

    /**
     * @var array
     */
    protected $guarded = [];

}
