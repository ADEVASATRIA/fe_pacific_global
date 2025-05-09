<?php

namespace App\Http\Controllers\WEB\Front\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function ticketView(){
        return view('content.front.sub-page.ticket.ticket-view');
    }
}
