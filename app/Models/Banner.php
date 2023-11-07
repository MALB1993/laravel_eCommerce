<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = "banners";

    protected $fillable = [
        'image',
        'title',
        'text',
        'priority',
        'is_active',
        'type',
        'button_text',
        'button_link',
        'button_icon',
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
