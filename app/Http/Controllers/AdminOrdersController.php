<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function allOrders(){
        $orders = Order::where('order_status','<>',0)->get();
        return view('Admin.all_orders',[
            'orders'=>$orders
        ]);
    }
}
