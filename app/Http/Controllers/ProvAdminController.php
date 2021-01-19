<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\AdminsOfProvider;
use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProvAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin_provider');
    }

    
    public function profile(){
        $notify = Notification::where('notifiable_id',Auth::user()->provider)->where('notifiable_type','App\Models\Provider')->get();
        return view('provAdmin_views.profile',[
            'notifications'=>$notify
        ]);
    }

    public function update($id,Request $request){
        $valid = $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'confirmed',
        ]);
        if(isset($request->password) || !empty($request->password)){
        $provAdmin = AdminsOfProvider::where('id',$id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        }else{
            $provAdmin = AdminsOfProvider::where('id',$id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
            ]);
        }
        return redirect()->route('provAdmin.profile');
    }

    public function expire(){
        return view('provAdmin_views.expire_subscribe');
    }

    public function index(){
        
        $products_number = Product::where('provider',Auth::user()->provider)->count();
        $orders_data = Order::where('provider',Auth::user()->provider)->where('order_status',3)->select()->get();
        $total = 0;
        foreach($orders_data as $ord){
            $total+= $ord->total_price;
        }
        $visitors_DB = Provider::where('id',Auth::user()->provider)->select('visitors')->get();
        $visitors = $visitors_DB[0]->visitors;
        $ordersDone = Order::where('provider',Auth::user()->provider)->where('order_status','3')->count();
        $ordersOnDelivery = Order::where('provider',Auth::user()->provider)->where('order_status','1')->count();
        $ordersDeclined = Order::where('provider',Auth::user()->provider)->where('order_status','-1')->count();
        $ordersFailed = Order::where('provider',Auth::user()->provider)->where('order_status','-2')->count();
        $newOrders = Order::where('provider',Auth::user()->provider)->where('order_status','0')->count();
        $orders = Order::where('provider',Auth::user()->provider)->count();
        return view('provAdmin_views.provAdmin',[
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

    
    public function chat(){
        
        $users = DB::select("select users.id, users.name, users.email, count(is_read) as unread 
        from users LEFT JOIN messages ON users.id = messages.from_user and is_read = 0 and messages.to_provider = ".Auth::user()->provider." group by users.id,users.name,users.email ORDER BY messages.is_read desc");

        return view('provAdmin_views.chat_view',[
            'users'=>$users
        ]);
    }

    public function getMessage($user_id){
        $my_id = Auth::user()->provider;


        Message::where(['from_user'=> $user_id,'to_provider'=>$my_id])->update(['is_read'=>1]);

        $messages = Message::Where(function($query) use ($user_id , $my_id) {
            $query->where('from_provider',$my_id)->where('to_user',$user_id);
        })->orWhere(function($query) use ($user_id , $my_id) {
            $query->where('from_user',$user_id)->where('to_provider',$my_id);
        })->get();

        return view('provAdmin_views.messages',[
            'messages'=>$messages
        ]);
    }

    public function sendMessage(Request $request){
        
        $from = Auth::user()->provider;
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

    public function all_notifications(){
        $provider = Provider::find(Auth::user()->provider);
        $notifications = $provider->notifications()->orderBy('created_at','desc')->get();
        return view('provAdmin_views.all_notifications',[
            'notifications'=>$notifications
        ]);
    }

    public function delete_notification($id){
        Notification::where('id',$id)->delete();
        return redirect(url()->previous());
    }

}
