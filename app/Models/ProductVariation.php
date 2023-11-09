<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

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

    /**
     * Summary of appends
     * @var array
     */
    protected $appends = [
        'is_sale'
    ];



    /**
     * Summary of getIsSaleAttribute
     * @return bool
     */
    public function getIsSaleAttribute()
    {
        return ($this->sale_price != null && $this->date_on_sale_from < Carbon::now() && $this->date_on_sale_to > Carbon::now()) ? true : false;
    }

}
