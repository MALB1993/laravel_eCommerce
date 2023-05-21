<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Admin.Pages.Brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $storeBrandRequest)
    {
        #_________________________________________ variables
        $message = 'برند شما به درستی ذخیره شد .';

        #_________________________________________ created brand
        Brand::query()->create([
            'name'          =>      $storeBrandRequest->input('name'),
            'is_active'     =>      $storeBrandRequest->input('is_active')
        ]);

        #_________________________________________ pass message and redirect
        return redirect()->route('admin.brands.index')->with('success',$message);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
