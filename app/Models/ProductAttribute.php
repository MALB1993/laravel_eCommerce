<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class ProductAttribute extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'product_attribute';

    /**
     * @var array
     */
    protected $guarded = [];

}
