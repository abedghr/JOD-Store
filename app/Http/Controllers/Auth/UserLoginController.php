<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Order;
use App\Models\ProductsOfOrders;
use App\Models\Provider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{
    public function user_login(Request $request){
        $valid = $request->validate([
            'email'=>'required|string|email|exists:users',
            'password'=>'required|string|min:8'
        ]);

            $user = User::where('email',$request->email)->get();
            
            if(Hash::check($request->password, $user[0]->password)){
                session(['user'=>['user_id'=>$user[0]->id,'userName'=>$user[0]->name]]);
                return redirect()->route('home2');
            }
            else{
                return redirect()->back()->withInput()
                ->withErrors([
                    'password' => 'Incorrect password!'
                ]);
    
            }
    }

    public function user_login_view(){
        if(session()->has('user') && session('user') != []){
            return redirect()->route('home2');
        }else{
        return view('auth.login');
        }
    }

    public function user_logout(){
        if(session()->has('user')){
            session()->forget('user');
            return redirect(url()->previous());
        }
    }

    public function user_register_view(){
        
        if(session()->has('user') && session('user') != []){
            return redirect()->route('home2');
        }else{
        return view('auth.register');
        }
    }

    public function user_register(Request $request){
        $valid = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone1'=> ['required']
        ]);
        if(User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone1,
            'Address'=>$request->address
        ])){
            $user = User::where('email',$request->email)->get();
                session(['user'=>['user_id'=>$user[0]->id,'userName'=>$user[0]->name]]);
                return redirect()->route('home2');
        }
    }

    public function profile(){
        $user = session()->get('user');
        if($user != null || isset($user)){
            $userData = User::find($user['user_id']);
            $cities = City::all();
            $orders = Order::where('email',$userData->email)->OrderBy('created_at','desc')->get();
            $productsOrders = Array();
            $i = 0;
            foreach($orders as $order){
                $prodOrders = ProductsOfOrders::where('order_id',$order->id)->get();
                foreach($prodOrders as $prod){
                    $productsOrders[$i] = ['order_id'=>$prod->order_id , 'prod_name'=>$prod->prod_name , 'price'=>$prod->new_price , 'quantity'=>$prod->quantity , 'category'=>$prod->cat->cat_name , 'provider'=>$prod->provid->name , 'image'=>$prod->main_image];
                    $i++;
                }
            
            }
            return view('public_views.user_profile',[
                'user'=>$user,
                'userData'=>$userData,
                'cities'=>$cities,
                'yourOrders'=>$orders,
                'productsOrder'=>$productsOrders
            ]);
        }else{
            return redirect()->route('home2');
        }
    }
    public function profile2(){
        $category = Category::all();
        $providers = Provider::where('email_verified_at','<>',null)->get();
        $user = session()->get('user');
        if($user != null || isset($user)){
            $userData = User::find($user['user_id']);
            $cities = City::all();
            $orders = Order::where('email',$userData->email)->OrderBy('created_at','desc')->get();
            $productsOrders = Array();
            $i = 0;
            foreach($orders as $order){
                $prodOrders = ProductsOfOrders::where('order_id',$order->id)->get();
                foreach($prodOrders as $prod){
                    $productsOrders[$i] = ['order_id'=>$prod->order_id , 'prod_name'=>$prod->prod_name , 'price'=>$prod->new_price , 'quantity'=>$prod->quantity , 'category'=>$prod->cat->cat_name , 'provider'=>$prod->provid->name , 'image'=>$prod->main_image];
                    $i++;
                }
            
            }
            return view('public_side.user_profile',[
                'categories' => $category,
                'providers'=>$providers,
                'user'=>$user,
                'userData'=>$userData,
                'cities'=>$cities,
                'yourOrders'=>$orders,
                'productsOrder'=>$productsOrders
            ]);
        }else{
            return redirect()->route('home2');
        }
    }

    public function update($id,Request $request){
        $valid = $request->validate([
            'user_name' => 'required',
            'user_email' => 'required'
        ]);
        
        User::where('id',$id)->update([
            'name'=>$request->user_name,
            'lname'=>$request->user_lname,
            'email'=>$request->user_email,
            'phone'=>$request->user_phone1,
            'phone2'=>$request->user_phone2,
            'city'=>$request->user_city,
            'Address'=>$request->user_address,
        ]);
        return redirect()->route('user.profile');
    }
}
