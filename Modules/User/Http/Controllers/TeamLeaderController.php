<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Validator;
use Modules\Projects\Entities\Project;
use Modules\Projects\Entities\AllSprint; 
use Modules\Projects\Entities\Issue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Modules\Projects\Entities\Sprint_Issue;
use Auth;
use App\Models\User;

class TeamLeaderController extends Controller
{
    
     public function dashbaord(Request $request)
     {
         
        return view('user::tl.dashboard');

     }
   public function assignproject(Request $request){
      //$project_list =  DB::table('project')->select('project.*','project.name as username')->join('sprint_issue','sprint_issue.project_id','=','project.createby')->orderBy('project.id', 'DESC')->get();
     $id = Auth::user()->id;
     $project_id =  $request->project_id; 
     $tldata = DB::table('sprint_issue')
        ->Join('all_sprints', 'all_sprints.id', '=', 'sprint_issue.sprint_id')
        ->Join('project', 'project.id', '=', 'sprint_issue.project_id')
        ->select(['sprint_issue.*','all_sprints.sprint_name as sprint_name','project.name as project_name'])
        ->where(['sprint_issue.assign_to'=>$id])
        ->orderBy('sprint_issue.id', 'desc')
        ->get();
     $project_data = Project::where('id',$request->id)->first(); 
     $drop_down_data = Project::orderBy('id', 'DESC')->get();
     $project_ids = $request->id; 
     $sprints = AllSprint::where('project_id',$request->id)->get();
     $types = Issue::get();
     $data_user = Auth::user();
     $task = Auth::user()->name;
     $users = User::where('user_role',2)->get();

     return view('user::tl.assignproject', compact('project_id','project_data','drop_down_data','project_ids','sprints', 'types','task','users','data_user'))->with('tldata',$tldata);
     }
   public function create_issue(Request $request)
     {   
     $edit_id = $request->edit_id;
     $assignee = $request->assignee;
      $sprintIssue =  Sprint_Issue::where('id',$edit_id)->update([
               'assign_to_employe' => $assignee,
             ]);
     return Redirect()->back();

     }
    
}
