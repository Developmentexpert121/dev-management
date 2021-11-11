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
class AdminController extends Controller
{

  public  function role(Request $request)
  {  
 
    if ($request->isMethod('get'))
    {

      $data =category::all(); 
      $role = DB::table('role')->where('status',0)->get();
      $user_auth = Auth::user(); 
      $project_data = Project::where('id',$request->id)->first();
      $drop_down_data = Project::orderBy('id', 'DESC')->get();
      $project_id = $request->id;  
      $single_project = 'single_project';    
      $category = category::orderBy('id', 'DESC')->get();
      return view('projects::admin.role', compact('single_project','project_data','drop_down_data','project_id', 'category','user_auth','role'));
    
    }

  }


   

}