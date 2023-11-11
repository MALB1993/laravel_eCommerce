<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders                = Banner::query()->where('type','LIKE','sliders')->where('is_active','LIKE',1)->orderBy('priority')->get();
        $index_banners_top      = Banner::query()->where('type','LIKE','index_banner_top')->where('is_active','LIKE',1)->orderBy('priority')->get();
        $index_banners_bottom   = Banner::query()->where('type','LIKE','index_banner_bottom')->where('is_active','LIKE',1)->orderBy('priority')->get();
        $products               = Product::query()->where('is_active','1')->where('status',1)->get()->take(10);

        return view('home.index',[
            'sliders'               =>      $sliders,
            'index_banners_top'     =>      $index_banners_top,
            'index_banners_bottom'  =>      $index_banners_bottom,
            'products'              =>      $products
        ]);
    }
}
