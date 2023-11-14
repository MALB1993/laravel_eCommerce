<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;
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

    /**
     * Summary of user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Summary of product
     * @return mixed
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    /**
     * Summary of getIsActiveAttribute
     * @param mixed $approved
     * @return array|string|null
     */
    public function getApprovedAttribute($approved)
    {
        return $approved ? __('Enable') : __('Disable');
    }

}
