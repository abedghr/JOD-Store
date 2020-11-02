<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PublicCategoryController extends Controller
{
    public function show($id){
        $user = session()->get('user');
        $category = Category::findorFail($id);
        $categories = Category::all();
        $products = Product::where('category',$id)->select()->orderBy('id','desc')->paginate(10);
        return view('public_views.category',[
            'category'=>$category,
            'products'=>$products,
            'categories'=>$categories,
            'user'=>$user
        ]);
    }

    
}
