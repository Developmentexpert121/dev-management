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

       if ($request->isMethod('get'))
       { 
          
          $user_id = Auth::user()->id; 
          $user_auth = Auth::user(); 
          $project_list = DB::table('users')
          ->select('users.name as users_name','project.*')
          ->join('assign_projects', 'assign_projects.assign_by', '=', 'users.id')
          ->join('project', 'project.id', '=', 'assign_projects.project_id')
          ->where('assign_projects.assign_to', $user_id)
          ->get();
           
        
          if( $user_auth->user_role ==1 )
          { 
            
            return view('projects::team_leader.project_list')->with('project_list',$project_list);  
          }
          elseif( $user_auth->user_role ==2 )
          {
            
            return view('projects::employee.project_list')->with('project_list',$project_list);  
          }

         }
        
    } 

    

}