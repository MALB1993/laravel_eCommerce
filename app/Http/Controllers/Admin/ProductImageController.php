<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
