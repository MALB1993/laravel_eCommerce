<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function show(Category $category)
    {
        $attributes = $category->attributes()->where('is_filter','LIKE',1)->with('values')->get();
        $variation = $category->attributes()->where('is_variation','LIKE',1)->with('variationsValues')->first();

        return view('home.categories.show',[
            'category'      =>  $category,
            'attributes'    =>  $attributes,
            'variation'     =>  $variation
        ]);
    }
}
