<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //显示主页
    public function index(Request $request)
    {
    	return view('admin.home.index');
    }
}
