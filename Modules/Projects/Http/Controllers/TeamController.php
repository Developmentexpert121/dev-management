<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;
use Redirect;
use DB;
use Auth;

class TeamController extends Controller
{
   
   public function index(Request $request)
   {
     

      $project_data = DB::table('project')
      ->select('*')
      ->where('id',$request->id)
      ->first();

      $dropDownData = DB::table('project')
      ->orderBy('id', 'DESC')
      ->get();

      return view('projects::team.dashboard')->with(['data'=>$project_data,'dropDownData'=>$dropDownData]);   

   }
 
}
