<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->orderBy('id','DESC')->paginate(10,['*'],'Orderes');
        
        return view('admin.orders.index',[
            'orders' => $orders
        ]);
    }
}
