<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Projects\Entities\Project;
use Modules\Projects\Entities\AllSprint;
use Modules\Projects\Entities\Sprint_Issue;

use Session;
use Validator;
use Redirect;
use DB;
use Auth;

class CompanyController extends Controller
{
   
   public function index(Request $request)
   {
      $project_id = $request->id;
      
      $project_data = DB::table('project')
      ->select('*')
      ->where('id',$request->id)
      ->first();

      $dropDownData = DB::table('project')
      ->orderBy('id', 'DESC')
      ->get();

      return view('projects::company.single',compact('project_id','project_data'))->with(['data'=>$project_data,'dropDownData'=>$dropDownData]);    
   }

   public function sprints(Request $request)
    {

      $data_user = Auth::user(); 
      $project_data = Project::where('id',$request->id)->first();
      $drop_down_data = Project::orderBy('id', 'DESC')->get();
      $project_id = $request->id;
  
      $single_project = 'single_project';   
      $sprints = AllSprint::where('project_id',$request->id)->get();
      
      $logs = AllSprint::where('project_id',$request->id)->get();
      $nums = AllSprint::where('project_id',$request->id)->count();
    
      $last = $sprints->first();  
  
    
  
      return view('projects::company.sprints', compact('single_project','project_data','drop_down_data','project_id','nums', 'sprints','last','logs','data_user'));
       
    }  
 
       public function saveSprint(Request $request)
  {
   
    $validator = Validator::make($request->all(),[
      'new_sprint' => 'required',
      'duration' => 'required', 
      'start_date'=>'required', 
      'end_date'=>'required', 
      'sprint_goal'=>'required',   
  ]);

  
  if ($validator->fails())
  {
      return Redirect::back()->withErrors($validator)->withInput();
  }
  
   $userId = Auth::id();
    
    $chk= AllSprint::where(
       [
        'project_id' => $request->project_id
       ]
     )
    ->orderBy('id', 'DESC')
    ->first(); 

  
    $sprint = new AllSprint(); 
    $sprint->sprint_name = $request->new_sprint; 
    $sprint->created_by = Auth::user()->id; 
    $sprint->duration = $request->duration; 
    $sprint->start_date = $request->start_date; 
    $sprint->end_date = $request->end_date; 
    $sprint->sprint_goal = $request->sprint_goal;  
    $sprint->project_id = $request->project_id;  
    $sprint->create_by = $userId;    

    Session::flash('message', '! '.$request->new_sprint.' Sprint Add Successfully');   
    Session::flash('alert-class', 'alert alert-success'); 

    if(!$chk=='')
    {
    
     if(!empty($chk['sprint_start_status']==2))
     { 
        $sprint->sprint_start_status = 5;   
     }  

    } 

    $sprint->save();    

    return Redirect('admin/project/team/'.$request->project_id.'/sprints');     

  }

     public function sprint_create_issue(Request $request)
     { 

       $project_id =  $request->project_id;  
       $sprint_id =  $request->sprint_id;
       $project_data = Project::where('id',$project_id)->first();
       $drop_down_data = Project::orderBy('id', 'DESC')->get();
       $single_project = 'single_project';   
       $sprintIssue= Sprint_Issue::where(['project_id'=> $project_id,'sprint_id'=>$sprint_id])->orderBy('id', 'DESC')->get();
       
       return view('projects::company.sprint_create_issue', compact('single_project','project_data','drop_down_data','project_id','sprint_id','sprintIssue'));
       
       
     }

   public function add_issue_create(Request $request)
   {
   
    $validator = Validator::make($request->all(),[
      'issueCreate' => 'required'
    ]); 
   
    if ($validator->fails())
    {
      return Redirect::back()->withErrors($validator)->withInput();
    }

     $userId = Auth::id();
   
     $sprintIssue= new Sprint_Issue();
     $sprintIssue->issue_name= $request->issueCreate;
     $sprintIssue->project_id= $request->project_id;
     $sprintIssue->sprint_id= $request->sprint_id;
     $sprintIssue->created_by= $userId;
     $sprintIssue->save();


     return Redirect::back()->with('message','Add Successfully');

    

   }
}
