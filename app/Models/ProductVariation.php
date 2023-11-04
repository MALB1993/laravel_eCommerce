<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariation extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "product_variations";

    protected $fillable = [
        'attribute_id',
        'product_id',
        'value',
        'price',
        'quantity',
        'sku',
        'sale_price',
        'date_on_sale_from',
        'date_on_to_from',
    ];

}
