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
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(5, ['*'], __('products'));
        return view('admin.products.index',[
            'products'    =>  $products,
        ]);
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
     * Display the specified resource.
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
