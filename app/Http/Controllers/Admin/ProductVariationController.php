<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    public function store($variations, $attribute_id, $product)
    {
        $counterVariations = count($variations['value']);



         for ($index=0; $index < $counterVariations; $index++) {
            ProductVariation::create([
                'attribute_id'  =>  $attribute_id,
                'product_id'    =>  $product->id,
                'value'         =>  $variations['value'][$index],
                'price'         =>  $variations['price'][$index],
                'quantity'      =>  $variations['quantity'][$index],
                'sku'           =>  $variations['sku'][$index],
                // 'sale_price',
                // 'date_on_sale_from',
                // 'date_on_to_from',
            ]);
         }

    }
}
