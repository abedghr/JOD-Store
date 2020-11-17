<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvAdminFeedbackController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin_provider');
    }
    
    public function index(){
        $feedbacks = Feedback::where('provider_id',Auth::user()->provider)->select()->paginate(10);
        return view('provAdmin_views.feedback',[
            'feedbacks'=>$feedbacks
        ]);
    }

    public function show($id){
        $single_feedback = Feedback::find($id);
        Notification::where('type','App\Notifications\ProviderFeedbackNotification')->where('data->id',$id)->update(['read_at'=>Carbon::now()]);
        return view('provAdmin_views.show_feedback',[
            'feedback'=>$single_feedback
        ]);
    }
}
