<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:provider');
    }

    public function index()
    {
        $products_number = Product::all()->count();
        $orders_data = Order::where('provider',Auth::user()->id)->where('order_status',3)->select()->get();
        $total = 0;
        foreach($orders_data as $ord){
            $total+= $ord->total_price;
        }
        $visitors_DB = Provider::where('id',Auth::user()->id)->select('visitors')->get();
        $visitors = $visitors_DB[0]->visitors;
        $ordersDone = Order::where('provider',Auth::user()->id)->where('order_status','3')->count();
        $ordersOnDelivery = Order::where('provider',Auth::user()->id)->where('order_status','1')->count();
        $ordersDeclined = Order::where('provider',Auth::user()->id)->where('order_status','-1')->count();
        $ordersFailed = Order::where('provider',Auth::user()->id)->where('order_status','-2')->count();
        $newOrders = Order::where('provider',Auth::user()->id)->where('order_status','0')->count();
        $orders = Order::where('provider',Auth::user()->id)->count();
        return view('Provider_views.provider',[
            'products_number'=>$products_number,
            'orders_number'=>$orders,
            'total_price'=>$total,
            'ordersDone'=>$ordersDone,
            'ordersOnDelivery'=>$ordersOnDelivery,
            'ordersDeclined'=>$ordersDeclined,
            'ordersFailed'=>$ordersFailed,
            'newOrders'=>$newOrders,
            'visitors'=>$visitors
        ]);
    }

    public function profile(){
        return view('Provider_views.profile');
    }

    public function update($id,Request $request){
        $valid = $request->validate([
            'prov_name'=>'required|string',
            'email'=>'required|email',
            'phone1'=>'required'
        ]);

        if($request->hasFile('image')){
            $fileImage = time() . '.' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/Provider_images',$fileImage);
            
            if($request->hasFile('cover_image')){
                $coverImage = time(). '.' . $request->file('cover_image')->getClientOriginalName();
                $request->file('cover_image')->storeAs('public/Provider_coverImages',$coverImage);
                $provider = Provider::where('id',$id)->update([
                    'name'=>$request->prov_name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'phone1'=>$request->phone1,
                    'phone2'=>$request->phone2,
                    'store_type'=>$request->store_type,
                    'address'=>$request->address,
                    'image'=>$fileImage,
                    'cover_image'=>$coverImage,
                    'description'=>$request->description,
                    'facebook'=>$request->facebook,
                    'instagram'=>$request->instagram
                ]);
                return redirect()->route('provider.profile');
            }else{
            $provider = Provider::where('id',$id)->update([
                'name'=>$request->prov_name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'phone1'=>$request->phone1,
                'phone2'=>$request->phone2,
                'store_type'=>$request->store_type,
                'address'=>$request->address,
                'image'=>$fileImage,
                'description'=>$request->description,
                'facebook'=>$request->facebook,
                'instagram'=>$request->instagram
            ]);

            return redirect()->route('provider.profile');
            }
        }else{
            if($request->hasFile('cover_image')){
                $coverImage = time(). '.' . $request->file('cover_image')->getClientOriginalName();
                $request->file('cover_image')->storeAs('public/Provider_coverImages',$coverImage);
                $provider = Provider::where('id',$id)->update([
                    'name'=>$request->prov_name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'phone1'=>$request->phone1,
                    'phone2'=>$request->phone2,
                    'store_type'=>$request->store_type,
                    'address'=>$request->address,
                    'cover_image'=>$coverImage,
                    'description'=>$request->description,
                    'facebook'=>$request->facebook,
                    'instagram'=>$request->instagram
                ]);
                return redirect()->route('provider.profile');
            }else{
                $provider = Provider::where('id',$id)->update([
                    'name'=>$request->prov_name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'phone1'=>$request->phone1,
                    'phone2'=>$request->phone2,
                    'store_type'=>$request->store_type,
                    'address'=>$request->address,
                    'description'=>$request->description,
                    'facebook'=>$request->facebook,
                    'instagram'=>$request->instagram
                ]);
                return redirect()->route('provider.profile');
            }
            
        }
    }
}
