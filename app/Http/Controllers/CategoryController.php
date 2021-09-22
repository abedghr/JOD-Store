<?php

namespace App\Http\Controllers;

use App\Events\NewCategoryNotification;
use App\Models\Category;
use App\Models\Provider;
use App\Notifications\CategoryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\Notification as Notify;

class CategoryController extends Controller
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
        $categories = Category::select()->orderBy('id','desc')->get();
        return view('Admin.manage_category',[
            'categories'=>$categories
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
            'cat_name'=>'required|unique:categories',
        ]);
        if($request->hasFile('cat_image')){

            $fileImage = time() . '.' . $request->file('cat_image')->getClientOriginalName();
            /* $request->file('cat_image')->storeAs('public/Category_images',$fileImage); */
            $request->file('cat_image')->move('img/Category_images',$fileImage);

            Category::create([
                'cat_name'=>$request->input('cat_name'),
                'cat_image'=>$fileImage
            ]);

            $new_category = Category::latest()->first();

            $providers = Provider::get();
            Notification::send($providers, new CategoryNotification($new_category));
            $data = [
                'cat_id' => $new_category->id,
                'cat_name'=>$request->input('cat_name')
            ];
            event(new NewCategoryNotification($data));
            return redirect()->route('category.create');
        }else{
            Category::create([
                'cat_name'=>$request->input('cat_name')
            ]);
            $new_category = Category::latest()->first();

            $providers = Provider::get();
            Notification::send($providers, new CategoryNotification($new_category));
            $data = [
                'cat_id' => $new_category->id,
                'cat_name'=>$request->input('cat_name')
            ];
            event(new NewCategoryNotification($data));
            return redirect()->route('category.create');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view("Admin.edit_category",[
            'category'=>$category
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
        $validate = $request->validate([
            'cat_name'=>'required'
        ]);

        if($request->hasFile('cat_image')){
            $fileImage = time() . '.' . $request->file('cat_image')->getClientOriginalName();
            /* $request->file('cat_image')->storeAs('public/Category_images',$fileImage); */
            $request->file('cat_image')->move('img/Category_images',$fileImage);

            Category::where('id',$id)->update([
                'cat_name'=> $request->cat_name,
                'cat_image'=>$fileImage
            ]);
            return redirect()->route('category.create');

        }else{
            Category::where('id',$id)->update([
                'cat_name'=> $request->cat_name
            ]);
            return redirect()->route('category.create');
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
        Notify::where('type','App\Notifications\CategoryNotification')->where('data->id',$id)->delete();
        Category::where('id',$id)->delete();
        return redirect(url()->previous());
    }
}
