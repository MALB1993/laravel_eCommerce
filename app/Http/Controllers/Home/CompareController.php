<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CompareController extends Controller
{


    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
     */
    public function index()
    {
        if(session()->has('compareProducts')){
            $products = Product::findOrFail(session()->get('compareProducts'));

            return view('home.compares.index',[
                'products'  =>  $products
            ]);
        }

        Alert::warning(__('Warning'), __('This product is in your comparison list.'));
        return redirect()->back();
    }

    /**
     * Summary of add
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function add(Product $product)
    {

        if (session()->has('compareProducts')) {

            if (in_array($product->id, session()->get('compareProducts'))) {
                Alert::success(__('Confirm'), __('This product is in your comparison list.'));
                return redirect()->back();
            }else{
                session()->push('compareProducts', $product->id);
            }

        } else {

            session()->put('compareProducts', [$product->id]);
        }

        Alert::success(__('Confirm'), __('Your product has been added to the comparison list'));
        return redirect()->back();
    }

        /**
     * Summary of add
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function remove($productId)
    {

        if (session()->has('compareProducts'))
        {
            foreach(session()->get('compareProducts') as $key => $compare)
            {
                if($compare == $productId)
                {
                    session()->pull('compareProducts'.$key);
                }
            }
            Alert::success(__('Confirm'), __('The desired item was successfully deleted'));
            if(session()->get('compareProducts') == [])
            {
                session()->forget('compareProducts');
                return redirect()->route('home.index');
            }else{
                return redirect()->back();
            }
        }

        Alert::success(__('Confirm'), __('Your product has been added to the comparison list'));
        return redirect()->back();
    }
}
