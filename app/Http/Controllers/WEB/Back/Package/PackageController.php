<?php

namespace App\Http\Controllers\WEB\Back\Package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        return view('content.back.package.package-view');
    }
}
