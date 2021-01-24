<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsImages;
use App\Models\Provider;
use App\Models\Related;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::select()->orderBy('id','desc')->get();
        $categories = Category::all();
        $related = Related::all();
        $providers = Provider::all();
        return view('Admin.manage_product',[
            'products'=>$products,
            'categories'=>$categories,
            'related'=>$related,
            'providers'=>$providers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'prod_name'=>'required',
            'description'=>'required',
            'new_price'=>'required',
            'cat'=>'required',
            'gender'=>'required',
            'provider'=>'required',
        ]);
        if($request->hasFile('main_image')){
            $Image = time().'.'.$request->file('main_image')->getClientOriginalName();
            /* $request->file('main_image')->storeAs('public/Product_images',$Image); */
            $request->file('main_image')->move('img/Product_images',$Image);


            Product::create([
                'prod_name'=>$request->prod_name,
                'description'=>$request->description,
                'old_price'=>$request->old_price,
                'new_price'=>$request->new_price,
                'category'=>$request->cat,
                'gender'=>$request->gender,
                'provider'=>$request->provider,
                'main_image'=>$Image,
                'inventory'=>$request->inventory,
                'prod_status'=>$request->prod_status,
                'country_made'=>$request->country,
                'prod_related'=>$request->prod_related
            ]);
            $last = Product::orderBy('created_at', 'desc')->first();  
                    ProductsImages::create([
                        'image'=>$Image,
                        'product_id'=>$last->id
                    ]);
            
            if($request->hasFile('images')){
                foreach($request->images as $image){
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    $filename = pathinfo($imageName,PATHINFO_FILENAME);
                    $extention = $image->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().','.$extention;
                    /* $image->storeAs('public/Product_images',$fileNameToStore); */
                    $image->move('img/Product_images',$fileNameToStore);
                    
                    $last = Product::orderBy('created_at', 'desc')->first();  
                    ProductsImages::create([
                        'image'=>$fileNameToStore,
                        'product_id'=>$last->id
                    ]);
                }
                
            }
            return redirect()->route('product.create');
        }else{
            Product::create([
                'prod_name'=>$request->prod_name,
                'description'=>$request->description,
                'old_price'=>$request->old_price,
                'new_price'=>$request->new_price,
                'category'=>$request->cat,
                'gender'=>$request->gender,
                'provider'=>$request->provider,
                'inventory'=>$request->inventory,
                'prod_status'=>$request->prod_status,
                'country_made'=>$request->country,
                'prod_related'=>$request->prod_related
            ]);
            if($request->hasFile('images')){
                foreach($request->images as $image){
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    $filename = pathinfo($imageName,PATHINFO_FILENAME);
                    $extention = $image->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().','.$extention;
                    /* $image->storeAs('public/Product_images',$fileNameToStore); */
                    $image->move('img/Product_images',$fileNameToStore);
                    
                    $last = Product::orderBy('created_at', 'desc')->first();  
                    ProductsImages::create([
                        'image'=>$fileNameToStore,
                        'product_id'=>$last->id
                    ]);
                }
            }
            return redirect()->route('product.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $product_images = ProductsImages::where('product_id',$id)->get();
        return view('Admin.show_product',[
            'product'=>$product,
            'images'=>$product_images
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $related = Related::all();
        $providers = Provider::all();
        $prod_images = ProductsImages::where('product_id',$id)->orderBy('created_at','desc')->get();
        
        return view('Admin.edit_product',[
            'product'=>$product,
            'categories'=>$categories,
            'related'=>$related,
            'providers'=>$providers,
            'images'=>$prod_images
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $valid = $request->validate([
            'prod_name'=>'required',
            'description'=>'required',
            'new_price'=>'required',
            'cat'=>'required',
            'gender'=>'required',
            'provider'=>'required',
        ]);
        if($request->hasFile('main_image')){
            $Image = time().'.'.$request->file('main_image')->getClientOriginalName();
            /* $request->file('main_image')->storeAs('public/Product_images',$Image); */
            $request->file('main_image')->move('img/Product_images',$Image);
            Product::where('id',$id)->update([
                'prod_name'=>$request->prod_name,
                'description'=>$request->description,
                'old_price'=>$request->old_price,
                'new_price'=>$request->new_price,
                'category'=>$request->cat,
                'gender'=>$request->gender,
                'provider'=>$request->provider,
                'main_image'=>$Image,
                'inventory'=>$request->inventory,
                'prod_status'=>$request->prod_status,
                'country_made'=>$request->country,
                'prod_related'=>$request->prod_related
            ]);
             
                    ProductsImages::create([
                        'image'=>$Image,
                        'product_id'=>$id
                    ]);
            if($request->hasFile('images')){
                foreach($request->images as $image){
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    $filename = pathinfo($imageName,PATHINFO_FILENAME);
                    $extention = $image->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().','.$extention;
                    /* $image->storeAs('public/Product_images',$fileNameToStore); */
                    $image->move('img/Product_images',$fileNameToStore);
                    
                    
                    ProductsImages::create([
                        'image'=>$fileNameToStore,
                        'product_id'=>$id
                    ]);
                }
                
            }
            return redirect(url()->previous());
        }else{
            $x = Product::where('id',$id)->update([
                'prod_name'=>$request->prod_name,
                'description'=>$request->description,
                'old_price'=>$request->old_price,
                'new_price'=>$request->new_price,
                'category'=>$request->cat,
                'gender'=>$request->gender,
                'provider'=>$request->provider,
                'inventory'=>$request->inventory,
                'prod_status'=>$request->prod_status,
                'country_made'=>$request->country,
                'prod_related'=>$request->prod_related
            ]);
            if($request->hasFile('images')){
                foreach($request->images as $image){
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    $filename = pathinfo($imageName,PATHINFO_FILENAME);
                    $extention = $image->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().','.$extention;
                    /* $image->storeAs('public/Product_images',$fileNameToStore); */
                    $image->move('img/Product_images',$fileNameToStore);
                    
                    
                    ProductsImages::create([
                        'image'=>$fileNameToStore,
                        'product_id'=>$id
                    ]);
                }  
            }
            return redirect(url()->previous());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id',$id)->delete();
        return redirect()->route('product.create');
    }

    public function delete_image($id){
        ProductsImages::where('id',$id)->delete();
        return redirect(url()->previous());
    }
}
