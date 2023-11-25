<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "orders";


    protected $fillable = [
        'user_id',
        'address_id',
        'coupon_id',
        'status',
        'total_amount',
        'delivery_amount',
        'coupon_amount',
        'paying_amount',
        'payment_type',
        'payment_status',
        'description'
    ];


    public function getStatusAttribute($status)
    {
        return $status ? __('Paying success') : __('Paying error');
    }


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
