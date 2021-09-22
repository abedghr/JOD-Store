<?php

namespace App\Http\Controllers;

use App\Models\AdminOfProvider;
use App\Models\AdminsOfProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProviderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:provider');
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
        $admins = AdminsOfProvider::where('provider',Auth::user()->id)->select()->orderBy('id','desc')->paginate(5);
        return view('provider_views.manage_admins_provider',[
            'admins'=>$admins
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
            'admin_name'=>'required',
            'email'=>'required|email|unique:admins_of_providers',
            'password'=>'required|min:8|confirmed',
        ]);

        $admin = AdminsOfProvider::create([
            'name'=> $request->input('admin_name'),
            'email'=> $request->input('email'),
            'password'=> Hash::make($request->input('password')),
            'provider'=>Auth::user()->id
        ]);

        return redirect(url()->previous());
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
        $admin = AdminsOfProvider::find($id);
        return view("provider_views.edit_admin_provider",[
            'admin'=>$admin
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

        if($request->input('password') != null){
            $valid = $request->validate([
                'admin_name'=>'required',
                'email'=>'required|email|unique:admins',
                'password'=>'min:8|confirmed'
            ]);
            $update_admin = AdminsOfProvider::where('id',$id)->update([
                'name'=>$request->input('admin_name'),
                'email'=>$request->input('email'),
                'password'=> Hash::make($request->input('password')),
                'provider'=>Auth::user()->id
            ]);
            return redirect()->route('admin_provider.create');
        }else{
            $valid = $request->validate([
                'admin_name'=>'required',
                'email'=>'required|email|unique:admins'
            ]);
            $update_admin = AdminsOfProvider::where('id',$id)->update([
                'name'=>$request->input('admin_name'),
                'email'=>$request->input('email'),
                'provider'=>Auth::user()->id
            ]);
            return redirect()->route('admin_provider.create');
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
        AdminsOfProvider::where('id',$id)->delete();
        return redirect()->route('admin_provider.create');
    }
}
