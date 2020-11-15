<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Notification;
class ProviderCategoryShow extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:provider');
    }
    public function index(){
        $categories = Category::select()->paginate(7);
        return view('Provider_views.categories',[
            'categories'=>$categories
        ]);
    }

    public function show($id){
        $category = Category::find($id);
        Notification::where('type','App\Notifications\CategoryNotification')->where('data->id',$id)->update(['read_at'=>Carbon::now()]);
        return view('Provider_views.show_category',[
            'category'=>$category
        ]);
    }
}
