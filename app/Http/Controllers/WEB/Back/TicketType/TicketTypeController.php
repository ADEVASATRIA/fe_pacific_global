<?php

namespace App\Http\Controllers\WEB\Back\TicketType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function index(){
        return view('content.back.ticketType.ticket-type-view');
    }
}
