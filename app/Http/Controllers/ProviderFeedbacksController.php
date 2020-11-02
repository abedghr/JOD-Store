<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
