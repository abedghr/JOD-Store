<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProvAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin_provider');
    }
    public function index(){
        return "Hello Prov Admin";
    }
}
