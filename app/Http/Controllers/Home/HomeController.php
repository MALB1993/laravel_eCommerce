<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Banner::query()->where('type','LIKE','slider')->where('is_active','LIKE',1)->orderBy('priority')->get();
        return view('home.index',[
            'sliders'   =>      $sliders
        ]);
    }
}
