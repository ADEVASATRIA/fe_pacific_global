<?php

namespace App\Http\Controllers\WEB\Back\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('content.back.dashboard.dashboard-pacific');
    }
}
