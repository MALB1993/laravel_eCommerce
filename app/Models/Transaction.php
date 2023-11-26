<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\order;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "transactions";

    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
        'ref_id',
        'token',
        'description',
        'gateway_name',
        'status'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getStatusAttribute($status)
    {
        return $status ? __('Paying success') : __('Paying error');
    }
}
