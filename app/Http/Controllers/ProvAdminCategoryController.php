<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Notification;
use Carbon\Carbon;

class ProvAdminCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin_provider');
    }

    public function index(){
        $categories = Category::select()->paginate(7);
        return view('provAdmin_views.categories',[
            'categories'=>$categories
        ]);
    }

    public function show($id){
        $category = Category::find($id);
        Notification::where('type','App\Notifications\CategoryNotification')->where('data->id',$id)->update(['read_at'=>Carbon::now()]);
        return view('provAdmin_views.show_category',[
            'category'=>$category
        ]);
    }
}
