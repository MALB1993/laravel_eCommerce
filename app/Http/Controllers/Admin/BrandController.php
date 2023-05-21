<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    /**
     **Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(5);
        return view('Admin.Pages.Brands.index',compact(['brands']));

    }


    /**
     **Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        //
        return view('Admin.Pages.Brands.create');
    }


    /**
     **Store a newly created resource in storage.
     * @param \App\Http\Requests\StoreBrandRequest $storeBrandRequest
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function store(StoreBrandRequest $storeBrandRequest)
    {
        #_________________________________________ variables
        $message = 'برند شما به درستی ذخیره شد .';

        #_________________________________________ created brand
        Brand::query()->create([
            'name'          =>      $storeBrandRequest->input('name'),
            'is_active'     =>      $storeBrandRequest->input('is_active'),
            'created_at'    =>      Carbon::now(),
            'updated_at'    =>      null,
        ]);

        #_________________________________________ Sweet Alert
        alert()->success('گزارش وضعیت',$message);


        #_________________________________________ pass message and redirect
        return redirect()->route('admin.brands.index');
    }


    /**
     ** Display the specified resource.
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Brand $brand)
    {
        return view('Admin.Pages.Brands.show', compact(['brand']));
    }


    /**
     **Show the form for editing the specified resource.
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Brand $brand)
    {
        return view('Admin.Pages.Brands.edit', compact(['brand']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $updateBrandRequest, Brand $brand)
    {
                #_________________________________________ variables
                $message = 'برند شما به درستی ویرایش شد .';

                #_________________________________________ created brand
                $brand->update([
                    'name'          =>      $updateBrandRequest->input('name'),
                    'slug'          =>      null,
                    'is_active'     =>      $updateBrandRequest->input('is_active'),
                    'updated_at'    =>      Carbon::now(),
                ]);

                #_________________________________________ Sweet Alert
                alert()->success('گزارش وضعیت',$message);


                #_________________________________________ pass message and redirect
                return redirect()->route('admin.brands.index');
    }


    /**
     **Remove the specified resource from storage.
     * @param \App\Models\Brand $brand
     * @return void
     */
    public function destroy(Brand $brand)
    {
        #_________________________________________ variables
        $message = 'برند شما به درستی حذف شد .';

        #_________________________________________ Sweet Alert
        alert()->success('گزارش وضعیت',$message);

        #________________________________________ Deleted item
        $brand->delete();

        #_________________________________________ pass message and redirect
        return redirect()->route('admin.brands.index');
    }
}
