<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;

class PublicCategoryController extends Controller
{
    public function show($id){
        $user = session()->get('user');
        $category = Category::findorFail($id);
        $categories = Category::all();
        $products = Product::where('category',$id)->select()->orderBy('id','desc')->paginate(10);
        if(session()->has('user')){
            return view('public_views.category',[
                'category'=>$category,
                'products'=>$products,
                'categories'=>$categories,
                'user'=>$user,
            ]);
        }else{
            return view('public_views.category',[
                'category'=>$category,
                'products'=>$products,
                'categories'=>$categories
            ]);
        }
        
    }

    public function show2($id){
        $user = session()->get('user');
        $category = Category::findorFail($id);
        $providers = Provider::where('email_verified_at','<>',null)->get();
        $categories = Category::all();
        $products = Product::where('category',$id)->select()->orderBy('id','desc')->paginate(10);
        if(session()->has('user')){
            return view('public_side.category',[
                'category'=>$category,
                'products'=>$products,
                'categories'=>$categories,
                'providers'=>$providers,
                'user'=>$user,
            ]);
        }else{
            return view('public_side.category',[
                'category'=>$category,
                'products'=>$products,
                'categories'=>$categories,
                'providers'=>$providers
            ]);
        }
    }

    public function gender_show($id , $gender){
        $user = session()->get('user');
        $category = Category::findorFail($id);
        $categories = Category::all();
        $products = Product::where('category',$id)->where('gender',$gender)->select()->orderBy('id','desc')->paginate(10);
        if(session()->has('user')){
            return view('public_views.category_gender',[
                'category'=>$category,
                'products'=>$products,
                'categories'=>$categories,
                'user'=>$user,
                'gen'=>$gender
            ]);
        }else{
            return view('public_views.category_gender',[
                'category'=>$category,
                'products'=>$products,
                'categories'=>$categories,
                'gen'=>$gender
            ]);
        }
    }
    public function gender_show2($id , $gender){
        $user = session()->get('user');
        $category = Category::findorFail($id);
        $categories = Category::all();
        $providers = Provider::where('email_verified_at','<>',null)->get();
        $products = Product::where('category',$id)->where('gender',$gender)->select()->orderBy('id','desc')->paginate(10);
        if(session()->has('user')){
            return view('public_side.category_gender',[
                'category'=>$category,
                'products'=>$products,
                'categories'=>$categories,
                'providers'=>$providers,
                'user'=>$user,
                'gen'=>$gender
            ]);
        }else{
            return view('public_side.category_gender',[
                'category'=>$category,
                'products'=>$products,
                'categories'=>$categories,
                'providers'=>$providers,
                'gen'=>$gender
            ]);
        }
    }

    
}
