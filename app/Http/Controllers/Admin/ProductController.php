<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
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
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        #_____________________________ Brands
        $brands = Brand::query()->where('is_active',1)->latest()->get();

        #_____________________________ Tags
        $tags = Tag::query()->where('is_active',1)->latest()->get();

        #_____________________________ Categories
        $categories = Category::query()->where('parent_id', '!=', 0)->get();

        return view('Admin.Pages.Products.create',compact(['brands', 'tags', 'categories']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $productRequest)
    {

        $productRequest->primary_image->move(
            public_path(
                env('PRODUCT_IMAGE_PRIMARY')
            ),
            generateFileName(
                $productRequest->primary_image->getClientOriginalName()
            )
        );
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
