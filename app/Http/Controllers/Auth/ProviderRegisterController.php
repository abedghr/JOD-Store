<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
class ProviderRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest:provider");
    }

    public function showRegisterForm(){
        return view('auth.provider-register');
    }

    public function register(Request $request){
        $this->validate($request,[
            'name'=>['required','string','max:255'],
            'email'=>['required','string','email','unique:providers'],
            'password'=>['required','string','min:8']
        ]);
    

        try{
            $provider = Provider::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'phone1'=>$request->phone1
            ]);
            Auth::guard('provider')->loginUsingId($provider->id);
            return redirect()->route('provider.dashboard');
            
        }catch(\Exception $e){
            return redirect()->back()->with($request->only('name','email'));
        }
    }
}
