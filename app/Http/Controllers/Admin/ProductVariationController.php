<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    public function store($variations, $attributeId, $product)
    {
        $counter = count($variations['value']);

        for ($index = 0; $index < $counter; $index++)
        {
            ProductVariation::create([
                'attribute_id'   =>      $attributeId,
                'product_id'     =>      $product->id,
                'value'          =>      $variations['value'][$index],
                'price'          =>      $variations['price'][$index],
                'quantity'       =>      $variations['quantity'][$index],
                'sku'            =>      $variations['sku'][$index],
            ]);
        }
    }
}
