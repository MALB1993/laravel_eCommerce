<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function store($attributes, $product)
    {
        foreach($attributes as $key => $attribute)
        {
            ProductAttribute::create([
                'product_id'    =>  $product->id,
                'attribute_id'  =>  $key,
                'value'         =>  $attribute
            ]);
        }
    }


    public function update($attributesIds)
    {
        foreach($attributesIds as $key => $value)
        {
            $productAttributes = ProductAttribute::findOrFail($key);

            $productAttributes->update([
                'value' =>  $value
            ]);
        }
    }
}
