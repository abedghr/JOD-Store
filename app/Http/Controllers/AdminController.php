<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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
        return view('Admin.admin');
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
            'password'=>'required|min:8'
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
}
