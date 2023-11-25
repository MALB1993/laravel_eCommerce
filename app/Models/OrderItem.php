<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "order_items";

    protected $fillable = [
        'order_id',
        'product_id',
        'product_variation',
        'price',
        'quantity',
        'subtotals'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
