<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'variation'     =>  'required|json',
            'qtybutton'     =>  'required|integer',
            'product_id'    =>  'exists:products,id'
        ]);

        $product = Product::findOrFail($request->product_id);
        $productVariations = ProductVariation::findOrFail(json_decode($request->variation)->id);

        if($request->qtybutton > $productVariations->quantity)
        {
            Alert::error(__('Info'),__('The number of imported products is not correct'));
            return redirect()->back();
        }

    }
}