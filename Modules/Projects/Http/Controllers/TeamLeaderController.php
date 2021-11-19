<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;
use Redirect;
use DB;
use Auth;
use Modules\Projects\Entities\Project;
use Modules\Projects\Entities\AllSprint; 
use Modules\Projects\Entities\Sprint_start;
use Modules\Projects\Entities\task;
use Modules\Projects\Entities\Issue;
use Modules\Projects\Entities\category;  
use Session;
use Modules\User\Entities\User;
use Modules\Projects\Entities\Sprint_Issue;
use Modules\User\Entities\Usersdata;

class TeamLeaderController extends Controller
{

  public function index(Request $request)
  { 
      // $user_id = Auth::user()->id; 
      // $user_auth = Auth::user(); 
      // $project_assign= $user_auth->project_assign; 

      // $project_list =  DB::table('project') 
      // ->select('project.*','users.name as username') 
      // ->join('users','users.id','=','project.createby') 
      // ->whereIn('project.id',array($project_assign))  
      // ->orderBy('project.id', 'DESC')   
      // ->get(); 




      return view('projects::team_leader.template');   
  } 

}