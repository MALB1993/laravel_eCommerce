<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('Admin.Pages.Products.index');
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
        #______________________________________ try and catch for create category and pivot table
        try {
            #_______________________ Start transaction database
            DB::beginTransaction();
            $productImageController = new ProductImageController();
            $fileNameImages =   $productImageController->upload($productRequest->primary_image, $productRequest->images);

            $product = Product::create([
                'name'                    =>     $productRequest->name,
                'brand_id'                =>     $productRequest->brand_id,
                'category_id'             =>     $productRequest->category_id,
                'primary_image'           =>     $fileNameImages['fileNamePrimaryImage'],
                'description'             =>     $productRequest->description,
                'is_active'               =>     $productRequest->is_active,
                'delivery_amount'         =>     $productRequest->delivery_amount,
                'delivery_amount_per_pro' =>     $productRequest->delivery_amount_per_pro,
                'updated_at'              =>     null
            ]);

            foreach ($fileNameImages['imageFileName'] as $fileNameImage)
            {
                ProductImage::create([
                    'product_id'         =>      $product->id,
                    'image'              =>      $fileNameImage,
                    'updated_at'         =>      null
                ]);
            }

            $productAttributeController = new ProductAttributeController();
            $productAttributeController->store($productRequest, $product);

            $category = Category::find($productRequest->category_id);

            $productVariationController = new  ProductVariationController();

            $productVariationController->store(
                $productRequest->variation_values,
                $category->attributes()->wherePivot('is_variation',1)->first()->id,
                $product
            );

            $product->tags()->attach($productRequest->tag_ids, [
                'created_at'    =>      Carbon::now(),
                'updated_at'    =>      null
            ]);

            DB::commit();
            #_______________________ End transaction database
        } catch (\Exception $exception) {
            DB::rollBack();
            #_________________________________________ variables
            $message = 'مشکل در ذخیره محصول به وجود آمده است .';

            #_________________________________________ Sweet Alert
            alert()->error($message, $exception->getMessage())->persistent('متوجه شدم');

            #_________________________________________ pass message and redirect
            return redirect()->back();

        }
        #_________________________________________[ if every thing passed ]

        #_________________________________________ variables
        $message = 'محصول شما به درستی ذخیره شد';

        #_________________________________________ Sweet Alert
        alert()->success('گزارش وضعیت', $message);

        #_________________________________________ pass message and redirect
        return redirect()->route('admin.products.index');

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
