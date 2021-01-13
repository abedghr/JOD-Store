<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\Product;
use App\Models\ProductsOfOrders;
use App\Models\Provider;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:provider');
    }



    public function index()
    {
       $orders = Order::where('provider',Auth::user()->id)->with('prodOfOrder')->select()->get();
       
       
       return view("Provider_views.manage_orders",[
           'orders'=>$orders
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        /* $valid = $request->validate([
            'fname'=> 'required',
            'lname'=> 'required',
            'number'=> 'required',
            'city' => 'required',
            'address'=> 'required'
        ]);
        
        $products = "";
        $cart = session()->get('cart');
        $total =0;
        foreach($cart as $cart){
            $products = $products . $cart['id'] . ' ' ;
            $total += $cart['unit_price'];
        }
        $products = substr($products,0,strlen($products)-1);
        
        $total_price = $total + $request->input('city');
        
        $order = Order::create([
            'fname'=>$request->input('fname'),
            'lname'=>$request->input('lname'),
            'phone'=>$request->input('number'),
            'email'=>$request->input('email'),
            'city'=>$request->input('city'),
            'address'=>$request->input('address'),
            'notes'=>$request->input('notes'),
            'products'=>$products,
            'total_price'=>$total_price

        ]);
        session()->flush();
        return redirect()->route('orders.done'); */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $products_order = ProductsOfOrders::where('order_id',$id)->get();
        $count_products = count($products_order);

        

        return view('Provider_views.orders_view',[
            'orders'=>$products_order,
            'count_products'=>$count_products
        ]);
    }

    public function show_details($id){
        $the_order = Order::findorfail($id);
        $products_of_order = ProductsOfOrders::where('order_id',$id)->where('provider',Auth::user()->id)->get();
        Notification::where('type','App\Notifications\OrderNotification')->where('data->id',$id)->update(['read_at'=>Carbon::now()]);
        return view('Provider_views.show_order',[
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
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = Provider::find($id);
        Notification::where('type','App\Notifications\OrderNotification')->where('data->id',$id)->delete();
        Order::where('id',$id)->delete();
        
        
        return redirect()->route('order.index');
    }

    public function order_filter(Request $request){
        if($request->status == 0){
            return redirect()->route('order.index');
        }else{
        $orders = Order::where('order_status',$request->status)->where('provider',Auth::user()->id)->select()->paginate(10);
        }
        $products_orders= array();
        foreach($orders as $order){
        $products_orders[$order->id]= ProductsOfOrders::where('order_id',$order->id)->count();
        }
        return view('Provider_views.manage_orders',[
            'orders'=>$orders,
            'count_products'=>$products_orders
        ]);
    }
}
