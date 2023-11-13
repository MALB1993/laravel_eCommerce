<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Summary of table
     * @var string
     */
    protected $table = 'comments';
    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'approved',
        'text',
        'updated_at'
    ];

}
