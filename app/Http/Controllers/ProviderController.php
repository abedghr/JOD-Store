<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\Provider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function chat(){
        
        $users = DB::select("select users.id, users.name, users.email, count(is_read) as unread 
        from users LEFT JOIN messages ON users.id = messages.from_user and is_read = 0 and messages.to_provider = ".Auth::id()." group by users.id,users.name,users.email");

        return view('Provider_views.chat_view',[
            'users'=>$users
        ]);
    }

    public function getMessage($user_id){
        $my_id = Auth::id();


        Message::where(['from_user'=> $user_id,'to_provider'=>$my_id])->update(['is_read'=>1]);

        $messages = Message::Where(function($query) use ($user_id , $my_id) {
            $query->where('from_provider',$my_id)->where('to_user',$user_id);
        })->orWhere(function($query) use ($user_id , $my_id) {
            $query->where('from_user',$user_id)->where('to_provider',$my_id);
        })->get();

        return view('Provider_views.messages',[
            'messages'=>$messages
        ]);
    }

    public function sendMessage(Request $request){
        
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        Message::create([
            'from_provider' =>$from,
            'to_user'=>$to,
            'message'=>$message,
            'is_read'=>0
        ]);

        $data = [
            'from_user' => $from,
            'to_provider'=>$to,
        ];
        event(new NewMessage($data));
        
    }
}
