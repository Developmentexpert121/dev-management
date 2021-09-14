<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    // 

    public function index(Request $request)
    { 
        return view('manager.dashboard');  
    } 
}
