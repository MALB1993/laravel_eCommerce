<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductVariationController;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{

    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::latest()->paginate(5, ['*'], __('products'));
        return view('admin.products.index',[
            'products'    =>  $products,
        ]);
    }

    /**
     * Summary of create
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
     * Summary of store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function store(Request $request)
    {
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

        try {

            \Illuminate\Support\Facades\DB::beginTransaction();

            $productImageController = new ProductImageController();
            $fileNameImage = $productImageController->upload($request->primary_image, $request->images);

            $product = Product::create([
            'name'                              =>  $request->name,
            'brand_id'                          =>  $request->brand_id,
            'category_id'                       =>  $request->category_id,
            'primary_image'                     =>  $fileNameImage['fileNamePrimaryImage'],
            'description'                       =>  $request->description,
            'is_active'                         =>  $request->is_active,
            'delivery_amount'                   =>  $request->delivery_amount,
            'delivery_amount_per_product'       =>  $request->delivery_amount_per_product,
            ]);

            foreach($fileNameImage['fileNameImages'] as $fileNameImage)
            {
            ProductImage::create([
                'product_id'    =>  $product->id,
                'image'         =>  $fileNameImage
            ]);
            }

            $productAttributeController = new ProductAttributeController();
            $productAttributeController->store($request->attribute_ids, $product);

            $category = Category::query()->find($request->category_id);
            $productVariationController = new ProductVariationController();
            $productVariationController->store($request->variation_values,$category->attributes()->wherePivot('is_variation',1)->first()->id ,$product);

            $product->tags()->attach($request->tag_ids);
            \Illuminate\Support\Facades\DB::commit();

        } catch (\Exception $ex) {
           \Illuminate\Support\Facades\DB::rollBack();
            Alert::toast(__('Difficulty creating product') . $ex->getCode() , 'danger');
            return redirect()->back();
        }

        Alert::toast(__('create product successfully !'), 'success');
        return redirect()->route('admin-panel.products.index');
    }


    /**
     * Summary of show
     * @param \App\Models\Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Product $product)
    {
        $productAttributes = $product->attributes()->with('attribute')->get();
        $productVariations = $product->variations;

        return view('admin.products.show',[
            'product' => $product,
            'productAttributes' =>  $productAttributes,
            'productVariations' =>  $productVariations
        ]);
    }


    /**
     * Summary of edit
     * @param \App\Models\Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $tags = Tag::all();
        $productAttributes = $product->attributes()->with('attribute')->get();
        $productVariations = $product->variations;
        return view('admin.products.edit',[
            'product'   =>  $product,
            'brands'    =>  $brands,
            'tags'      =>  $tags,
            'productAttributes' =>  $productAttributes,
            'productVariations' =>  $productVariations
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([
            'name'                                   =>       'required|string|min:5|max:200',
            'brand_id'                               =>       'required|exists:brands,id|integer',
            'is_active'                              =>       'required|boolean',
            'tag_ids'                                =>       'required|array',
            'tag_ids.*'                              =>       'required|exists:tags,id|integer',
            'description'                            =>       'required|string|min:300|max:2000',
            'delivery_amount'                        =>       'required|integer',
            'delivery_amount_per_product'            =>       'nullable|integer',
            'attribute_values'                       =>       'required',
            'variation_values'                       =>       'required',
            'variation_values.*.price'               =>       'required|integer',
            'variation_values.*.quantity'            =>       'required|integer',
            'variation_values.*.sku'                 =>       'required|string',
            'variation_values.*.sale_price'          =>       'required|integer',
            'variation_values.*.date_on_sale_from'   =>       'nullable|date',
            'variation_values.*.date_on_sale_to'     =>       'nullable|date',
        ]);


        try {

            \Illuminate\Support\Facades\DB::beginTransaction();



            $product->update([
            'name'                              =>  $request->name,
            'brand_id'                          =>  $request->brand_id,
            'description'                       =>  $request->description,
            'is_active'                         =>  $request->is_active,
            'delivery_amount'                   =>  $request->delivery_amount,
            'delivery_amount_per_product'       =>  $request->delivery_amount_per_product,
            ]);


            $productAttributeController = new ProductAttributeController();
            $productAttributeController->update($request->attribute_values);


            $productVariationController = new ProductVariationController();
            $productVariationController->update($request->variation_values);

            $product->tags()->sync($request->tag_ids);
            \Illuminate\Support\Facades\DB::commit();

        } catch (\Exception $ex) {
           \Illuminate\Support\Facades\DB::rollBack();
            Alert::toast(__('Difficulty updated product') . $ex->getMessage() , 'danger');
            return redirect()->back();
        }

        Alert::toast(__('edit products successfully !'), 'success');
        return redirect()->route('admin-panel.products.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
