<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;

class ManagerController extends Controller
{
    
     public function dashbaord(Request $request)
     {
          
        return view('user::manager.dashboard');  

     }
    
}
