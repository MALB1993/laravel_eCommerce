<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductRate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CommentController extends Controller
{
    public function store(Request $request , Product $product)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'text'  =>  'required|string|min:5|max:7000',
            'rate'  =>  'required|integer|digits_between:0,5',
        ]);

        if($validator->fails()){
            return redirect()->to(url()->previous() . "/#show-errors-comment")->withErrors($validator);
        }

        if(!auth()->check())
        {
            alert()->error(__('Error'),__('You must first login in the website'));
        }else{

            try {

                \Illuminate\Support\Facades\DB::beginTransaction();

                Comment::create([
                    'user_id'       =>  auth()->user()->id,
                    'product_id'    =>  $product->id,
                    'text'          =>  $request->input('text'),
                    'updated_at'    =>  null
                ]);


                if(!$product->rates()->where('user_id',auth()->user()->id)->exists())
                {
                    ProductRate::create([
                        'user_id'       =>  auth()->user()->id,
                        'product_id'    =>  $product->id,
                        'rate'          =>  $request->input('rate')
                    ]);
                }else{
                    $rate = $product->rates()->where('user_id',auth()->user()->id)->first();

                    $rate->update([
                        'rate'          =>  $request->input('rate'),
                        'update_at'     =>  Carbon::now(),
                    ]);
                }



                \Illuminate\Support\Facades\DB::commit();
            } catch (\Exception $ex) {
                \Illuminate\Support\Facades\DB::rollBack();
                 Alert::toast(__('Difficulty creating product') . $ex->getCode() , 'danger');
                 return redirect()->back();
             }

             Alert::toast(__('Confirm comment successfully !'), 'success');
             return redirect()->back();
        }

    }
}
