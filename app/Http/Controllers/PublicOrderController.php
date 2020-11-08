<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;
use App\Models\City;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductsOfOrders;
use App\Models\Provider;
use App\Notifications\OrderNotification;
use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session as FacadesSession;

class PublicOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    public function tracking(){
        $user = session()->get('user');
        
        return view('public_views.tracking_order',[
            'user'=>$user
        ]);
    }

    public function checkout(){
        if(session()->has('user') && session('user') != []){
        $user = session()->get('user');
        $user_data = User::where('id',$user['user_id'])->get();
        }else{
           $the_user = session(['user'=>['user_id'=>'','userName'=>'']]);
           $user = $the_user;
           session()->forget('user');
           $user_data[0] = [];
        }
        $user_data = $user['user_id'] ?  User::where('id',$user['user_id'])->get() : [];
        $cities = City::all();
        if(session()->has('cart') && session('cart')!=[]){
            $providers = session()->get('providers');
            $count_provider = count($providers);
            $cart = session()->get('cart');
            return view('public_views.checkout',[
                'cart'=>$cart,
                'cities'=>$cities,
                'providers'=>$providers,
                'count_provider'=>$count_provider,
                'user'=>$user,
                'user_data'=>$user_data
            ]);
        }else{
            return redirect()->route('cart.index');
        }
    }

    public function checkout_process(Request $request){
        $valid = $request->validate([
            'fname'=> 'required',
            'lname'=> 'required',
            'number'=> 'required',
            'city' => 'required',
            'address'=> 'required'
        ]);


        
        $products = "";
        $cart= session()->has('cart') ? session()->get('cart') : [];
        $providers= session()->has('providers') ? session()->get('providers') : [];
        $total = session()->get('total_price');
        $your_orders=array();
        $i=0;
        foreach($providers as $provider){
            $prov_total = session()->get('providers_total_'.$provider['provider_id']);
            $del_price = City::where('city',$request->city)->select('delivery_price')->get();
            
            Order::create([
                'fname'=>$request->input('fname'),
                'lname'=>$request->input('lname'),
                'phone'=>$request->input('number'),
                /* 'phone2'=>$request->input('number2'), */
                'email'=>$request->input('email'),
                'city'=>$request->input('city'),
                'Address'=>$request->input('address'),
                'notes'=>$request->input('notes'),
                'provider'=>$provider['provider_id'],
                'total_price'=>session()->get('providers_total_'.$provider['provider_id']),
                'total_With_Delivery'=>$prov_total+$del_price[0]->delivery_price
            ]);

            $new_order = Order::latest()->first();
            $your_orders[$i] =$new_order->id;
            $i++;
            $prov = Provider::where('id',$provider['provider_id'])->get();
            Notification::send($prov, new OrderNotification($new_order));
            $data  = [
                'order_id'=>$new_order->id,
                'name'=> $request->input('fname'),
                'email'=> $request->input('email'),
                'city'=> $request->input('city'),
                'provider_id'=> $provider['provider_id'],
                'total_price'=> session()->get('providers_total_'.$provider['provider_id']),
                'date'=>'',
                'time'=>''
            ];

            event(new NewNotification($data));

            $last = Order::orderBy('created_at','desc')->first();  
            foreach($cart as $ca){
                foreach($ca as $car){
                    if($car['provider_id']== $provider['provider_id']){
                        
                        ProductsOfOrders::create([
                        'prod_name'=>$car['title'],
                        'new_price'=>$car['unit_price'],
                        'quantity'=>$car['quantity'],
                        'category'=>$car['category_id'],
                        'provider'=>$car['provider_id'],
                        'main_image'=>$car['image'],
                        'order_id'=>$last->id
                        ]);
                        
                        $the_prod = Product::where('id',$car['id'])->get();
                        
                        Product::where('id',$car['id'])->update([
                            'inventory' => $the_prod[0]->inventory - $car['quantity'],
                            'number_of_bought' => $the_prod[0]->number_of_bought + 1
                        ]);
                    }
                }
            }

            
        }

        


        foreach($providers as $provider){
            session()->forget('providers_total_'.$provider['provider_id']);
        }
        session()->forget('cart');
        session()->forget('providers');
        session()->forget('total_price');
        session()->forget('counter');
        if(session()->has('user') && session('user') != []){
            $user = session()->get('user');
            $user_data = User::where('id',$user['user_id'])->get();
        }else{
            $the_user = session(['user'=>['user_id'=>'','userName'=>'']]);
           $user = $the_user;
           session()->forget('user');
           $user_data[0] = [];
        }

        return redirect()->route('orders.done')->with(['your_orders'=>$your_orders , 'email'=>$request->email]);
        /* return view('public_views.order_done',[
            
            'your_orders'=>$your_orders
            
        ]); */
        
    }

    public function orderDone (Request $request){
        if(session()->has('user') && session('user') != []){
            $user = session()->get('user');
            $user_data = User::where('id',$user['user_id'])->get();
        }else{
            $the_user = session(['user'=>['user_id'=>'','userName'=>'']]);
           $user = $the_user;
           session()->forget('user');
           $user_data[0] = [];
        }
        $your_orders = FacadesSession::get('your_orders');
        $your_email = FacadesSession::get('email');

        if(session()->has('your_orders') && session()->has('email')){
        return view('public_views.order_done',[
            'user'=>$user,
            'your_orders'=>$your_orders,
            'email'=>$your_email
        ]);
        }else{
            return redirect()->route('home');
        }
    }

    public function show_tracking(Request $request){
        $order = Order::where('id',$request->order_id)->get();
        $output = '';
        if(!empty($order[0])){
            if($order[0]->order_status == 0){
                $output = '<article class="card">
                <header class="card-header"><h6>Order ID: '.$request->order_id.'</h6></header>
                <div class="card-body">
                    <div class="track">
                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Order Pending</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> Order confirmed</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On Delivery</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Done</span> </div>
                    </div>
                    <hr>
                    <a href="#" class="btn submit_btn" data-abc="true"> <i class="fa fa-eye"></i> Show The order</a>
                </div>
            </article>';
            }elseif($order[0]->order_status == 1){
                $output = '<article class="card">
                <header class="card-header"><h6>Order ID: '.$request->order_id.'</h6></header>
                <div class="card-body">
                    <div class="track">
                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Order Pending</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> Order confirmed</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On Delivery</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Done</span> </div>
                    </div>
                    <hr>
                    <a href="#" class="btn submit_btn" data-abc="true"> <i class="fa fa-eye"></i> Show The order</a>
                </div>
            </article>';
            }elseif($order[0]->order_status == 3 || $order[0]->order_status == 2){
                $output = '<article class="card">
                <header class="card-header"><h6>Order ID: '.$request->order_id.'</h6></header>
                <div class="card-body">
                    <div class="track">
                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Order Pending</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> Order confirmed</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On Delivery</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Done</span> </div>
                    </div>
                    <hr>
                    <a href="#" class="btn submit_btn" data-abc="true"> <i class="fa fa-eye"></i> Show The order</a>
                </div>
            </article>';
            }elseif($order[0]->order_status == -1 ){
                $output = '<article class="card">
                <header class="card-header"><h6>Order ID: '.$request->order_id.'</h6></header>
                <div class="card-body">
                    <div class="track">
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Pending</span> </div>
                        <div class="step active-failed"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text"> Order declined</span> </div>
                        <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On Delivery</span> </div>
                        <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Done</span> </div>
                    </div>
                    <hr>
                    <a href="#" class="btn submit_btn" data-abc="true"> <i class="fa fa-eye"></i> Show The order</a>
                </div>
            </article>';
            }elseif($order[0]->order_status == -2){
                $output = '<article class="card">
                <header class="card-header"><h6>Order ID: '.$request->order_id.'</h6></header>
                <div class="card-body">
                    <div class="track">
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Pending</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text"> Order declined</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On Delivery</span> </div>
                        <div class="step active-failed"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text">Un-received Order</span> </div>
                    </div>
                    <hr>
                    <a href="#" class="btn submit_btn" data-abc="true"> <i class="fa fa-eye"></i> Show The order</a>
                </div>
            </article>';
            }
        }else{
            $output = "Not Exist!";
        }
        return $output;
    }

    public function show_orders(Request $request){
        $orders = Order::where('phone',$request->user_phone)->select('id','created_at')->get();
        if(!empty($orders[0])){
            $output = '';
            foreach($orders as $order){
                $output.='<li class="list-group-item">('.$order->created_at->format('Y-m-d').') &nbsp;Order ID : '.$order->id.'  &nbsp;<a href="">View Order</a></li>';
            }
        }else{
            $output = "Not Exist!";
        }
        return $output;
    }
}
