<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Cart;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'variation'     =>  'required|json',
            'qtybutton'     =>  'required|integer',
            'product_id'    =>  'exists:products,id'
        ]);

        $Product = Product::findOrFail($request->product_id);
        $productVariation = ProductVariation::findOrFail(json_decode($request->variation)->id);

        if($request->qtybutton > $productVariation->quantity)
        {
            Alert::error(__('Info'),__('The number of imported products is not correct'));
            return redirect()->back();
        }

        $rowId = $Product->id.'-'.$productVariation->id;
        

        if(Cart::get($rowId) == null){
            Cart::add([
                'id'                =>      $rowId,
                'name'              =>      $Product->name,
                'price'             =>      $productVariation->is_sale ? $productVariation->sale_price : $productVariation->price,
                'quantity'          =>      $request->qtybutton,
                'attributes'        =>      $productVariation->toArray(),
                'associatedModel'   =>      $Product
            ]);

            Alert::success(__('Confirm'), __('Your product has been successfully added to the cart.'));
            return redirect()->back();
        }else{
            Alert::warning(__('Info'), __('Your product has been successfully added to the cart.'));
            return redirect()->back();
        }
    }
}