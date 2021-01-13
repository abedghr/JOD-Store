<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminFeedback;
use App\Models\Category;
use App\Models\City;
use App\Models\Order;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function profile(){
        $admin_data = Admin::find(Auth::user()->id);
        return view('Admin.profile',[
            'admin'=>$admin_data
        ]);
    }
    
    public function index()
    {
        $orders_number = Order::all()->count();
        $sum_order_sales = Order::where('order_status',3)->get()->sum('total_price');
        $providers_number = Provider::all()->count();
        $providers_disabled = Provider::where('subscribe',0)->count();
        $providers_active = Provider::where('subscribe','<>',0)->count();
        $all_users = User::all()->count();
        $users_messages = AdminFeedback::all()->count();
        $cities = City::all()->count();
        $count_categories = Category::count();
        return view('Admin.admin',[
            'orders_number' => $orders_number,
            'sum_order_sales' => $sum_order_sales,
            'providers_number' => $providers_number,
            'providers_disabled'=>$providers_disabled,
            'providers_active'=>$providers_active,
            'all_users' => $all_users,
            'users_messages' => $users_messages,
            'cities' => $cities,
            'count_categories'=>$count_categories
        ]);
    }

    public function create(){
        $admins = Admin::select()->orderBy('id','desc')->paginate(5);
        return view('Admin.manage_admin',[
            'admins'=>$admins
        ]);
    }

    public function store(Request $request){
        $valid = $request->validate([
            'admin_name'=>'required',
            'email'=>'required|email|unique:admins',
            'password'=>'required|min:8|confirmed'
        ]);

        $admin = Admin::create([
            'name'=> $request->input('admin_name'),
            'email'=> $request->input('email'),
            'password'=> Hash::make($request->input('password'))
        ]);
        
        return redirect(url()->previous());
    }

    public function edit($id){
        $admin = Admin::find($id);
        return view("Admin.edit_admin",[
            'admin'=>$admin
        ]);
    }

    public function update($id,Request $request){
        if($request->input('password') != null){
            $update_admin = Admin::where('id',$id)->update([
                'name'=>$request->input('admin_name'),
                'email'=>$request->input('email'),
                'password'=> Hash::make($request->input('password'))
            ]);
            return redirect()->route('admin.create');
        }else{
            $update_admin = Admin::where('id',$id)->update([
                'name'=>$request->input('admin_name'),
                'email'=>$request->input('email'),
            ]);
            return redirect()->route('admin.create');
        }
    }

    public function destroy($id){
        Admin::where('id',$id)->delete();
        return redirect()->route('admin.create');
    }

    public function all_notifications(){
        $notifications = Auth::user()->notifications()->orderBy('created_at','desc')->get();
        return view('Admin.all_notifications',[
            'notifications'=>$notifications
        ]);
    }

    public function delete_notification($id){
        Notification::where('id',$id)->delete();
        return redirect(url()->previous());
    }

}
