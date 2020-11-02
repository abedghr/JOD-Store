<?php

namespace App\Http\Controllers;

use App\Models\AdminFeedback;
use Illuminate\Http\Request;

class AdminMessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $messages = AdminFeedback::select()->paginate(15);
        return view('Admin.users_messages',[
            'messages'=>$messages
        ]);
    }
}
