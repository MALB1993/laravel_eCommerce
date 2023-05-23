<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *@param mixed $id
 */
class Category extends Model
{
    use HasFactory;

        /**
     * Summary of table
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @param $is_active
     * @return string
     */
    public function getIsActiveAttribute($is_active): string
    {
        return $is_active ? 'فعال' : 'غیرفعال';
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
