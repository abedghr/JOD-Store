<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Message;
use App\Models\Product;
use App\Models\Provider;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /* public function __construct()
    {
        $this->middleware('auth:web');
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index2(){
        $user = session()->get('user');
        $category = Category::all();
        $providers = Provider::where('email_verified_at','<>',null)->get();
        $top_products = Product::select()->orderBy('number_of_bought','desc')->limit(12)->get();
        if(session()->has("user")){
            return view('public_side.home',[
            'categories' => $category,
            'providers'=>$providers,
            'top_products'=>$top_products,
            'user'=>$user
            ]);
        }else{
            return view('public_side.home',[
                'categories' => $category,
                'providers'=>$providers,
                'top_products'=>$top_products
            ]);
        }
        
    }

    public function contact_us2(){
        $user = session()->get('user');
        $category = Category::all()->all();
        $providers = Provider::where('email_verified_at','<>',null)->get();
        if(session()->has("user")){
            return view('public_side.contact-us',[
                'categories' => $category,
                'providers'=>$providers,
                'user'=>$user
            ]);
        }else{
            return view('public_side.contact-us',[
                'categories' => $category,
                'providers'=>$providers
            ]);
        }
        
    }
}
