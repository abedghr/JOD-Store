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
    public function all(){
        $user = session()->get('user');
        $products = Product::select()->orderBy('id','desc')->paginate(12);
        $providers_logo = Provider::where('email_verified_at','<>',null)->get();
        $categories = Category::all();
        if(session()->has('user')){
            return view('public_views.shop',[
                'products'=>$products,
                'categories'=>$categories,
                'providers_logo'=>$providers_logo,
                'user'=>$user
            ]);
        }else{
            return view('public_views.shop',[
                'products'=>$products,
                'categories'=>$categories,
                'providers_logo'=>$providers_logo
            ]);
        }
        
    }

    public function show($id){
        $user = session()->get('user');
        $single_product = Product::findorfail($id);
        $related_products = Product::where('prod_related',$single_product->prod_related)->where('id','<>',$single_product->id)->get();
        $product_images = ProductsImages::where('product_id',$id)->get();
        $comments = Comment::where('prod_id',$id)->orderBy('created_at','desc')->get();
        if(session()->has('user')){
        $rate = Rating::where('user_id',$user["user_id"])->where('prod_id',$id)->get();
        }
        $star1 = Rating::where('rating',1)->where('prod_id',$id)->select('rating')->get();
        $star2 = Rating::where('rating',2)->where('prod_id',$id)->select('rating')->get();
        $star3 = Rating::where('rating',3)->where('prod_id',$id)->select('rating')->get();
        $star4 = Rating::where('rating',4)->where('prod_id',$id)->select('rating')->get();
        $star5 = Rating::where('rating',5)->where('prod_id',$id)->select('rating')->get();
        $maxRate ="";

        if($star5->count() >= $star4->count() && $star5->count() >= $star3->count() && $star5->count() >= $star2->count() && $star5->count() >= $star1->count()){
            $maxRate = $star5;
        }elseif($star4->count() > $star5->count() && $star4->count() >= $star3->count() && $star4->count() >= $star2->count() && $star4->count() >= $star1->count()){
            $maxRate = $star4;
        }elseif($star3->count() > $star5->count() && $star3->count() > $star4->count() && $star3->count() >= $star2->count() && $star3->count() >= $star1->count()){
            $maxRate = $star3;
        }elseif($star2->count() > $star5->count() && $star2->count() > $star4->count() && $star2->count() > $star3->count() && $star2->count() >= $star1->count()){
            $maxRate = $star2;
        }elseif($star1->count() > $star5->count() && $star1->count() > $star4->count() && $star1->count() > $star3->count() && $star1->count() > $star2->count()){
            $maxRate = $star1;
        }
        
        if(!isset($maxRate[0])){
            if(session()->has('user')){
                return view('public_views.single_product',[
                    'product'=>$single_product,
                    'images'=>$product_images,
                    'user'=>$user,
                    'comments'=>$comments,
                    'rating'=>$rate,
                    'product_rate'=>3,
                    'related_products'=>$related_products
                ]);
            }else{
                return view('public_views.single_product',[
                    'product'=>$single_product,
                    'images'=>$product_images,
                    'comments'=>$comments,
                    'product_rate'=>3,
                    'related_products'=>$related_products
                ]);
            }
        }
        if(session()->has('user')){
            return view('public_views.single_product',[
                'product'=>$single_product,
                'images'=>$product_images,
                'user'=>$user,
                'comments'=>$comments,
                'rating'=>$rate,
                'product_rate'=>$maxRate[0]->rating,
                'related_products'=>$related_products
            ]);
        }else{
            return view('public_views.single_product',[
                'product'=>$single_product,
                'images'=>$product_images,
                'comments'=>$comments,
                'product_rate'=>$maxRate[0]->rating,
                'related_products'=>$related_products
            ]);
        }
        
    }

    public function vendor_product_all($prov_id){
        $user = session()->get('user');
        $single_provider = Provider::findorFail($prov_id);
        $products = Product::where('provider',$prov_id)->select()->paginate(12);
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

    public function search(Request $request){
        $search_products = Product::where('prod_name','like', '%'.$request->data_search.'%')->paginate(12);
        
        $output = '';
        foreach($search_products as $product){
            $output.='<div class="col-lg-3 col-md-3 col-sm-6">
            <div class="f_p_item">
                <div class="f_p_img">
                    <img class="img-fluid" src="../../storage/Product_images/'.$product->main_image.'" alt="">
                    <div class="p_icon">
                        <a href="singe-product/'.$product->id.'">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="js-addcart-detail" style="cursor: pointer" onclick="addca('.$product->id.')">
                            <i class="lnr lnr-cart"></i>
                        </a>
                    </div>
                </div>
                    <h4 class="product-name"><a href="#" class="product-name js-name-detail">'.$product->prod_name.'</a></h4>
                    <p class="product-details"><strong>Provider : '.$product->prov->name.'</strong></p>
                    <p class="product-details"><strong>Category : '.$product->cat->cat_name.'</strong></p>
                    <span class="text-danger"><strong><del class="text-danger">JD'.number_format($product->old_price,2).'</del></strong></span><br>
                    <span class="text-success"><strong>JD'.number_format($product->new_price,2).'</strong></span>
            </div>
        </div>';
        }
        return $data = array(
            'row_result'=>$output,
        );
    }

    public function search_vendors_products(Request $request){
        $search_products = Product::where('prod_name','like', '%'.$request->data_search.'%')->where('provider',$request->prov_id)->paginate(12);
        
        $output = '';
        foreach($search_products as $product){
            $output.='<div class="col-lg-3 col-md-3 col-sm-6">
            <div class="f_p_item">
                <div class="f_p_img">
                    <img class="img-fluid" src="../../storage/Product_images/'.$product->main_image.'" alt="">
                    <div class="p_icon">
                        <a href="singe-product/'.$product->id.'">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="js-addcart-detail" style="cursor: pointer" onclick="addca('.$product->id.')">
                            <i class="lnr lnr-cart"></i>
                        </a>
                    </div>
                </div>
                    <h4 class="product-name"><a href="#" class="product-name js-name-detail">'.$product->prod_name.'</a></h4>
                    <p class="product-details"><strong>Provider : '.$product->prov->name.'</strong></p>
                    <p class="product-details"><strong>Category : '.$product->cat->cat_name.'</strong></p>
                    <span class="text-danger"><strong><del class="text-danger">JD'.number_format($product->old_price,2).'</del></strong></span><br>
                    <span class="text-success"><strong>JD'.number_format($product->new_price,2).'</strong></span>
            </div>
        </div>';
        }
        return $data = array(
            'row_result'=>$output,
        );
    }

    public function search_vendorsCategory_products(Request $request){
        $search_products = Product::where('prod_name','like', '%'.$request->data_search.'%')->where('provider',$request->prov_id)->where('category',$request->cat_id)->paginate(12);
        
        $output = '';
        foreach($search_products as $product){
            $output.='<div class="col-lg-3 col-md-3 col-sm-6">
            <div class="f_p_item">
                <div class="f_p_img">
                    <img class="img-fluid" src="../../storage/Product_images/'.$product->main_image.'" alt="">
                    <div class="p_icon">
                        <a href="singe-product/'.$product->id.'">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="js-addcart-detail" style="cursor: pointer" onclick="addca('.$product->id.')">
                            <i class="lnr lnr-cart"></i>
                        </a>
                    </div>
                </div>
                    <h4 class="product-name"><a href="#" class="product-name js-name-detail">'.$product->prod_name.'</a></h4>
                    <p class="product-details"><strong>Provider : '.$product->prov->name.'</strong></p>
                    <p class="product-details"><strong>Category : '.$product->cat->cat_name.'</strong></p>
                    <span class="text-danger"><strong><del class="text-danger">JD'.number_format($product->old_price,2).'</del></strong></span><br>
                    <span class="text-success"><strong>JD'.number_format($product->new_price,2).'</strong></span>
            </div>
        </div>';
        }
        return $data = array(
            'row_result'=>$output,
        );
    }

    public function filter(Request $request){
        if($request->filter == "low-to-high"){
            $filter = Product::select()->orderBy('new_price','asc')->paginate(12);
        }else if($request->filter == "high-to-low"){
            $filter = Product::select()->orderBy('new_price','desc')->paginate(12);
        }else if($request->filter == "less-10"){
            $filter = Product::where('new_price', '<=' , 10)->select()->orderBy('new_price','desc')->paginate(12);
        }else if($request->filter == "less-25"){
            $filter = Product::where('new_price', '<=' , 25)->select()->orderBy('new_price','desc')->paginate(12);
        }else if($request->filter == "less-35"){
            $filter = Product::where('new_price', '<=' , 35)->select()->orderBy('new_price','desc')->paginate(12);
        }else{
            $filter = Product::where('new_price', '>' , 35)->select()->orderBy('new_price','desc')->paginate(12);
        }

        $output = '';
        foreach($filter as $product){
            $output.='<div class="col-lg-3 col-md-3 col-sm-6">
            <div class="f_p_item">
                <div class="f_p_img">
                    <img class="img-fluid" src="../storage/Product_images/'.$product->main_image.'" alt="">
                    <div class="p_icon">
                        <a href="singe-product/'.$product->id.'">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="js-addcart-detail" style="cursor: pointer" onclick="addca('.$product->id.')">
                            <i class="lnr lnr-cart"></i>
                        </a>
                    </div>
                </div>
                    <h4 class="product-name"><a href="#" class="product-name js-name-detail">'.$product->prod_name.'</a></h4>
                    <p class="product-details"><strong>Provider : '.$product->prov->name.'</strong></p>
                    <p class="product-details"><strong>Category : '.$product->cat->cat_name.'</strong></p>
                    <span class="text-danger"><strong><del class="text-danger">JD'.number_format($product->old_price,2).'</del></strong></span><br>
                    <span class="text-success"><strong>JD'.number_format($product->new_price,2).'</strong></span>
            </div>
        </div>';
        }

        return $data = array('arr'=>$output);
    }

    public function vendorFilter(Request $request){
        if($request->filter == "low-to-high"){
            $filter = Product::where('provider',$request->prov_id)->select()->orderBy('new_price','asc')->paginate(12);
        }else if($request->filter == "high-to-low"){
            $filter = Product::where('provider',$request->prov_id)->select()->orderBy('new_price','desc')->paginate(12);
        }else if($request->filter == "less-10"){
            $filter = Product::where('new_price', '<=' , 10)->where('provider',$request->prov_id)->select()->orderBy('new_price','desc')->paginate(12);
        }else if($request->filter == "less-25"){
            $filter = Product::where('new_price', '<=' , 25)->where('provider',$request->prov_id)->select()->orderBy('new_price','desc')->paginate(12);
        }else if($request->filter == "less-35"){
            $filter = Product::where('new_price', '<=' , 35)->where('provider',$request->prov_id)->select()->orderBy('new_price','desc')->paginate(12);
        }else{
            $filter = Product::where('new_price', '>' , 35)->where('provider',$request->prov_id)->select()->orderBy('new_price','desc')->paginate(12);
        }

        $output = '';
        foreach($filter as $product){
            $output.='<div class="col-lg-3 col-md-3 col-sm-6">
            <div class="f_p_item">
                <div class="f_p_img">
                    <img class="img-fluid" src="../../storage/Product_images/'.$product->main_image.'" alt="">
                    <div class="p_icon">
                        <a href="singe-product/'.$product->id.'">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="js-addcart-detail" style="cursor: pointer" onclick="addca('.$product->id.')">
                            <i class="lnr lnr-cart"></i>
                        </a>
                    </div>
                </div>
                    <h4 class="product-name"><a href="#" class="product-name js-name-detail">'.$product->prod_name.'</a></h4>
                    <p class="product-details"><strong>Provider : '.$product->prov->name.'</strong></p>
                    <p class="product-details"><strong>Category : '.$product->cat->cat_name.'</strong></p>
                    <span class="text-danger"><strong><del class="text-danger">JD'.number_format($product->old_price,2).'</del></strong></span><br>
                    <span class="text-success"><strong>JD'.number_format($product->new_price,2).'</strong></span>
            </div>
        </div>';
        }

        return $data = array('arr'=>$output);
    }

    public function search_in_singleCategory(Request $request){
        $search_products = Product::where('prod_name','like', '%'.$request->data_search.'%')->where('category',$request->cat_id)->paginate(12);
        
        $output = '';
        foreach($search_products as $product){
            $output.='<div class="col-lg-3 col-md-3 col-sm-6">
            <div class="f_p_item">
                <div class="f_p_img">
                    <img class="img-fluid" src="../../storage/Product_images/'.$product->main_image.'" alt="">
                    <div class="p_icon">
                        <a href="singe-product/'.$product->id.'">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="js-addcart-detail" style="cursor: pointer" onclick="addca('.$product->id.')">
                            <i class="lnr lnr-cart"></i>
                        </a>
                    </div>
                </div>
                    <h4 class="product-name"><a href="#" class="product-name js-name-detail">'.$product->prod_name.'</a></h4>
                    <p class="product-details"><strong>Provider : '.$product->prov->name.'</strong></p>
                    <p class="product-details"><strong>Category : '.$product->cat->cat_name.'</strong></p>
                    <span class="text-danger"><strong><del class="text-danger">JD'.number_format($product->old_price,2).'</del></strong></span><br>
                    <span class="text-success"><strong>JD'.number_format($product->new_price,2).'</strong></span>
            </div>
        </div>';
        }
        return $data = array(
            'row_result'=>$output,
        );
    }

    public function filter_category(Request $request){
        if($request->filter == "low-to-high"){
            $filter = Product::where('category',$request->cat_id)->select()->orderBy('new_price','asc')->paginate(12);
        }else if($request->filter == "high-to-low"){
            $filter = Product::where('category',$request->cat_id)->select()->orderBy('new_price','desc')->paginate(12);
        }else if($request->filter == "less-10"){
            $filter = Product::where('new_price', '<=' , 10)->where('category',$request->cat_id)->select()->orderBy('new_price','desc')->paginate(12);
        }else if($request->filter == "less-25"){
            $filter = Product::where('new_price', '<=' , 25)->where('category',$request->cat_id)->select()->orderBy('new_price','desc')->paginate(12);
        }else if($request->filter == "less-35"){
            $filter = Product::where('new_price', '<=' , 35)->where('category',$request->cat_id)->select()->orderBy('new_price','desc')->paginate(12);
        }else{
            $filter = Product::where('new_price', '>' , 35)->where('category',$request->cat_id)->select()->orderBy('new_price','desc')->paginate(12);
        }

        $output = '';
        foreach($filter as $product){
            $output.='<div class="col-lg-3 col-md-3 col-sm-6">
            <div class="f_p_item">
                <div class="f_p_img">
                    <img class="img-fluid" src="../storage/Product_images/'.$product->main_image.'" alt="">
                    <div class="p_icon">
                        <a href="singe-product/'.$product->id.'">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="js-addcart-detail" style="cursor: pointer" onclick="addca('.$product->id.')">
                            <i class="lnr lnr-cart"></i>
                        </a>
                    </div>
                </div>
                    <h4 class="product-name"><a href="#" class="product-name js-name-detail">'.$product->prod_name.'</a></h4>
                    <p class="product-details"><strong>Provider : '.$product->prov->name.'</strong></p>
                    <p class="product-details"><strong>Category : '.$product->cat->cat_name.'</strong></p>
                    <span class="text-danger"><strong><del class="text-danger">JD'.number_format($product->old_price,2).'</del></strong></span><br>
                    <span class="text-success"><strong>JD'.number_format($product->new_price,2).'</strong></span>
            </div>
        </div>';
        }

        return $data = array('arr'=>$output);
    }

    public function rating_store(Request $request){
        
        Rating::where('user_id',$request->user_id)->where('prod_id',$request->prod_id)->delete();
        Rating::create([
            'rating'=>$request->rating,
            'user_id'=>$request->user_id,
            'prod_id'=>$request->prod_id
        ]);

        $rate = Rating::latest()->first();
        $output = "";
            if (isset($rate)){
                $output.='<div class="rating_list">
                        <h3>Your Rate:</h3>
                        <ul class="list" style="color:#fbd600">
                            <li>	
                                <a href="#">'.$rate->rating.' STAR.';
                        for ($i = 0; $i < $rate->rating; $i++){
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
