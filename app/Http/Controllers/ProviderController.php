<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Feedback;
use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Notification;
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

    private function getPaymentStatus($id,$resourcePath){
        $url = "https://test.oppwa.com/";
        $url .= $resourcePath;
	$url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                   'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$responseData = curl_exec($ch);
	if(curl_errno($ch)) {
		return curl_error($ch);
	}
	curl_close($ch);
	return json_decode($responseData,true);
    }

    public function renewal_subscirbe(){
        if(request('id') && request('resourcePath')){
            $payment_status = $this->getPaymentStatus(request('id'), request('resourcePath'));
            if(isset($payment_status['id'])){
                $success = true;
                Provider::where('id',Auth::user()->id)->update([
                    'subscribe'=>30
                ]);
                return view('Provider_views.renewal_subscribe')->with(['success'=>$success]);
            }else{
                $failed = true;
                return view('Provider_views.renewal_subscribe')->with(['failed'=>$failed]);
            }
        }
        return view('Provider_views.renewal_subscribe');
    }


    public function index()
    {
        
        $products_number = Product::where('provider',Auth::user()->id)->count();
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
        $orders = Order::where('provider',Auth::user()->id)->count();
        $feedbacks = Feedback::where('provider_id',Auth::user()->id)->count();
        return view('Provider_views.provider',[
            'products_number'=>$products_number,
            'orders_number'=>$orders,
            'total_price'=>$total,
            'ordersDone'=>$ordersDone,
            'ordersOnDelivery'=>$ordersOnDelivery,
            'ordersDeclined'=>$ordersDeclined,
            'ordersFailed'=>$ordersFailed,
            'visitors'=>$visitors,
            'feedbacks'=>$feedbacks
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
            /* $request->file('image')->storeAs('public/Provider_images',$fileImage); */
            $request->file('image')->move('img/Provider_images',$fileImage);
            
            if($request->hasFile('cover_image')){
                $coverImage = time(). '.' . $request->file('cover_image')->getClientOriginalName();
                /* $request->file('cover_image')->storeAs('public/Provider_coverImages',$coverImage); */
                $request->file('cover_image')->move('img/Provider_coverImages',$coverImage);
                
                if(isset($request->password) || !empty($request->password)){
                    $request->validate([
                        'password'=>'min:8|confirmed'
                    ]);
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
                }else{
                    $provider = Provider::where('id',$id)->update([
                        'name'=>$request->prov_name,
                        'email'=>$request->email,
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
                }
                return redirect()->route('provider.profile');
            }else{
                if(isset($request->password) || !empty($request->password)){
                    $request->validate([
                        'password'=>'min:8|confirmed'
                    ]);
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
                }else{
                    $provider = Provider::where('id',$id)->update([
                        'name'=>$request->prov_name,
                        'email'=>$request->email,
                        'phone1'=>$request->phone1,
                        'phone2'=>$request->phone2,
                        'store_type'=>$request->store_type,
                        'address'=>$request->address,
                        'image'=>$fileImage,
                        'description'=>$request->description,
                        'facebook'=>$request->facebook,
                        'instagram'=>$request->instagram
                    ]);
                }

            return redirect()->route('provider.profile');
            }
        }else{
            if($request->hasFile('cover_image')){
                $coverImage = time(). '.' . $request->file('cover_image')->getClientOriginalName();
                /* $request->file('cover_image')->storeAs('public/Provider_coverImages',$coverImage); */
                $request->file('cover_image')->move('img/Provider_coverImages',$coverImage);
                
                if(isset($request->password) || !empty($request->password)){
                    $request->validate([
                        'password'=>'min:8|confirmed'
                    ]);
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
                }else{
                    $provider = Provider::where('id',$id)->update([
                        'name'=>$request->prov_name,
                        'email'=>$request->email,
                        'phone1'=>$request->phone1,
                        'phone2'=>$request->phone2,
                        'store_type'=>$request->store_type,
                        'address'=>$request->address,
                        'cover_image'=>$coverImage,
                        'description'=>$request->description,
                        'facebook'=>$request->facebook,
                        'instagram'=>$request->instagram
                    ]);
                }
                return redirect()->route('provider.profile');
            }else{
                if(isset($request->password) || !empty($request->password)){
                    $request->validate([
                        'password'=>'min:8|confirmed'
                    ]);
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
                }else{
                    $provider = Provider::where('id',$id)->update([
                        'name'=>$request->prov_name,
                        'email'=>$request->email,
                        'phone1'=>$request->phone1,
                        'phone2'=>$request->phone2,
                        'store_type'=>$request->store_type,
                        'address'=>$request->address,
                        'description'=>$request->description,
                        'facebook'=>$request->facebook,
                        'instagram'=>$request->instagram
                    ]);
                }
                return redirect()->route('provider.profile');
            }
            
        }
    }

    public function chat(){
        
        $users = DB::select("select users.id, users.name, users.email, count(is_read) as unread 
        from users LEFT JOIN messages ON users.id = messages.from_user and is_read = 0 and messages.to_provider = ".Auth::id()." group by users.id,users.name,users.email ORDER BY messages.is_read desc");

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

    public function all_notifications(){
        $notifications = Auth::user()->notifications()->orderBy('id', 'DESC')->get();
        return view('provider_views.all_notifications',[
            'notifications'=>$notifications
        ]);
    }

    public function delete_notification($id){
        Notification::where('id',$id)->delete();
        return redirect(url()->previous());
    }
}
