<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    protected $guarded = [];
}
