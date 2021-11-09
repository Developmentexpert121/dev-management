<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Projects\Entities\Project;
use Modules\Projects\Entities\AllSprint;
use Modules\Projects\Entities\Sprint_Issue;
use Modules\Projects\Entities\category;

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

    return Redirect('projects/company/'.$request->project_id.'/sprints');     

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
       echo'<pre>';
       print_r($request);
       die();
    }

    public function project_settngs(Request $request){

      $data_user = Auth::user();
      $categorys = category::get();
      $project_data = Project::where('id',$request->id)->first();
      $drop_down_data = Project::orderBy('id', 'DESC')->get();
      $project_id = $request->id;
      $single_project = 'single_project';
      return view("projects::company.project_settngs", compact('drop_down_data','project_data', 'project_id','single_project','categorys','data_user'));
    
     }
     public function project_company_detail_save(Request $request){
     die('ruk oye');
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

}
