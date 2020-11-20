<?php

namespace App\Http\Controllers;

use App\Models\AdminFeedback;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminMessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $messages = AdminFeedback::select()->orderBy('created_at','desc')->paginate(15);
        Notification::where('type','App\Notifications\AdminFeedbackNotification')->update(['read_at'=>Carbon::now()]);
        return view('Admin.users_messages',[
            'messages'=>$messages
        ]);
    }
}
