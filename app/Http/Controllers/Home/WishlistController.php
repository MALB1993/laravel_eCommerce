<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * @param Product $product
     * @return RedirectResponse
     */
    public function add(Product $product): \Illuminate\Http\RedirectResponse
    {

        if(auth()->check())
        {
            if($product->checkUserWishlist(auth()->user()->id))
            {
                alert()->warning(__('Info'),__('You have this product in your favorites list.'));
            }else{
                Wishlist::query()->create([
                    'user_id'       =>  auth()->id(),
                    'product_id'    =>  $product->id
                ]);
                alert()->success(__('Confirm'),__('The desired product has been correctly added to your wish list'));
            }
        }else{
            alert()->error(__('Info'),__('You must first login in the website'));
        }
        return redirect()->back();
    }


    /**
     * @param Product $product
     * @return RedirectResponse
     */
    public function remove(Product $product): RedirectResponse
    {
        if(auth()->check())
        {
            $wishlist = Wishlist::query()->where('product_id',$product->id)->where('user_id',auth()->user()->id)->firstOrFail();

            if($wishlist)
            {
                Wishlist::query()->where('product_id',$product->id)->where('user_id',auth()->user()->id)->delete();
            }

            alert()->success(__('Confirm'),__('The desired product has been correctly remove to your wish list'));

        }else{
            alert()->error(__('Info'),__('You must first login in the website'));
        }
        return redirect()->back();
    }

}
