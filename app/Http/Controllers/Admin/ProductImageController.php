<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class ProductImageController extends Controller
{

    /**
     * Summary of upload
     * @param mixed $primary_image
     * @param mixed $images
     * @return array
     */
    public function upload($primary_image, $images)
    {
        $fileNamePrimaryImage = generateFileName($primary_image->getClientOriginalName());
        $primary_image->move(public_path(env('PRODUCT_IMAGE_UPLOAD_PATH')),$fileNamePrimaryImage);

        $fileNameImages = [];
        foreach($images as $image)
        {
            $fileNameImage = generateFileName($image->getClientOriginalName());
            $image->move(public_path(env('PRODUCT_IMAGE_UPLOAD_PATH')),$fileNameImage);

            array_push($fileNameImages, $fileNameImage);
        }

        return [
            'fileNamePrimaryImage'  => $fileNamePrimaryImage,
            'fileNameImages'        => $fileNameImages
        ];
    }


    /**
     * Summary of edit
     * @param \App\Models\Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit_images',[
            'product' => $product
        ]);
    }


    /**
     * Summary of destroy
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function destroy(Request $request)
    {
        $product_images = ProductImage::findOrFail($request->image_id);

        $request->validate([
            'image_id'  =>  'required|exists:product_images,id'
        ]);

        ProductImage::destroy($request->image_id);
        if(File::exists(public_path(env('PRODUCT_IMAGE_UPLOAD_PATH').'/'.$product_images->image))){
            File::delete(public_path(env('PRODUCT_IMAGE_UPLOAD_PATH').'/'.$product_images->image));
        }

        Alert::toast(__('The desired image was deleted correctly!'),'success');
        return redirect()->back();

    }


    /**
     * Summary of set_primary
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function set_primary(Request $request ,Product $product)
    {

        $request->validate([
            'image_id'  =>  'required|exists:product_images,id'
        ]);

        $product_images = ProductImage::findOrFail($request->image_id);

        $product->update([
            'primary_image' =>  $product_images->image
        ]);

        Alert::toast(__('The original image of the product was correctly registered!'),'success');
        return redirect()->back();
    }


    public function add(Request $request ,Product $product)
    {

        $request->validate([
            'primary_image'                 =>  'nullable|mimes:jpg,jpeg,png,svg,webp',
            'images'                        =>  'nullable|array',
            'images.*'                      =>  'mimes:jpg,jpeg,png,svg,webp',
        ]);

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            if($request->primary_image === null && $request->images === null)
            {
                return redirect()->back()->withErrors(['message' => __('Required fields')]);
            }

            if($request->has('primary_image'))
            {
                $fileNamePrimaryImage = generateFileName($request->primary_image->getClientOriginalName());
                $request->primary_image->move(public_path(env('PRODUCT_IMAGE_UPLOAD_PATH')),$fileNamePrimaryImage);
                $product->update([
                    'primary_image' => $fileNamePrimaryImage
                ]);
            }


            if($request->has('images'))
            {
                foreach($request->images as $image)
                {
                    $fileNameImage = generateFileName($image->getClientOriginalName());
                    $image->move(public_path(env('PRODUCT_IMAGE_UPLOAD_PATH')),$fileNameImage);

                    ProductImage::create([
                        'product_id'    =>  $product->id,
                        'image'         =>  $fileNameImage
                    ]);
                }
            }
            \Illuminate\Support\Facades\DB::commit();

        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\DB::rollBack();
            Alert::toast(__('Difficulty creating product images') . $ex->getCode() , 'danger');
            return redirect()->back();
        }

        Alert::toast(__('edit product image successfully !'), 'success');
        return redirect()->back();

    }

}
