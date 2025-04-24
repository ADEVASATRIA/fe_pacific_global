<?php

namespace App\Http\Controllers\WEB\Front\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('content.front.home.index-home');
    }
}
