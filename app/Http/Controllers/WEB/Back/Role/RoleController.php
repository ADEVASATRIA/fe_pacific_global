<?php

namespace App\Http\Controllers\WEB\Back\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        return view('content.back.role.role-view');
    }
}
