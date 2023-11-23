<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

}
