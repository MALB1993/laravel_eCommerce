<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    /**
     **Display a listing of the resource.
     * @return Factory|View
     */
    public function index(): View|Factory
    {
        $brands = Brand::query()->latest()->paginate(5);
        return view('Admin.Pages.Brands.index',compact(['brands']));

    }


    /**
     **Show the form for creating a new resource.
     * @return Factory|View
     */
    public function create(): View|Factory
    {
        return view('Admin.Pages.Brands.create');
    }


    /**
     **Store a newly created resource in storage.
     * @param StoreBrandRequest $storeBrandRequest
     * @return RedirectResponse|mixed
     */
    public function store(StoreBrandRequest $storeBrandRequest): mixed
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
     * @param Brand $brand
     * @return Factory|View
     */
    public function show(Brand $brand): View|Factory
    {
        return view('Admin.Pages.Brands.show', compact(['brand']));
    }


    /**
     **Show the form for editing the specified resource.
     * @param Brand $brand
     * @return Factory|View
     */
    public function edit(Brand $brand): View|Factory
    {
        return view('Admin.Pages.Brands.edit', compact(['brand']));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateBrandRequest $updateBrandRequest
     * @param Brand $brand
     * @return RedirectResponse
     */
    public function update(UpdateBrandRequest $updateBrandRequest, Brand $brand): RedirectResponse
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
     * @param Brand $brand
     * @return RedirectResponse
     */
    public function destroy(Brand $brand): RedirectResponse
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
