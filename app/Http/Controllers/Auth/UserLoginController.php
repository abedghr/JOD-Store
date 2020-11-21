<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{
    public function user_login(Request $request){
        $valid = $request->validate([
            'email'=>'required|string|email|exists:users',
            'password'=>'required|string|min:8'
        ]);

            $user = User::where('email',$request->email)->get();
            
            if(Hash::check($request->password, $user[0]->password)){
                session(['user'=>['user_id'=>$user[0]->id,'userName'=>$user[0]->name]]);
                return redirect()->route('home');
            }
            else{
                return redirect()->back()->withInput()
                ->withErrors([
                    'password' => 'Incorrect password!'
                ]);
    
            }
    }

    public function user_login_view(){
        if(session()->has('user') && session('user') != []){
            return redirect()->route('home');
        }else{
        return view('auth.login');
        }
    }

    public function user_logout(){
        if(session()->has('user')){
            session()->forget('user');
            return redirect(url()->previous());
        }
    }

    public function user_register_view(){
        
        if(session()->has('user') && session('user') != []){
            return redirect()->route('home');
        }else{
        return view('auth.register');
        }
    }

    public function user_register(Request $request){
        $valid = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], 
        ]);
        if(User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => "079079079",
            'Address'=>$request->address
        ])){
            $user = User::where('email',$request->email)->get();
                session(['user'=>['user_id'=>$user[0]->id,'userName'=>$user[0]->name]]);
                return redirect()->route('home');
        }
    }

    public function profile(){
        $user = session()->get('user');
        if($user != null){
            $userData = User::find($user['user_id']);
            $cities = City::all();
            return view('public_views.user_profile',[
                'user'=>$user,
                'userData'=>$userData,
                'cities'=>$cities
            ]);
        }else{
            return redirect()->route('home');
        }
    }

    public function update($id,Request $request){
        $valid = $request->validate([
            'user_name' => 'required',
            'user_email' => 'required'
        ]);
        
        User::where('id',$id)->update([
            'name'=>$request->user_name,
            'lname'=>$request->user_lname,
            'email'=>$request->user_email,
            'phone'=>$request->user_phone1,
            'phone2'=>$request->user_phone2,
            'city'=>$request->user_city,
            'Address'=>$request->user_address,
        ]);
        return redirect()->route('user.profile');
    }
}
