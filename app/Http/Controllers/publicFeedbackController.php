<?php

namespace App\Http\Controllers;

use App\Events\NewFeedbackNotification;
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
        $user = session()->get('user');
        if($user != null || $user != []){
            Feedback::create([
                'feedback'=>$request->feedback,
                'provider_id'=>$request->provider_id,
                'user_id'=>$user['user_id']
            ]);
        }else{
            Feedback::create([
                'feedback'=>$request->feedback,
                'provider_id'=>$request->provider_id
            ]);
        }
        $new_feedback = Feedback::latest()->first();
        $data = [
            'feedback_id' => $new_feedback->id,
            'feedback'=>$new_feedback->feedback,
            'feedback_userID'=>$new_feedback->user_id,
            'feedback_provID'=>$new_feedback->provider_id
        ];
        event(new NewFeedbackNotification($data));
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
