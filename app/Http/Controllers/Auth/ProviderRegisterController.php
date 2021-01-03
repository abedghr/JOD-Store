<?php

namespace App\Http\Controllers\Auth;

use App\Events\NewProviderNotification;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Provider;
use App\Notifications\NewProviderNotification as NotificationsNewProviderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Notification;

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
        
        $request->validate([
            'name'=> 'required|string|max:255',
            'email'=>'required|string|email|unique:providers',
            'password' => 'required|string|min:8|confirmed', 
            'phone1'=>'required|numeric|unique:providers'
        ]);
        
        try{
            $provider = Provider::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'phone1'=>$request->phone1,
                'subscribe'=>30
            ]);

            $last_prov = Provider::latest()->first();
            
            $admins = Admin::get();
            Notification::send($admins,new NotificationsNewProviderNotification($last_prov));
            
            
            $data = [
                'provider_id'=>$last_prov->id,
                'provider_name'=>$last_prov->name,
            ];

            event(new NewProviderNotification($data));

            Auth::guard('provider')->loginUsingId($provider->id);
            return redirect()->route('provider.dashboard');
            
        }catch(\Exception $e){
            return redirect()->back()->with($request->only('name','email'));
        }

        
    }
}
