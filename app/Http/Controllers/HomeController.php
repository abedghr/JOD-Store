<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
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
        $providers_logo = Provider::all();
        $featured_products = Product::select()->orderBy('number_of_bought','desc')->limit(10)->get();
        return view('home',[
            'categories' => $category,
            'providers_logo'=>$providers_logo,
            'featured_products'=>$featured_products,
            'user'=>$user
        ]);
    }

    public function contact_us(){
        $user = session()->get('user');
        return view('public_views.contact-us',[
            'user'=>$user
        ]);
    }
}
