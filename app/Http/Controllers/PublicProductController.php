<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductsImages;
use App\Models\Provider;
use App\Models\Rating;
use Illuminate\Http\Request;

class PublicProductController extends Controller
{
    public function all2(){
        $user = session()->get('user');
        $products = Product::select()->orderBy('id','desc')->paginate(21);
        $providers_logo = Provider::where('email_verified_at','<>',null)->get();
        $categories = Category::all();
        if(session()->has('user')){
            return view('public_side.shop',[
                'products'=>$products,
                'categories'=>$categories,
                'providers'=>$providers_logo,
                'user'=>$user
            ]);
        }else{
            return view('public_side.shop',[
                'products'=>$products,
                'categories'=>$categories,
                'providers'=>$providers_logo
            ]);
        }
        
    }

    
    public function show2($id){
        $user = session()->get('user');
        $categories = Category::all();
        $providers = Provider::where('email_verified_at','<>',null)->get();
        $single_product = Product::findorfail($id);
        $related_products = Product::where('prod_related','<>',null)->where('prod_related',$single_product->prod_related)->where('id','<>',$single_product->id)->get();
        $product_images = ProductsImages::where('product_id',$id)->get();
        $comments = Comment::where('prod_id',$id)->orderBy('created_at','desc')->get();
        if(session()->has('user')){
        $rate = Rating::where('user_id',$user["user_id"])->where('prod_id',$id)->get();
        if(isset($rate[0])){
            $reviewed = "true";
        }else{
            $reviewed = "false";
        }
        }
        $test = Rating::where('prod_id',$id)->select('rating',Rating::raw('COUNT(rating) as count'))->groupByRaw('rating')->get();
        $star1=0;
        $star2=0;
        $star3=0;
        $star4=0;
        $star5=0;
        foreach($test as $rate){
            if($rate->rating == 1){
                $star1 = $rate->count;
            }
            if($rate->rating == 2){
                $star2 = $rate->count;
            }
            if($rate->rating == 3){
                $star3 = $rate->count;
            }
            if($rate->rating == 4){
                $star4 = $rate->count;
            }
            if($rate->rating == 5){
                $star5 = $rate->count;
            }
        }
        /* $star1 = Rating::where('rating',1)->where('prod_id',$id)->select('rating')->get();
        $star2 = Rating::where('rating',2)->where('prod_id',$id)->select('rating')->get();
        $star3 = Rating::where('rating',3)->where('prod_id',$id)->select('rating')->get();
        $star4 = Rating::where('rating',4)->where('prod_id',$id)->select('rating')->get();
        $star5 = Rating::where('rating',5)->where('prod_id',$id)->select('rating')->get(); */
        $maxRate ="";
        if($star1==0 && $star2==0 && $star3==0 && $star4==0 && $star5==0){
            $maxR="3";
        }else{
        $maxR = (5*$star5 + 4*$star4 + 3*$star3 + 2*$star2 + 1*$star1)/($star5 + $star4 + $star3 + $star2 + $star1);
        }
        
        
        if(!isset($maxR)){
            if(session()->has('user')){
                return view('public_side.single_product',[
                    'categories'=>$categories,
                    'providers'=>$providers,
                    'product'=>$single_product,
                    'images'=>$product_images,
                    'user'=>$user,
                    'comments'=>$comments,
                    'rating'=>$rate,
                    'product_rate'=>3,
                    'related_products'=>$related_products,
                    'reviewed'=>$reviewed
                ]);
            }else{
                return view('public_side.single_product',[
                    'categories'=>$categories,
                    'providers'=>$providers,
                    'product'=>$single_product,
                    'images'=>$product_images,
                    'comments'=>$comments,
                    'product_rate'=>3,
                    'related_products'=>$related_products,
                    'reviewed'=>$reviewed
                ]);
            }
        }
        if(session()->has('user')){
            return view('public_side.single_product',[
                'categories'=>$categories,
                'providers'=>$providers,
                'product'=>$single_product,
                'images'=>$product_images,
                'user'=>$user,
                'comments'=>$comments,
                'rating'=>$rate,
                'product_rate'=>$maxR,
                'related_products'=>$related_products,
                'reviewed'=>$reviewed
            ]);
        }else{
            return view('public_side.single_product',[
                'categories'=>$categories,
                'providers'=>$providers,
                'product'=>$single_product,
                'images'=>$product_images,
                'comments'=>$comments,
                'product_rate'=>$maxR,
                'related_products'=>$related_products
            ]);
        }
        
    }

    public function vendor_product_all($prov_id){
        $user = session()->get('user');
        $single_provider = Provider::findorFail($prov_id);
        $products = Product::where('provider',$prov_id)->select()->paginate(21);
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
            return view('public_views.profile',[
                'provider'=>$single_provider,
                'products'=>$products,
                'categories'=>$cat_arr,
                'category_active'=>'all',
                'user'=>$user,
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

    public function search2(Request $request){
        $search_products = Product::where('prod_name','like', '%'.$request->data_search.'%')->paginate(21);
        $view = view('ajax.products_search')->with(['search_products'=>$search_products])->renderSections();
        return response()->json([
            'status' => true,
            'content'=>$view['main']
        ]);
        
    }

    public function search_vendors_products2(Request $request){
        $search_products = Product::where('prod_name','like', '%'.$request->data_search.'%')->where('provider',$request->prov_id)->paginate(21);
        $view = view('ajax.products_search')->with(['search_products'=>$search_products])->renderSections();
        return response()->json([
            'status' => true,
            'content'=>$view['main']
        ]);
    }

    public function search_vendorsCategory_products2(Request $request){
        $search_products = Product::where('prod_name','like', '%'.$request->data_search.'%')->where('provider',$request->prov_id)->where('category',$request->cat_id)->paginate(21);
        $view = view('ajax.products_search')->with(['search_products'=>$search_products])->renderSections();
        return response()->json([
            'status' => true,
            'content'=>$view['main']
        ]);
        
    }

    public function search_vendorsGender_products2(Request $request){
        $search_products = Product::where('prod_name','like', '%'.$request->data_search.'%')->where('provider',$request->prov_id)->where('category',$request->cat_id)->where('gender',$request->gender)->paginate(21);
        $view = view('ajax.products_gen_search')->with(['search_products'=>$search_products])->renderSections();
        return response()->json([
            'status' => true,
            'content'=>$view['main']
        ]);
        
    }

    public function filter2(Request $request){
        if($request->filter == "low-to-high"){
            $filter = Product::select()->orderBy('new_price','asc')->paginate(21);
        }else if($request->filter == "high-to-low"){
            $filter = Product::select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-10"){
            $filter = Product::where('new_price', '<=' , 10)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-25"){
            $filter = Product::where('new_price', '<=' , 25)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-35"){
            $filter = Product::where('new_price', '<=' , 35)->select()->orderBy('new_price','desc')->paginate(21);
        }else{
            $filter = Product::where('new_price', '>' , 35)->select()->orderBy('new_price','desc')->paginate(21);
        }

        return view('ajax.products_filter_vendors',[
            'filter'=>$filter
        ]);
    }

    public function vendorFilter2(Request $request){
        if($request->filter == "low-to-high"){
            $filter = Product::where('provider',$request->prov_id)->select()->orderBy('new_price','asc')->paginate(21);
        }else if($request->filter == "high-to-low"){
            $filter = Product::where('provider',$request->prov_id)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-10"){
            $filter = Product::where('new_price', '<=' , 10)->where('provider',$request->prov_id)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-25"){
            $filter = Product::where('new_price', '<=' , 25)->where('provider',$request->prov_id)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-35"){
            $filter = Product::where('new_price', '<=' , 35)->where('provider',$request->prov_id)->select()->orderBy('new_price','desc')->paginate(21);
        }else{
            $filter = Product::where('new_price', '>' , 35)->where('provider',$request->prov_id)->select()->orderBy('new_price','desc')->paginate(21);
        }

        return view('ajax.products_filter_vendors',[
            'filter'=>$filter
        ]);
    }

    public function vendorCategoryFilter2(Request $request){
        if($request->filter == "low-to-high"){
            $filter = Product::where('provider',$request->prov_id)->where('category',$request->cat_id)->select()->orderBy('new_price','asc')->paginate(21);
        }else if($request->filter == "high-to-low"){
            $filter = Product::where('provider',$request->prov_id)->where('category',$request->cat_id)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-10"){
            $filter = Product::where('new_price', '<=' , 10)->where('provider',$request->prov_id)->where('category',$request->cat_id)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-25"){
            $filter = Product::where('new_price', '<=' , 25)->where('provider',$request->prov_id)->where('category',$request->cat_id)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-35"){
            $filter = Product::where('new_price', '<=' , 35)->where('provider',$request->prov_id)->where('category',$request->cat_id)->select()->orderBy('new_price','desc')->paginate(21);
        }else{
            $filter = Product::where('new_price', '>' , 35)->where('provider',$request->prov_id)->where('category',$request->cat_id)->select()->orderBy('new_price','desc')->paginate(21);
        }

        return view('ajax.products_filter_Cat',[
            'filter'=>$filter
        ]);
    }

    public function vendorGenderFilter2(Request $request){
        if($request->filter == "low-to-high"){
            $filter = Product::where('provider',$request->prov_id)->where('category',$request->cat_id)->where('gender',$request->gender)->select()->orderBy('new_price','asc')->paginate(21);
        }else if($request->filter == "high-to-low"){
            $filter = Product::where('provider',$request->prov_id)->where('category',$request->cat_id)->where('gender',$request->gender)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-10"){
            $filter = Product::where('new_price', '<=' , 10)->where('provider',$request->prov_id)->where('category',$request->cat_id)->where('gender',$request->gender)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-25"){
            $filter = Product::where('new_price', '<=' , 25)->where('provider',$request->prov_id)->where('category',$request->cat_id)->where('gender',$request->gender)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-35"){
            $filter = Product::where('new_price', '<=' , 35)->where('provider',$request->prov_id)->where('category',$request->cat_id)->where('gender',$request->gender)->select()->orderBy('new_price','desc')->paginate(21);
        }else{
            $filter = Product::where('new_price', '>' , 35)->where('provider',$request->prov_id)->where('category',$request->cat_id)->where('gender',$request->gender)->select()->orderBy('new_price','desc')->paginate(21);
        }
        return view('ajax.products_filter_Gen',[
            'filter'=>$filter
        ]);
        
    }

    public function search_in_singleCategory2(Request $request){
        $search_products = Product::where('prod_name','like', '%'.$request->data_search.'%')->where('category',$request->cat_id)->paginate(21);
        $view = view('ajax.products_search')->with(['search_products'=>$search_products])->renderSections();
        return response()->json([
            'status' => true,
            'content'=>$view['main']
        ]);
    }

    public function filter_category2(Request $request){
        if($request->filter == "low-to-high"){
            $filter = Product::where('category',$request->cat_id)->select()->orderBy('new_price','asc')->paginate(21);
        }else if($request->filter == "high-to-low"){
            $filter = Product::where('category',$request->cat_id)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-10"){
            $filter = Product::where('new_price', '<=' , 10)->where('category',$request->cat_id)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-25"){
            $filter = Product::where('new_price', '<=' , 25)->where('category',$request->cat_id)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-35"){
            $filter = Product::where('new_price', '<=' , 35)->where('category',$request->cat_id)->select()->orderBy('new_price','desc')->paginate(21);
        }else{
            $filter = Product::where('new_price', '>' , 35)->where('category',$request->cat_id)->select()->orderBy('new_price','desc')->paginate(21);
        }

        return view('ajax.products_filter_Cat',[
            'filter'=>$filter
        ]);
    }

    public function search_in_singleGender2(Request $request){
        $search_products = Product::where('prod_name','like', '%'.$request->data_search.'%')->where('category',$request->cat_id)->where('gender',$request->gender)->paginate(21);
        $view = view('ajax.products_gen_search')->with(['search_products'=>$search_products])->renderSections();
        return response()->json([
            'status' => true,
            'content'=>$view['main']
        ]);
    }

    public function filter_gender2(Request $request){
        if($request->filter == "low-to-high"){
            $filter = Product::where('category',$request->cat_id)->where('gender',$request->gender)->select()->orderBy('new_price','asc')->paginate(21);
        }else if($request->filter == "high-to-low"){
            $filter = Product::where('category',$request->cat_id)->where('gender',$request->gender)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-10"){
            $filter = Product::where('new_price', '<=' , 10)->where('category',$request->cat_id)->where('gender',$request->gender)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-25"){
            $filter = Product::where('new_price', '<=' , 25)->where('category',$request->cat_id)->where('gender',$request->gender)->select()->orderBy('new_price','desc')->paginate(21);
        }else if($request->filter == "less-35"){
            $filter = Product::where('new_price', '<=' , 35)->where('category',$request->cat_id)->where('gender',$request->gender)->select()->orderBy('new_price','desc')->paginate(21);
        }else{
            $filter = Product::where('new_price', '>' , 35)->where('category',$request->cat_id)->where('gender',$request->gender)->select()->orderBy('new_price','desc')->paginate(21);
        }

        return view('ajax.products_filter_Gen',[
            'filter'=>$filter
        ]);
    }

    public function rating_store(Request $request){
        
        $userRate = Rating::where('user_id',$request->user_id)->where('prod_id',$request->prod_id)->get();
        if(isset($userRate[0])){
            Rating::where('user_id',$request->user_id)->where('prod_id',$request->prod_id)->update([
                'rating'=>$request->rating,
                'user_id'=>$request->user_id,
                'prod_id'=>$request->prod_id
            ]);
        }else{
            Rating::where('user_id',$request->user_id)->where('prod_id',$request->prod_id)->create([
                'rating'=>$request->rating,
                'user_id'=>$request->user_id,
                'prod_id'=>$request->prod_id
            ]);
        }

        $rate = Rating::where("user_id",$request->user_id)->where("prod_id",$request->prod_id)->get();
        $output = "";
            if (isset($rate)){
                $output.='<div class="rating_list">
                        <h3>Your Rate:</h3>
                        <ul class="list" style="color:#fbd600">
                            <li>	
                                <a href="#">'.$rate[0]->rating.' STAR.';
                        for ($i = 0; $i < $rate[0]->rating; $i++){
                        $output.='<i class="fa fa-star"></i>';
                        }	
                        $output.='</a>	
                            </li>
                        </ul>
                    </div>';
            }
        $arr = array('rating'=>$request->rating , 'yourRate' => $output);
        return $arr;
    }
}
