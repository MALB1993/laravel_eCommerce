<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        // brands
        $brands = Brand::query()->where('is_active',1)->get();

        //tags
        $tags  = Tag::all();

        // categories
        $categories = Category::query()->where('parent_id','!=',0)->get();


        return view('admin.products.create',[
            'brands'     =>  $brands,
            'tags'       =>  $tags,
            'categories' =>  $categories,
        ]);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'                          =>  'required',
            'brand_id'                      =>  'required',
            'is_active'                     =>  'required',
            'tag_ids'                       =>  'required',
            'description'                   =>  'required',
            'primary_image'                 =>  'required|mimes:jpg,jpeg,png,svg,webp',
            'images'                        =>  'required|array',
            'images.*'                      =>  'required|mimes:jpg,jpeg,png,svg,webp',
            'category_id'                   =>  'required',
            'attribute_ids.*'               =>  'required',
            'delivery_amount'               =>  'required|integer',
            'variation_values'              =>  'required',
            'variation_values.*'            =>  'required|array',
            'variation_values.*.*'          =>  'required',
            'variation_values.price.*'      =>  'required|integer',
            'variation_values.quantity.*'   =>  'required|integer',
            'variation_values.value.*'      =>  'required|string',
            'variation_values.sku.*'        =>  'required|string',
            'delivery_amount_per_product'   =>  'nullable|integer',
        ]);
        dd("Done !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
