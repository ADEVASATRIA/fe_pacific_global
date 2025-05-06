<?php

namespace App\Http\Controllers\WEB\Back\Promo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index(){
        return view('content.back.promo.promo-view');
    }
}
