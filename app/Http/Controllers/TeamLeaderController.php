<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamLeaderController extends Controller
{
    //

    public function index(Request $request)
    { 
        return view('teamLeader.dashboard');  
    }
}
