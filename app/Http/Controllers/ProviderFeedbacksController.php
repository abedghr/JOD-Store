<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
class ProviderFeedbacksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:provider');
    }
    
    public function index(){
        $feedbacks = Feedback::where('provider_id',Auth::user()->id)->select()->paginate(10);
        return view('Provider_views.feedback',[
            'feedbacks'=>$feedbacks
        ]);
    }

    public function show($id){
        $single_feedback = Feedback::find($id);
        Notification::where('type','App\Notifications\ProviderFeedbackNotification')->where('data->id',$id)->update(['read_at'=>Carbon::now()]);
        return view('Provider_views.show_feedback',[
            'feedback'=>$single_feedback
        ]);
    }
}
