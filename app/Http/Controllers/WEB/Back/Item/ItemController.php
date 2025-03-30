<?php

namespace App\Http\Controllers\WEB\Back\Item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(){
        return view('content.back.item.item-view');
    }
}
