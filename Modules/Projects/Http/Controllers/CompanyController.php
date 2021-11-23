<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Projects\Entities\Project;
use Modules\Projects\Entities\AllSprint;
use Modules\Projects\Entities\Issue;
use Modules\User\Entities\User;
use Modules\Projects\Entities\Sprint_Issue;
use Modules\Projects\Entities\category;
use Modules\User\Entities\Usersdata;
use Modules\User\Entities\AssignProjects;
use Session;
use Validator;
use Redirect;
use DB;
use Auth;

class CompanyController extends Controller
{
   
   public function index(Request $request)
   {

    if ($request->isMethod('get'))
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

  }

   public function sprints(Request $request)
    {
       
      if ($request->isMethod('get'))
      {  

          $data_user = Auth::user(); 
          $project_data = Project::where('id',$request->id)->first();
          $drop_down_data = Project::orderBy('id', 'DESC')->get();
          $project_id = $request->id;
         // $single_project = 'single_project';   
          //$sprints = AllSprint::where('project_id',$request->id)->get();
          $sprints = AllSprint::where('all_sprints.project_id',$request->id)
          ->join('users', 'users.id', '=', 'all_sprints.created_by')
          ->join('role', 'role.id', '=', 'users.user_role')
          ->select(
          'all_sprints.*',
          'users.name as create_project_user',
          'role.name as role'
          )
          ->get();
          $logs = AllSprint::where('project_id',$request->id)->get();
          $nums = AllSprint::where('project_id',$request->id)->count();
          $last = $sprints->first();  
          return view('projects::company.sprints', compact('project_data','drop_down_data','project_id','nums', 'sprints','last','logs','data_user'));
          
      }
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

    return Redirect('projects/company/'.$request->project_id.'/sprints');     

  }

     public function sprint_create_issue(Request $request)
     { 
      
      if ($request->isMethod('get'))
      { 
          
          $project_id =  $request->project_id;  
          $sprint_id =  $request->sprint_id;
          $project_data = Project::where('id',$project_id)->first();
          $drop_down_data = Project::orderBy('id', 'DESC')->get();
          $single_project = 'single_project';   
          $sprintIssue = Sprint_Issue::where(['project_id'=> $project_id,'sprint_id'=>$sprint_id,'status'=>0])
          ->orderBy('id', 'DESC')->get();
        //  $sprintIssue= Sprint_Issue::where(['project_id'=> $project_id,'sprint_id'=>$sprint_id])->orderBy('id', 'DESC')->get();
          
          $AssignProjects = AssignProjects::where(['project_id'=>$project_id])->count();
          $project_Assign_Users = DB::table('assign_projects')
          ->select('assign_projects.*','users.name')
          ->join('users', 'assign_projects.assign_to', '=', 'users.id') 
          ->where('assign_projects.project_id',$project_id)
          ->groupBy('assign_projects.assign_to')
          ->get(); 
       
          return view('projects::company.sprint_create_issue', compact('project_Assign_Users','single_project','project_data','drop_down_data','project_id','sprint_id','sprintIssue'));
      }
       
     }

     public function add_issue_create(Request $request)
     {
       
        if ($request->isMethod('post'))
        { 
         
  
            $validator = Validator::make($request->all(),[
              'issueCreate' => 'required',
              'assign' => 'required',
            ]); 
          
            if ($validator->fails())
            {
              return Redirect::back()->withErrors($validator)->withInput();
            }
  
            $userId = Auth::id();
            
            if(!empty($request->backlog))
            {
                // backlog isuue
              
                $sprintIssue= new Sprint_Issue();
                $sprintIssue->issue_name= $request->issueCreate;
                $sprintIssue->project_id= $request->project_id;
                $sprintIssue->sprint_id= $request->sprint_id;
                $sprintIssue->created_by= $userId;
                $sprintIssue->assign_to= $request->assign;
                $sprintIssue->assign_by= $userId;
                $sprintIssue->status= 1; 
                $sprintIssue->save(); 
  
                return Redirect::back()->with('message',' Backlog Issue Create Successfully');
  
            }
            else
            {
               //not backlog issue 
              
              $sprintIssue= new Sprint_Issue();
              $sprintIssue->issue_name= $request->issueCreate;
              $sprintIssue->project_id= $request->project_id;
              $sprintIssue->sprint_id= $request->sprint_id;
              $sprintIssue->created_by= $userId;
              $sprintIssue->assign_to= $request->assign;
              $sprintIssue->assign_by= $userId;
              $sprintIssue->status= 0; 
              $sprintIssue->save();
          
              return Redirect::back()->with('message','Issue Create Successfully');
          
            }
  
         }
  
     }


   public function edit_sprint(Request $request)
  {

        $user_auth = Auth::user(); 
        $id = $request->edit_id; 
        $allSprint_dit_val= AllSprint::where('id',$id)->first();
        $single_project = 'single_project';  
        $project_id = $request->project_id;
       
        return view('projects::company.editSprint', compact('id','allSprint_dit_val','single_project','project_id','user_auth'));
      
  }
  public function editData_sprint(Request $request)
  {  
    
    $validator = Validator::make($request->all(),[
      'new_sprint' => 'required',
      'start_date' => 'required',
      'duration' => 'required',
      'end_date' => 'required',
      'sprint_goal' => 'required'
    ]);

    if ($validator->fails()){
      return Redirect::back()->withErrors($validator)->withInput();
    }
  

    AllSprint::where('id', $request->id)
    ->update([
        'sprint_name' => $request->new_sprint,
        'start_date'=> $request->start_date,
        'end_date'=> $request->end_date,
        'sprint_goal'=> $request->sprint_goal

    ]);
    

    $project_id = $request->project_id;

    Session::flash('message', ' Sprint Edit successfully !'); 
    Session::flash('alert-class', 'alert alert-success');

    return Redirect("projects/company/$project_id/sprints"); 

  
  }
  public function delete_sprint(Request $request)
  {
  
    $id = $request->delete_id;
    $flight = AllSprint::find($id); 
    $flight->delete();
    Session::flash('message', ' Sprint Delete successfully !'); 
    Session::flash('alert-class', 'alert alert-danger');
    return Redirect::back();

  }

  public function board(Request $request)
    {
     
      $data_user = Auth::user();
      $project_data = Project::where('id',$request->id)->first(); 
      $drop_down_data = Project::orderBy('id', 'DESC')->get(); 
      $project_id = $request->project_id;  
      $single_project = 'single_project'; 
      $statusResult = DB::table('board_heading')->get();
     

      $getSprint = AllSprint::where('project_id',$project_id)->first();

      if(!empty($getSprint)){

      if(!empty($getSprint &&  $getSprint['sprint_start_status']==0 || $getSprint['sprint_start_status']==1))
      {
       
        $sprint_id = $getSprint['id'];
      
       
        $taskResult = DB::table('sprint_issue')
        ->Join('all_sprints', 'all_sprints.id', '=', 'sprint_issue.sprint_id')
        ->select(['sprint_issue.*','all_sprints.sprint_start_status'])
        ->where(['sprint_issue.project_id'=>$project_id,'sprint_issue.sprint_id'=>$sprint_id])
        ->orderBy('sprint_issue.id', 'desc') 
        ->get();


      }
      else
      {

        $taskResult = DB::table('sprint_issue')
        ->Join('all_sprints', 'all_sprints.id', '=', 'sprint_issue.sprint_id')
        ->select(['sprint_issue.*','all_sprints.sprint_start_status'])
        ->where(['all_sprints.sprint_start_status'=>'5'])
        ->orderBy('sprint_issue.id', 'desc') 
        ->get();
       
      } 

     }
     else
     {
      $taskResult='';
     }

   
      return view('projects::company.board',compact('single_project','project_data','drop_down_data','project_id','statusResult','taskResult','data_user')); 
      //$taskResult = Sprint_Issue::get(); 

      $taskResult = DB::table('sprint_issue')
      ->Join('all_sprints', 'all_sprints.id', '=', 'sprint_issue.sprint_id')
      ->select(['sprint_issue.*','all_sprints.sprint_start_status'])
      ->where('sprint_issue.project_id',$project_id)
      ->orderBy('sprint_issue.id', 'desc') 
      ->get();
       
      return view('projects::board',compact('single_project','project_data','drop_down_data','project_id','statusResult','taskResult')); 

 
    }

    public function boardMove(Request $request)
    {
     
       
      $header_id = $request->header_id; 
      $issue_id = $request->issue_id;

      $res = Sprint_Issue::where('id',$issue_id) 
      ->update([  
        "issue_status" => $header_id-1
       ]);  
       
       return $res;   

    }

    public function backlog(Request $request)
    {
      
    
      $data_user = Auth::user();
      $project_data = Project::where('id',$request->id)->first();
      $drop_down_data = Project::orderBy('id', 'DESC')->get();
      $project_id = $request->id;
      $single_project = 'single_project'; 
      $sprints = AllSprint::where(['project_id'=>$request->id])->get();
      $sprintIssue= Sprint_Issue::where(['project_id'=> $project_id,'status'=>1])
      ->orderBy('id', 'DESC')->get();
   
      return view('projects::company.backlog', compact('single_project','project_data','drop_down_data','project_id', 'sprints','sprintIssue','data_user'));
    
    }
  
    public function blackLogMove(Request $request){
      
      if ($request->isMethod('post'))
      {
       
         $project_id = $request->project_id;
         $sprint_id = $request->sprint_id;
         $sprint = $request->sprint; 
         $sprintEditStatus = Sprint_Issue::where('id',$sprint_id)
         ->update(array('sprint_id' => $sprint,'status'=>0,'issue_status'=>0)); 
         return Redirect::back();    
  
      } 
    }

    public function project_settngs(Request $request){

      $tasks = Auth::user()->id;
      $profiledata = usersdata::where('user_id' , $tasks)->first();
      $data_user = Auth::user();
      $categorys = category::get();
      $project_data = Project::where('id',$request->id)->first();
      $drop_down_data = Project::orderBy('id', 'DESC')->get();
      $project_id = $request->id;
      $single_project = 'single_project';
      return view("projects::company.project_settngs", compact('drop_down_data','project_data', 'project_id','single_project','categorys','data_user','profiledata'));
    
     }
     public function project_company_detail_save(Request $request){
      $name = $_POST["name"];
      $key = $_POST["key"];
      $description = $_POST["description"];

      $project_id = $request->project_id;

          $userexist = Project::select('*')->where('id', $project_id)->first();
            if($userexist == null){

            
          if ($files = $request->file('image')) {
              
              $fileName =  "image-".time().'.'.$request->image->getClientOriginalExtension();
              $request->image->storeAs('image', $fileName);
              $image = new Project;
              $image->image = $fileName;
              $image->save();      
          }
          return response()->json(['status' => 'true', 'message' => 'Profile Image added successfully!']);
        }else{  

          // echo '<pre>';
          // print_r($userexist);        
          //   die('stop');
          if ($files = $request->file('image')) {
                  
                  $fileName = time().'.'.$request->image->getClientOriginalExtension();
                  $files->move('user/images/',$fileName);
                }

              $results = Project::where('id',$project_id)->update([
              'image' =>  $fileName,
              'name' => $name,
              'key' => $key,
              'Description' => $description,

            ]);
              return response()->json(['status' => 'true', 'message' => 'Profile Image updated successfully!']);

   }
    }
    public function roadmap(Request $request){

      $project_data = Project::where('id',$request->id)->first(); 
      $drop_down_data = Project::orderBy('id', 'DESC')->get();
      $project_id = $request->id; 
      $sprints = AllSprint::where('project_id',$request->id)->get();
      $types = Issue::get();
      $data_user = Auth::user();
      $task = Auth::user()->name;
      $users = User::where('user_role',1)->get(); 
      
      return view('projects::company.roadmap', compact('project_data','drop_down_data','project_id','sprints', 'types','task','users','data_user'));
    
    }
    public function create_issue(Request $request)
  {
    if ($request->isMethod('post'))
    {

       $project_id = $request->project_id;
       $issue_type = $request->issue_type;
       $summary = $request->summary; 
       $assignee = $request->assignee;
       $priority = $request->priority;
       $sprint = $request->sprint; 
       $description = $request->description;

       $validator = Validator::make($request->all(),[ 
        'project_id' => 'required',
        'issue_type' => 'required',    
        'summary' => 'required',     
        'assignee' => 'required',    
        'priority'=> 'required' 
  
      ]); 
       
     if ($validator->fails())
     {
        // Validation  Error Here 

         return Redirect::back()->withErrors($validator)->withInput();

     }
     else
     {
       
        // insert code 

          if(empty($sprint))
          {
            
              $sprint=NULL;
              $status=1;    // this status 1  for backlog
              
          }
          else
          {
              $sprint=$sprint; 
              $status=0;   // this status 1  for  No backlog
            
          } 

          $sprintIssue= new Sprint_Issue();
          $sprintIssue->project_id= $project_id; 
          $sprintIssue->sprint_id= $sprint;
          $sprintIssue->issue_name= $summary;
          $sprintIssue->description= $description; 
          $sprintIssue->created_by= $assignee; 
          $sprintIssue->assign_to= $assignee;  
          $sprintIssue->priority= $priority; 
          $sprintIssue->status= $status;
          $sprintIssue->save();


          if($status==1)
          {
            return Redirect('projects/company/'.$project_id.'/backlog');  
          }
          else
          {
            return Redirect('projects/sprint/company/create_issue/'.$project_id.'/'.$sprint);
          }

      

     }
       

    }

  }
  public function editBlackLog(Request $request)
    {
  
      
      if ($request->isMethod('post'))
      {
           
          $validator = Validator::make($request->all(),[
              'blacklogIssue' => 'required'
            ]); 
        
          
          if ($validator->fails())
          {
              return Redirect::back()->withErrors($validator)->withInput();
          }
            
          $blackName = $request->blacklogIssue;
  
            Sprint_Issue::where('id',$request->id)
           ->update(array('issue_name' =>$blackName)); 
           return Redirect::back();    
          
      }
  
    }

    public function deleteBlackLog(Request $request)
    {
       
      
  
      if ($request->isMethod('post'))
      {
       
         $backlogId= $request->id;
         $sprint_Issue = Sprint_Issue::find($backlogId);
         $sprint_Issue->delete();
         return Redirect::back();  
         
      }
  
  
    }

}
