<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(5, ['*'], __('brands'));
        return view('admin.brands.index',[
            'brands'    =>  $brands,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      =>  ['required', 'string', 'min:3', 'max:30'],
            'is_active' =>  ['required', 'boolean']
        ]);

        Brand::create([
            'name'          =>  $request->input('name'),
            'is_active'     =>  $request->input('is_active'),
        ]);

        Alert::toast(__('create brands successfully !'), 'success');

        return redirect()->route('admin-panel.brands.index');
    }


    /**
     * Brand of show
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Brand $brand)
    {
        return view('admin.brands.show',[
            'brand' => $brand
        ]);
    }



    /**
     * Summary of edit
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit',[
            'brand' => $brand
        ]);
    }


    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name'      =>  ['required', 'string', 'min:3', 'max:30'],
            'is_active' =>  ['required', 'boolean']
        ]);

        $brand->update([
            'name'          =>  $request->input('name'),
            'is_active'     =>  $request->input('is_active'),
        ]);

        $brand->update();

        Alert::toast(__('edit brands successfully !'), 'success');

        return redirect()->route('admin-panel.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
