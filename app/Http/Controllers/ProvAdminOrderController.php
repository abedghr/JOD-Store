<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductsOfOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\Provider;
use Carbon\Carbon;

class ProvAdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin_provider');
    }

    public function index()
    {
       $orders = Order::where('provider',Auth::user()->provider)->select()->get();
       $products_orders= array();
       foreach($orders as $order){
        $products_orders[$order->id]= ProductsOfOrders::where('order_id',$order->id)->count();
       }
       
       return view("provAdmin_views.manage_orders",[
           'orders'=>$orders,
           'count_products'=>$products_orders
       ]);
    }

    public function show($id)
    {
        $products_order = ProductsOfOrders::where('order_id',$id)->get();
        $count_products = count($products_order);

        

        return view('provAdmin_views.orders_view',[
            'orders'=>$products_order,
            'count_products'=>$count_products
        ]);
    }

    public function show_details($id){
        $the_order = Order::findorfail($id);
        $products_of_order = ProductsOfOrders::where('order_id',$id)->where('provider',Auth::user()->provider)->get();
        Notification::where('type','App\Notifications\OrderNotification')->where('data->id',$id)->update(['read_at'=>Carbon::now()]);
        return view('provAdmin_views.show_order',[
            'order'=>$the_order,
            'products'=>$products_of_order
        ]);
    }

    public function accept(Request $request){
        Order::where('id',$request->id)->update([
            'order_status'=>1
        ]);
        $order = Order::find($request->id);
        return response()->json(['order_state'=>$order->order_done]);
    }
    
    public function decline(Request $request){
        Order::where('id',$request->id)->update([
            'order_status'=>-1
        ]);
        $order = Order::find($request->id);
        return response()->json(['order_state'=>$order->order_done]);
    }
    public function delivery_process(Request $request){
        Order::where('id',$request->id)->update([
            'order_status'=>2
        ]);
        $order = Order::find($request->id);
        return response()->json(['order_state'=>$order->order_done]);
    }
    
    public function received_order(Request $request){
        Order::where('id',$request->id)->update([
            'order_status'=>3
        ]);
        $order = Order::find($request->id);
        return response()->json(['order_state'=>$order->order_done]);
    }
    
    public function unreceived_order(Request $request){
        Order::where('id',$request->id)->update([
            'order_status'=>-2
        ]);
        $order = Order::find($request->id);
        return response()->json(['order_state'=>$order->order_done]);
    }

    public function destroy($id)
    {
        $provider = Provider::find($id);
        Order::where('id',$id)->delete();
        
        
        return redirect()->route('provAdmin.order.index');
    }

    public function order_filter(Request $request){
        if($request->status == 0){
            return redirect()->route('provAdmin.order.index');
        }else{
        $orders = Order::where('order_status',$request->status)->where('provider',Auth::user()->provider)->select()->get();
        }
        $products_orders= array();
        foreach($orders as $order){
        $products_orders[$order->id]= ProductsOfOrders::where('order_id',$order->id)->count();
        }
        return view('provAdmin_views.manage_orders',[
            'orders'=>$orders,
            'status'=>$request->status,
            'count_products'=>$products_orders
        ]);
    }
}
