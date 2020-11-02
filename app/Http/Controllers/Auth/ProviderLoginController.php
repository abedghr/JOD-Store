<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ProviderLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest:provider")->except('providerLogout');
    }

    public function showLoginFrom(){
        return view('auth.provider-login');
    }

    public function login(Request $request){
        $this->validate($request,
        [
            'email'=> 'required|string|email|exists:providers',
            'password'=> 'required|string|min:8',
        ]);

        
        if(Auth::guard('provider')->attempt(['email'=> $request->email , 'password'=> $request->password],$request->remember)){
            // if Successful then redirect to intended route or admin dashboard
            return redirect()->intended(route('provider.dashboard'));
        }

        // if Unsuccess then back to admin-login

        return redirect()->back()->with($request->only('email','remember'));
    }

    public function providerLogout(Request $request){
        Auth::guard('provider')->logout();
        return redirect()->route('provider.login');
    }
}
