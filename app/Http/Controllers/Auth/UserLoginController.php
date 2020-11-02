<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
                return redirect(url()->previous());
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
            'phone' => ['required','numeric'],
        ]);
        if(User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'Address'=>$request->address
        ])){
            $user = User::where('email',$request->email)->get();
                session(['user'=>['user_id'=>$user[0]->id,'userName'=>$user[0]->name]]);
                return redirect()->route('home');
        }
    }
}
