<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsImages;
use App\Models\Provider;
use Illuminate\Http\Request;

class PublicProductController extends Controller
{
    public function all(){
        $user = session()->get('user');
        $products = Product::select()->orderBy('id','desc')->paginate(12);
        $categories = Category::all();
        return view('public_views.shop',[
            'products'=>$products,
            'categories'=>$categories,
            'user'=>$user
        ]);
    }

    public function show($id){
        $user = session()->get('user');
        $single_product = Product::findorfail($id);
        $product_images = ProductsImages::where('product_id',$id)->get();
        
        return view('public_views.single_product',[
            'product'=>$single_product,
            'images'=>$product_images,
            'user'=>$user
        ]);
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
        return view('public_views.profile',[
            'provider'=>$single_provider,
            'products'=>$products,
            'categories'=>$cat_arr,
            'category_active'=>'all',
            'user'=>$user
        ]);
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
}
