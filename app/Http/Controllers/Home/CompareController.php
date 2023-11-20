<?php /** @noinspection PhpUndefinedMethodInspection */

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use RealRashid\SweetAlert\Facades\Alert;

class CompareController extends Controller
{


    /**
     * Summary of index
     * @return Factory|Application|FoundationApplication|RedirectResponse|View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(): View|FoundationApplication|Factory|RedirectResponse|Application
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
     * @param Product $product
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function add(Product $product): RedirectResponse
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
     * @param $productId
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function remove($productId): RedirectResponse
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
