<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Events\VendorProfileVisitor;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Message;
use App\Models\Product;
use App\Models\Provider;
use App\Notifications\ProviderMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Pusher\Pusher;

use function Symfony\Component\String\b;

class PublicProviderController extends Controller
{

    public function all2(){
        $user = session()->get('user');
        $categories = Category::all();
        $providers0 = Provider::where('email_verified_at','<>',null)->get();
        $providers = Provider::where('email_verified_at','<>',null)->select()->paginate(12);
        if(session()->has('user')){
            return view('public_side.vendors',[
                'providers'=>$providers0,
                'categories'=>$categories,
                'all_providers'=>$providers,
                'user'=>$user
            ]);
        }else{
            return view('public_side.vendors',[
                'providers'=>$providers0,
                'categories'=>$categories,
                'all_providers'=>$providers
            ]);
        }
        
    }

    public function profile2($id){
        $user = session()->get('user');
        $single_provider = Provider::findorFail($id);
        $providers = Provider::where('email_verified_at','<>',null)->get();
        $products = Product::where('provider',$id)->select()->with(['cat'])->paginate(12);
        event(new VendorProfileVisitor($single_provider));
        $categories = Category::all();
        $cat_arr = array();
        
        foreach($categories as $category){
            $prod = Product::where('category',$category->id)->where('provider',$id)->first();
            if($prod['category'] != null || !empty($prod['category']) || isset($prod['category'])){
                $cat_arr[$category->id]['id']=$category->id;
                $cat_arr[$category->id]['name']=$category->cat_name;
            }
        }
        if(session()->has('user')){
            return view('public_side.profile',[
                'provider'=>$single_provider,
                'providers'=>$providers,
                'products'=>$products,
                'categories'=>$categories,
                'store_categories'=>$cat_arr,
                'category_active'=>'all',
                'user'=>$user
            ]);
        }else{
            return view('public_side.profile',[
                'provider'=>$single_provider,
                'providers'=>$providers,
                'products'=>$products,
                'categories'=>$categories,
                'store_categories'=>$cat_arr,
                'category_active'=>'all'
            ]);
        }
        
    }

    public function profile_categories2($prov_id , $cat_id){
        $user = session()->get('user');
        $single_provider = Provider::findorFail($prov_id);
        $providers = Provider::where('email_verified_at','<>',null)->get();
        $products = Product::where('provider',$prov_id)->where('category',$cat_id)->select()->paginate(12);
        $categories = Category::all();
        $cat_arr = array();
        foreach($categories as $category){
            $prod = Product::where('category',$category->id)->where('provider',$prov_id)->first();
            
            if($prod['category'] != null){
                $cat_arr[$category->id]['id']=$category->id;
                $cat_arr[$category->id]['name']=$category->cat_name;
            }
        }
        if(session()->has('user')){
            return view('public_side.profile_category',[
                'provider'=>$single_provider,
                'providers'=>$providers,
                'products'=>$products,
                'categories'=>$categories,
                'store_categories'=>$cat_arr,
                'category_active'=>$cat_id,
                'user'=>$user
            ]);
        }else{
            return view('public_side.profile_category',[
                'provider'=>$single_provider,
                'providers'=>$providers,
                'products'=>$products,
                'categories'=>$categories,
                'store_categories'=>$cat_arr,
                'category_active'=>$cat_id
            ]);
        }
        
    }
    
    public function profile_gender2($prov_id , $cat_id,$gender){
        $user = session()->get('user');
        $single_provider = Provider::findorFail($prov_id);
        $providers = Provider::where('email_verified_at','<>',null)->get();
        $products = Product::where('provider',$prov_id)->where('category',$cat_id)->where('gender',$gender)->select()->with(['cat'])->paginate(12);
        $categories = Category::all();
        $cat_arr = array();
        foreach($categories as $category){
            $prod = Product::where('category',$category->id)->where('provider',$prov_id)->first();
            if($prod['category'] != null){
                $cat_arr[$category->id]['id']=$category->id;
                $cat_arr[$category->id]['name']=$category->cat_name;
            }
        }
        if($gender != "men" && $gender != "women" && $gender != "for both"){
            return redirect()->route('public_provider.profile2',['id'=>$prov_id]);
        }
        if(session()->has('user')){
            return view('public_side.profile_category_gender',[
                'provider'=>$single_provider,
                'providers'=>$providers,
                'categories'=>$categories,
                'products'=>$products,
                'store_categories'=>$cat_arr,
                'category_active'=>$cat_id,
                'user'=>$user,
                'gen'=>$gender
            ]);
        }else{
            return view('public_side.profile_category_gender',[
                'provider'=>$single_provider,
                'providers'=>$providers,
                'categories'=>$categories,
                'products'=>$products,
                'store_categories'=>$cat_arr,
                'category_active'=>$cat_id,
                'gen'=>$gender
            ]);
        }
    }
    
    public function search_vendors2(Request $request){
        $vendors = Provider::where('name', 'like' , '%'.$request->vendor.'%')->select()->paginate(12);
        $view = view('ajax.stores_search')->with(['vendors'=>$vendors])->renderSections();
        return response()->json([
            'status' => true,
            'content'=>$view['main']
        ]);
    }

    public function chat_show($provider_id){
        $user = session()->get('user');
        $my_id = $user["user_id"];
        $provider = Provider::findorFail($provider_id);

        Message::where(['from_provider'=> $provider_id,'to_user'=>$my_id])->update(['is_read'=>1]);

        $messages = Message::Where(function($query) use ($provider_id , $my_id) {
            $query->where('from_user',$my_id)->where('to_provider',$provider_id);
        })->orWhere(function($query) use ($provider_id , $my_id) {
            $query->where('from_provider',$provider_id)->where('to_user',$my_id);
        })->get();
        return view('messages.chat_view',[
            'provider'=>$provider,
            'messages'=>$messages,
            'user'=>$user
        ]);
    }

    public function getMessage(Request $request){
        $provider_id =  $request->receiver_id;
        $user = session()->get('user');
        $my_id = $user["user_id"];
        
        
        Message::where(['from_provider'=> $provider_id,'from_user'=>$my_id])->update(['is_read'=>1]);

        $messages = Message::Where(function($query) use ($provider_id , $my_id) {
            $query->where('from_user',$my_id)->where('to_provider',$provider_id);
        })->orWhere(function($query) use ($provider_id , $my_id) {
            $query->where('from_provider',$provider_id)->where('to_user',$my_id);
        })->get();
        
        return view('messages.messages',[
            'messages'=>$messages,
            'user'=>$user
        ]);
    }
    

    public function sendMessage(Request $request){
        $user = session()->get('user');
        $from = $user['user_id'];
        $to = $request->receiver_id;
        $message = $request->message;

        Message::create([
            'from_user' =>$from,
            'to_provider'=>$to,
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
