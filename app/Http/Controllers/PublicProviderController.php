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
        $providers = Provider::select()->paginate(12);
        return view('public_views.vendors',[
            'providers'=>$providers,
            'user'=>$user
        ]);
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
        return view('public_views.profile',[
            'provider'=>$single_provider,
            'products'=>$products,
            'categories'=>$cat_arr,
            'category_active'=>'all',
            'user'=>$user
        ]);
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
        return view('public_views.profile_category',[
            'provider'=>$single_provider,
            'products'=>$products,
            'categories'=>$cat_arr,
            'category_active'=>$cat_id,
            'user'=>$user
        ]);
    }
    
    public function search_vendors(Request $request){
        $vendors = Provider::where('name', 'like' , '%'.$request->vendor.'%')->select()->paginate(12);
        
        $output = '';
        foreach($vendors as $vendor){
            $output.='<a href="profile/'.$vendor->id.'">
            <div class="col-lg-4 mb-3">
                <div class="hot_deal_box"  style="height:300px;">
                    <img src="../storage/Provider_images/'.$vendor->image.'" height="100%" width="100%"  alt="">
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
