<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ProvAdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin_provider')->except('providerLogout');;
    }

    public function showLoginFrom(){
        return view('auth.provAdmin-login');
    }

    public function login(Request $request){
        $this->validate($request,
        [
            'email'=> 'required|string|email|exists:admins_of_providers',
            'password'=> 'required|string|min:8',
        ]);

        if(Auth::guard('admin_provider')->attempt(['email'=> $request->email , 'password'=> $request->password],$request->remember)){
            // if Successful then redirect to intended route or admin dashboard
            return redirect()->intended(route('provAdmin.dashboard'));
        }

        // if Unsuccess then back to admin-login

        return redirect()->back()->withInput()
        ->withErrors([
            'password' => 'Incorrect password!'
        ]);
    }

    public function providerLogout(Request $request){
        Auth::guard('admin_provider')->logout();
        return redirect()->route('provAdmin.login');
    }
}
