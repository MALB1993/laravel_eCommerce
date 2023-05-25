<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{

    public function upload($primaryImage, $images)
    {
        $fileNamePrimaryImage = generateFileName($primaryImage->getClientOriginalName());
        $primaryImage->move(public_path(env('PRODUCT_IMAGE_PRIMARY')), $fileNamePrimaryImage);

        $imageFileName = [];
        foreach ($images as $image)
        {

            $fileNameImage = generateFileName($image->getClientOriginalName());
            $image->move(public_path(env('PRODUCT_IMAGE_PRIMARY')), $fileNameImage);
            $imageFileName[] = $fileNameImage;
        }


        return [
            'fileNamePrimaryImage'  =>  $fileNamePrimaryImage,
            'imageFileName'         =>  $imageFileName,
        ];

    }
}
