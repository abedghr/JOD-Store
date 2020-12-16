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
    public function all(){
        $user = session()->get('user');
        $providers = Provider::where('email_verified_at','<>',null)->select()->paginate(12);
        if(session()->has('user')){
            return view('public_views.vendors',[
                'providers'=>$providers,
                'user'=>$user
            ]);
        }else{
            return view('public_views.vendors',[
                'providers'=>$providers
            ]);
        }
        
    }
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

    public function profile($id){
        $user = session()->get('user');
        $single_provider = Provider::findorFail($id);
        $products = Product::where('provider',$id)->select()->paginate(12);
        event(new VendorProfileVisitor($single_provider));
        $categories = Category::all();
        $cat_arr = array();
        foreach($categories as $category){
            $prod = Product::where('category',$category->id)->where('provider',$id)->first();
            
            if($prod['category'] != null){
                $cat_arr[$category->id]['id']=$category->id;
                $cat_arr[$category->id]['name']=$category->cat_name;
            }
        }
        if(session()->has('user')){
            return view('public_views.profile',[
                'provider'=>$single_provider,
                'products'=>$products,
                'categories'=>$cat_arr,
                'category_active'=>'all',
                'user'=>$user
            ]);
        }else{
            return view('public_views.profile',[
                'provider'=>$single_provider,
                'products'=>$products,
                'categories'=>$cat_arr,
                'category_active'=>'all'
            ]);
        }
        
    }

    public function profile_categories($prov_id , $cat_id){
        $user = session()->get('user');
        $single_provider = Provider::findorFail($prov_id);
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
            return view('public_views.profile_category',[
                'provider'=>$single_provider,
                'products'=>$products,
                'categories'=>$cat_arr,
                'category_active'=>$cat_id,
                'user'=>$user
            ]);
        }else{
            return view('public_views.profile_category',[
                'provider'=>$single_provider,
                'products'=>$products,
                'categories'=>$cat_arr,
                'category_active'=>$cat_id
            ]);
        }
        
    }
    
    public function profile_gender($prov_id , $cat_id,$gender){
        $user = session()->get('user');
        $single_provider = Provider::findorFail($prov_id);
        $products = Product::where('provider',$prov_id)->where('category',$cat_id)->where('gender',$gender)->select()->paginate(12);
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
            return view('public_views.profile_category_gender',[
                'provider'=>$single_provider,
                'products'=>$products,
                'categories'=>$cat_arr,
                'category_active'=>$cat_id,
                'user'=>$user,
                'gen'=>$gender
            ]);
        }else{
            return view('public_views.profile_category_gender',[
                'provider'=>$single_provider,
                'products'=>$products,
                'categories'=>$cat_arr,
                'category_active'=>$cat_id,
                'gen'=>$gender
            ]);
        }
    }
    
    public function search_vendors(Request $request){
        $vendors = Provider::where('name', 'like' , '%'.$request->vendor.'%')->select()->paginate(12);
        
        $output = '';
        foreach($vendors as $vendor){
            $output.='<a href="profile/'.$vendor->id.'">
            <div class="col-lg-4 mb-3">
                <div class="hot_deal_box"  style="height:300px;">
                    <img src="../img/Provider_images/'.$vendor->image.'" height="100%" width="100%"  alt="">
                    <div class="content">
                        <h2>'.$vendor->name.'</h2>
                        <p>shop now</p>
                    </div>
                    <a class="hot_deal_link" href="'.$vendor->id.'"></a>
                </div>
            </div>
        </a>';
        }

        return $data = array(
            'vendor_arr'=>$output
        );

    }
    public function search_vendors2(Request $request){
        $vendors = Provider::where('name', 'like' , '%'.$request->vendor.'%')->select()->paginate(12);
        
        $output = '';
        foreach($vendors as $vendor){
            $output.='<div class="col-md-3">
            <div class="thumbnail team-w3agile">
                <img src="./img/Provider_images/'.$vendor->image.'" class="img-responsive" alt="">
                <div class="social-icons team-icons right-w3l fotw33">
                <div class="caption">
                    <h4>'.$vendor->name.'</h4>						
                </div>
                    <ul class="social-nav model-3d-0 footer-social w3_agile_social two" style="margin:0px !important">
                        <li><a href="#" class="facebook">
                            <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                            <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a>
                        </li>
                        <li><a href="#" class="instagram">
                            <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                            <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a>
                        </li>
                    </ul><br>
                    <a class="hvr-outline-out button2 btn btn-block text-light mt-1" href="single.html"><strong>Shopping</strong></a>
                </div>
            </div>
        </div>';
        }

        return $data = array(
            'vendor_arr'=>$output
        );

    }

    public function chat_show($provider_id){
        $user = session()->get('user');
        $my_id = $user["user_id"];
        $provider = Provider::findorFail($provider_id);
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
