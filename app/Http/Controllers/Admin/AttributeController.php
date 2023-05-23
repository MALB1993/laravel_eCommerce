<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Models\Attribute;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class AttributeController extends Controller
{

    /**
     **Display a listing of the resource.
     * @return Factory|View
     */
    public function index(): View|Factory
    {
        $attributes = Attribute::query()->latest()->paginate(5);
        return view('Admin.Pages.Attributes.index',compact(['attributes']));
    }


    /**
     **Show the form for creating a new resource.
     * @return Factory|View
     */
    public function create(): View|Factory
    {
        return view('Admin.Pages.Attributes.create');
    }


    /**
     **Store a newly created resource in storage.
     * @param StoreAttributeRequest $storeAttributeRequest
     * @return RedirectResponse
     */
    public function store(StoreAttributeRequest $storeAttributeRequest): RedirectResponse
    {

        #_________________________________________ variables
        $message = 'ویژگی شما به درستی ذخیره شد .';

        Attribute::query()->create([
            'name'          =>      $storeAttributeRequest->input('name'),
            'updated_at'    =>      null,
        ]);

        #_________________________________________ Sweet Alert
        alert()->success('گزارش وضعیت',$message);


        #_________________________________________ pass message and redirect
        return redirect()->route('admin.attributes.index');

    }


    /**
     **Display the specified resource.
     * @param Attribute $attribute
     * @return Factory|View
     */
    public function show(Attribute $attribute): View|Factory
    {
        return view('Admin.Pages.Attributes.show', compact(['attribute']));    }


    /**
     **Show the form for editing the specified resource.
     * @param Attribute $attribute
     * @return Factory|View
     */
    public function edit(Attribute $attribute): View|Factory
    {
        return view('Admin.Pages.Attributes.edit', compact(['attribute']));    }


    /**
     **Update the specified resource in storage.
     * @param UpdateAttributeRequest $updateAttributeRequest
     * @param Attribute $attribute
     * @return RedirectResponse
     */
    public function update(UpdateAttributeRequest $updateAttributeRequest, Attribute $attribute): RedirectResponse
    {
        #_________________________________________ variables
        $message = 'ویژگی شما به درستی ویرایش شد .';

        #_________________________________________ created brand
        $attribute->update([
            'name'          =>      $updateAttributeRequest->input('name'),
            'updated_at'    =>      Carbon::now(),
        ]);

        #_________________________________________ Sweet Alert
        alert()->success('گزارش وضعیت',$message);


        #_________________________________________ pass message and redirect
        return redirect()->route('admin.attributes.index');
    }


    /**
     **Remove the specified resource from storage.
     * @param Attribute $attribute
     * @return RedirectResponse
     */
    public function destroy(Attribute $attribute): RedirectResponse
    {
        #_________________________________________ variables
        $message = 'ویژگی شما به درستی حذف شد .';

        #_________________________________________ Sweet Alert
        alert()->success('گزارش وضعیت',$message);

        #________________________________________ Deleted item
        $attribute->delete();

        #_________________________________________ pass message and redirect
        return redirect()->route('admin.attributes.index');    }
}
