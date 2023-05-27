<?php

namespace App\Models;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static create(array $array)
 */
class ProductAttribute extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'product_attribute';

    /**
     * @var array
     */
    protected $guarded = [];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function product()
    {
        return $this->belongsTo(Attribute::class);
    }


}
