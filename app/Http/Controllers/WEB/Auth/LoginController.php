<?php

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('content.authentications.auth-login-basic');
    }

    public function resgiter(){
        return view('content.authentications.auth-register-basic');
    }
}
