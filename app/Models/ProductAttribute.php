<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = "product_attributes";

    protected $fillable = [
        'attribute_id',
        'product_id',
        'value',
        'is_active'
    ];


    /**
     * Summary of getIsActiveAttribute
     * @param mixed $is_active
     * @return array|string|null
     */
    public function getIsActiveAttribute($is_active)
    {
        return  $is_active ? __('Enable') : __('Disable');
    }

}
