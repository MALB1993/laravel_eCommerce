<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application as FoundationApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @param Product $product
     * @return View|Application|Factory|FoundationApplication
     */
    public function show(Product $product): View|Application|Factory|FoundationApplication
    {
        return view('home.products.show',[
            'product'   =>    $product
        ]);
    }
}
