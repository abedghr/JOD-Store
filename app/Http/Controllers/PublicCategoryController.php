<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;

class PublicCategoryController extends Controller
{
    public function show2($id){
        $user = session()->get('user');
        $category = Category::findorFail($id);
        $providers = Provider::where('email_verified_at','<>',null)->get();
        $categories = Category::all();
        $products = Product::where('category',$id)->select()->orderBy('id','desc')->paginate(21);
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

    public function gender_show2($id , $gender){
        if($gender != "men" && $gender != "women" && $gender != "for both"){
            return redirect()->route('category.show2',['id'=>$id]);
        }
        $user = session()->get('user');
        $category = Category::findorFail($id);
        $categories = Category::all();
        $providers = Provider::where('email_verified_at','<>',null)->get();
        $products = Product::where('category',$id)->where('gender',$gender)->select()->orderBy('id','desc')->paginate(21);
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
