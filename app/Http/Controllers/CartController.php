<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public $providers;
    public function addtocart(Request $request){
        if($request->quantity !=0){
        $product = Product::findOrFail($request->input('product_id'));
        $cart = session()->has('cart') ? session()->get('cart') : [];
        $providers = session()->has('providers') ? session()->get('providers') : session('providers');
        
        if (array_key_exists($product->provider, $cart)) {
            $check = array_key_exists($product->id , $cart[$product->provider]);
            if($check == 1){
                $cart[$product->provider][$product->id]['quantity']+=$request->quantity;
            }else{
                $cart[$product->provider][$product->id]=[
                'id' => $product->id,
                'provider'=>$product->prov->name,
                'provider_id'=>$product->provider,
                'category'=>$product->cat->cat_name,
                'category_id'=>$product->category,
                'title' => $product->prod_name,
                'quantity' => $request->quantity,
                'unit_price' => $product->new_price,
                'image' => $product->main_image
                ];
                
                
            }
        }else {
            $providers[$product->provider]= [
                'provider'=>$product->prov->name,
                'provider_id'=>$product->provider
            ];
            session(['providers'=>$providers]);
            $cart[$product->provider] = [ $product->id =>[
                'id' => $product->id,
                'provider'=>$product->prov->name,
                'provider_id'=>$product->provider,
                'category'=>$product->cat->cat_name,
                'category_id'=>$product->category,
                'title' => $product->prod_name,
                'quantity' => $request->quantity,
                'unit_price' => $product->new_price,
                'image' => $product->main_image
            ]];
            
        }
        session(['cart' => $cart]);
        
        $data = [];
        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];
        $counter = 0;
        foreach($cart as $cart){
            $counter += count($cart);
        }
        session(['counter'=>$counter]);
        return response()->json(['data'=>$data,'counter'=>$counter,'providers'=> $providers]);
        }
    }

    public function shoppingcart(){
        $user = session()->get('user');
        $cart= session()->has('cart') ? session()->get('cart') : [];
        $providers= session()->has('providers') ? session()->get('providers') : [];
        if(session()->has('cart') && session('cart')!= []){
            if(session()->has('user')){
                return view('public_views.cart',[
                    'cart'=>$cart,
                    'providers'=>$providers,
                    'user'=>$user
                ]);
            }else{
                return view('public_views.cart',[
                    'cart'=>$cart,
                    'providers'=>$providers
                ]);
            }
        }else{
            if(session()->has('user')){
            return view('public_views.empty_cart',[
                'user'=>$user
            ]);
            }else{
                return view('public_views.empty_cart');
            }
        }
    }

    public function removeFromCart($prov_id,$prod_id){
        $cart = session()->has('cart') ? session()->get('cart') : [];
        $providers = session()->get('providers');
        unset($cart[$prov_id][$prod_id]);
        if($cart[$prov_id]== []){
            unset($cart[$prov_id]);
            unset($providers[$prov_id]);
        }
        session(['providers'=>$providers]);
        
        session(["cart"=>$cart]);
        $counter = 0;
        foreach($cart as $cart){
            $counter += count($cart);
        }
        session(['counter'=>$counter]);
        return redirect(url()->previous());
    }

}
