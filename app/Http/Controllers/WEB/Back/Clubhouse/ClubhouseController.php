<?php

namespace App\Http\Controllers\WEB\Back\Clubhouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClubhouseController extends Controller
{
    public function index(){
        return view('content.back.clubhouse.clubhouse-view');
    }
}
