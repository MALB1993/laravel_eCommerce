<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    /**
     * Summary of table
     * @var string
     */
    protected $table = "product_images";

    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        "product_id",
        'image'
    ];
    
}
