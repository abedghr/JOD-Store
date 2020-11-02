<?php

namespace App\Http\Controllers;

use App\Models\AdminFeedback;
use App\Models\Feedback;
use App\Models\Provider;
use App\Notifications\ProviderFeedbackNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class publicFeedbackController extends Controller
{
    public function Provider_feedback(Request $request){
        Feedback::create([
            'feedback'=>$request->feedback,
            'provider_id'=>$request->provider_id
        ]);
        $new_feedback = Feedback::latest()->first();
        $prov = Provider::where('id',$request->provider_id)->get();
        Notification::send($prov, new ProviderFeedbackNotification($new_feedback));
        return $text="";
    }

    public function admin_feedback(Request $request){
        $valid = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'message'=>'required'
        ]);

        $feedback = AdminFeedback::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'phone'=>$request->input('phone'),
            'feedback'=>$request->input('message')
        ]);

        return redirect(url()->previous());
    }


}
