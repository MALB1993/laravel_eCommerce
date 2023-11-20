<?php /** @noinspection PhpUndefinedMethodInspection */

/** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariation;
use Darryldecode\Cart\Cart;
use Illuminate\Contracts\Foundation\Application as FoundationApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Cart;

class CartController extends Controller
{

    /**
     * @return View|Application|Factory|FoundationApplication
     */
    public function index(): View|Application|Factory|FoundationApplication
    {
        return view('home.carts.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function add(Request $request): \Illuminate\Http\RedirectResponse
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
        }else{
            Alert::warning(__('Info'), __('Your product has been successfully added to the cart.'));
        }
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'qtybutton' =>  'required'
        ]);

        foreach($request->qtybutton as $rowId => $quantity)
        {

            $item = Cart::get($rowId);

            if($quantity > $item->attributes->quantity)
            {
                Alert::error(__('Info'),__('The number of imported products is not correct'));
                return redirect()->back();
            }else{
                Cart::update($rowId, [
                    'quantity'  =>  [
                        'relative'  =>  false,
                        'value'     =>  $quantity
                    ]
                ]);
            }
        }

        Alert::success(__('Confirm'), __('Your shopping cart has been successfully edited'));
        return redirect()->back();

    }


    /**
     * @param $rowId
     * @return RedirectResponse
     */
    public function remove($rowId): RedirectResponse
    {
        Cart::remove($rowId);
        Alert::success(__('Confirm'), __('Your product has been successfully removed to the cart.'));
        return redirect()->back();
    }


    /**
     * @return RedirectResponse
     */
    public function clear(): RedirectResponse
    {
        Cart::clear();
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function checkCoupon(Request $request): RedirectResponse
    {
        $request->validate([
            'code'  =>  'required',
        ]);

        if(! auth()->check() )
        {
            Alert::warning(__('Info'),  __('You must first login in the website'));
            return redirect()->back();
        }

        $result =  checkCoupon($request->code);



        if($result != null)
        {
            Alert::warning(__('Info'), $result['error'] );
        }else{
            Alert::success(__('Confirm'), __('Coupon accepted! The discount will be applied to your next invoice.'));
        }

        return redirect()->back();
    }

}
