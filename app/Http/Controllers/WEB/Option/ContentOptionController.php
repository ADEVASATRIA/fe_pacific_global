<?php

namespace App\Http\Controllers\WEB\Option;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentOptionController extends Controller
{
    public function index(){
        return view('content.option.index-content');
    }
}
