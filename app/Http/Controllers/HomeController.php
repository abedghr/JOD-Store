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
    public function index()
    {        
        $user = session()->get('user');
        $category = Category::all()->all();
        $providers_logo = Provider::where('email_verified_at','<>',null)->get();
        $featured_products = Product::select()->orderBy('number_of_bought','desc')->limit(10)->get();
        if(session()->has("user")){
            return view('home',[
            'categories' => $category,
            'providers_logo'=>$providers_logo,
            'featured_products'=>$featured_products,
            'user'=>$user
            ]);
        }else{
            return view('home',[
                'categories' => $category,
                'providers_logo'=>$providers_logo,
                'featured_products'=>$featured_products
            ]);
        }
        
    }

    public function contact_us(){
        $user = session()->get('user');
        if(session()->has("user")){
            return view('public_views.contact-us',[
                'user'=>$user
            ]);
        }else{
            return view('public_views.contact-us');
        }
        
    }
}
