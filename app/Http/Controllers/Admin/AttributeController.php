<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Models\Attribute;
use Illuminate\Support\Carbon;

class AttributeController extends Controller
{

    /**
     **Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $attributes = Attribute::latest()->paginate(5);
        return view('Admin.Pages.Attributes.index',compact(['attributes']));
    }


    /**
     **Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('Admin.Pages.Attributes.create');
    }


    /**
     **Store a newly created resource in storage.
     * @param \App\Http\Requests\StoreAttributeRequest $storeAttributeRequest
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function store(StoreAttributeRequest $storeAttributeRequest)
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
     * @param \App\Models\Attribute $attribute
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Attribute $attribute)
    {
        return view('Admin.Pages.Attributes.show', compact(['attribute']));    }


    /**
     **Show the form for editing the specified resource.
     * @param \App\Models\Attribute $attribute
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Attribute $attribute)
    {
        return view('Admin.Pages.Attributes.edit', compact(['attribute']));    }


    /**
     **Update the specified resource in storage.
     * @param \App\Http\Requests\UpdateAttributeRequest $updateAttributeRequest
     * @param \App\Models\Attribute $attribute
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function update(UpdateAttributeRequest $updateAttributeRequest, Attribute $attribute)
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
     * @param \App\Models\Attribute $attribute
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function destroy(Attribute $attribute)
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
