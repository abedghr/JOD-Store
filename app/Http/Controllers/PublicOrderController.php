<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;
use App\Models\Category;
use App\Models\City;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductsOfOrders;
use App\Models\Provider;
use App\Models\Notification as Notify;
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

    public function tracking2(){
        $user = session()->get('user');
        $categories = Category::all();
        $providers = Provider::where('email_verified_at','<>',null)->get();
        if(session()->has('user')){
            return view('public_side.tracking_order',[
                'categories'=>$categories,
                'providers'=>$providers,
                'user'=>$user
            ]);
        }else{
            return view('public_side.tracking_order',[
                'categories'=>$categories,
                'providers'=>$providers
            ]);
        }
        
    }

    public function checkout2(){
        $categories = Category::all();
        $providers = Provider::where('email_verified_at','<>',null)->get();
        if(session()->has('user')){
        $user = session()->get('user');
        $user_data = User::where('id',$user['user_id'])->get();
        }
        $cities = City::all();
        if(session()->has('cart')){
            $providers0 = session()->get('providers');
            $count_provider = count($providers0);
            $cart = session()->get('cart');
            if(session()->has('user')){
                return view('public_side.checkout',[
                    'categories' => $categories,
                    'providers'=>$providers,
                    'cart'=>$cart,
                    'cities'=>$cities,
                    'providers0'=>$providers0,
                    'count_provider'=>$count_provider,
                    'user'=>$user,
                    'user_data'=>$user_data
                ]);
            }else{
                return view('public_side.checkout',[
                    'categories' => $categories,
                    'providers'=>$providers,
                    'cart'=>$cart,
                    'cities'=>$cities,
                    'providers0'=>$providers0,
                    'count_provider'=>$count_provider,
                ]);
            }
            
        }else{
            return redirect()->route('cart.index2',[
                'categories' => $categories,
                'providers'=>$providers
            ]);
        }
    }

    public function checkout_process2(Request $request){
        $valid = $request->validate([
            'fname'=> 'required',
            'lname'=> 'required',
            'email'=>'required',
            'number'=> 'required',
            'city' => 'required|not_in:none',
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
            $the_notify = Notify::latest()->first()->update([
                'order_id'=> $new_order->id,
                'provider_id'=>$provider['provider_id']
            ]);
            
           
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


        $delivery = City::where('city',$request->input('city'))->get();
        
        $your_total_price = session()->get('total_price');


        foreach($providers as $provider){
            $your_total_price += $delivery[0]->delivery_price;
            session()->forget('providers_total_'.$provider['provider_id']);
        }
        session()->forget('cart');
        session()->forget('providers');
        session()->forget('total_price');
        session()->forget('counter');
        if(session()->has('user')){
            $user = session()->get('user');
            $user_data = User::where('id',$user['user_id'])->get();
        }else{
            session()->forget('user');
            $user_data[0] = [];
        }

        return redirect()->route('orders.done2')->with(['your_orders'=>$your_orders , 'email'=>$request->email , 'city'=>$request->city , 'address'=>$request->address , 'total_price' => $your_total_price]);
        /* return view('public_views.order_done',[
            
            'your_orders'=>$your_orders
            
        ]); */
        
    }

    public function orderDone2 (Request $request){
        if(session()->has('user') && session('user') != []){
            $user = session()->get('user');
            $user_data = User::where('id',$user['user_id'])->get();
        }else{
           $the_user = session(['user'=>['user_id'=>'','userName'=>'']]);
           $user = $the_user;
           session()->forget('user');
           $user_data[0] = [];
        }
        $categories = Category::all();
        $providers = Provider::where('email_verified_at','<>',null)->get();
        $your_orders = FacadesSession::get('your_orders');
        $your_email = FacadesSession::get('email');
        $your_city = FacadesSession::get('city');
        $your_address = FacadesSession::get('address');
        $your_total_price = FacadesSession::get('total_price');
        if(session()->has('your_orders') && session()->has('email')){
        return view('public_side.order_done',[
            'categories' => $categories,
            'providers'=>$providers,
            'user'=>$user,
            'your_orders'=>$your_orders,
            'email'=>$your_email,
            'city'=>$your_city,
            'address'=>$your_address,
            'total_price'=>$your_total_price
        ]);
        }else{
            return redirect()->route('home2');
        }
    }

    public function show_tracking(Request $request){
        $order = Order::where('id',$request->order_id)->get();
        
        $output = '';
        if(!empty($order[0])){
            if($order[0]->order_status == 0){
                $view = view('ajax.tracking_order_zero')->with(['order_id'=>$request->order_id])->renderSections();
                return response()->json([
                    'status' => true,
                    'content'=>$view['main']
                ]);
                
            }elseif($order[0]->order_status == 1){
                $view = view('ajax.tracking_order_one')->with(['order_id'=>$request->order_id])->renderSections();
                return response()->json([
                    'status' => true,
                    'content'=>$view['main']
                ]);
                
            }elseif($order[0]->order_status == 3 || $order[0]->order_status == 2){
                $view = view('ajax.tracking_order_2and3')->with(['order_id'=>$request->order_id])->renderSections();
                return response()->json([
                    'status' => true,
                    'content'=>$view['main']
                ]);
                
            }elseif($order[0]->order_status == -1 ){
                $view = view('ajax.tracking_order_minusOne')->with(['order_id'=>$request->order_id])->renderSections();
                return response()->json([
                    'status' => true,
                    'content'=>$view['main']
                ]);
                
            }elseif($order[0]->order_status == -2){
                $view = view('ajax.tracking_order_minusTwo')->with(['order_id'=>$request->order_id])->renderSections();
                return response()->json([
                    'status' => true,
                    'content'=>$view['main']
                ]);
                
            }
        }else{
            $output = "Not Exist!";
        }
        return $output;
    }

    public function show_orders(Request $request){
        $orders = Order::where('phone',$request->user_phone)->select('id','created_at')->get();
        if(!empty($orders[0])){
            $view = view('ajax.show_orders')->with(['orders'=>$orders])->renderSections();
                return response()->json([
                    'status' => true,
                    'content'=>$view['main']
                ]);
            $output = '<header class="card-header mb-4 bg-light" style="border:1px solid silver height:"><h4>Your Orders :<a href="'.route('user.profile2').'" class=""> View all</a></h4></header>';
            foreach($orders as $order){
                $output.='<li class="list-group-item">('.$order->created_at->format('Y-m-d').') &nbsp;Order ID : '.$order->id.'</li>';
            }
        }else{
            $output = "Not Exist!";
        }
        return $output;
    }
}
