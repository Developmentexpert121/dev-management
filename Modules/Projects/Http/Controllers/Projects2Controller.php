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
class Projects2Controller extends Controller
{

  public function index() {
    return view('projects::index');    
  }

  public function scrum_template(){
    return view('projects::admin.scrum_template');
  }

  public function team_management(){
    return view('projects::admin.team_management');  
  }

  public function company_management(){
    return view('projects::admin.company_management');  
  } 

  public function slug(Request $request){  
    $divider = '-';
    $text = $request->name ;
    //$num = str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // trim
    $text = trim($text, $divider);
    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);
    // lowercase
    $text = strtolower($text);
    return response()->json(
      [
      'success' => true,
      'message' => $text 
      ]
    );
  }

  public function company_management_insert(Request $request){
    $validator = Validator::make($request->all(),[
    'name' => 'required|unique:project',
    'key' => 'required',
    ]);
    if ($validator->fails()){
      return Redirect::back()->withErrors($validator)->withInput();
    }

    $user_check = Auth::user();
    $name = $request->name;
    $key = $request->key;
    $template = $request->template;
    $project_type = $request->project_type;
    $data = DB::table('project')->insert(
      array(
      'name' => $name, 
      'key' => $key,
      'createby' => $user_check['id'] , 
      'template' => $template,
      'project_type' => $project_type
      )
    );
    $lastId = DB::getPdo()->lastInsertId();
    if($data){  
      return Redirect('admin/project/company/'.$lastId);    
    }
  } 
  
  public function team_management_insert(Request $request){
    $validator = Validator::make($request->all(),[
        'name' => 'required|unique:project',
        'key' => 'required',
    ]);
    if ($validator->fails()){
      return Redirect::back()->withErrors($validator)->withInput();
    }
    $user_check = Auth::user();
    $name = $request->name;
    $key = $request->key;
    $template = $request->template;
    $project_type = $request->project_type;
    $data = DB::table('project')->insert(
        array(
               'name'=> $name, 
               'key' => $key,
               'createby'=> $user_check['id'] , 
               'template' => $template,
               'project_type' => $project_type
        )
    ); 
    $lastId = DB::getPdo()->lastInsertId();

    if($data)
    {
      return Redirect('admin/project/team/'.$lastId);    
    }
  } 
      
  public function information(){ 
    $project_list =  DB::table('project')->select('project.*','users.name as username')->join('users','users.id','=','project.createby')->orderBy('project.id', 'DESC')->get();
    return view('projects::admin.datatable')->with('project_list',$project_list,'single_project', $single_project);  
  }

  public function settings_save(Request $request){
    $validator = Validator::make($request->all(),[
      'name' => 'required',
      'key' => 'required',
    ]);
    if ($validator->fails()){
      return Redirect::back()->withErrors($validator)->withInput();
    }
    $project_id = $request->project_id;
    $project = Project::find($project_id);
    // Make sure you've got the Page model
    if($project) {
      $project->name = $request->name;
      $project->save();
      $url = 'admin/project/team/'.$project_id;
      return Redirect($url);
    }
  }

  public function roadmap(Request $request){

    $project_data = Project::where('id',$request->id)->first(); 
    $drop_down_data = Project::orderBy('id', 'DESC')->get();
    $project_id = $request->id; 
    $single_project = 'single_project';
    $sprints = AllSprint::where('project_id',$request->id)->get();
    $types = Issue::get();
    
    $task = Auth::user()->name;
    $users = User::get(); 
    $tasks = DB::table('task')->select('*')->join('all_sprints', 'all_sprints.id', '=', 'task.sprint_id')->where('task.project_id', $project_id)->get();
    return view('projects::roadmap', compact('single_project','project_data','drop_down_data','project_id', 'tasks','sprints', 'types','task','users'));
  
  }


  public function taskSave(Request $request)
  {

   $validator = Validator::make($request->all(),[ 
      'project' => 'required',
      'issue_type' => 'required',  
     // 'new_task' => 'required',     
      'reporter' => 'required',     
      'sprint' => 'required',    
      'summary'=> 'required',   
      'priority' => 'required'   

    ]); 
     
   if ($validator->fails())
   {
       return Redirect::back()->withErrors($validator)->withInput();
   }
     
    $project_id = $request->project_id; 

  // $taskName = $request->new_task;  
    
    $taskStatus = 'to-do';  
    $task = new task();  
    $task->project_id = $project_id;   
    
    //$task->project_type = 1;        

    $task->task_type =  $request->project;     
    $task->project_type = $request->issue_type;     
    $task->reporter =  $request->reporter;       
    $task->assignee =  $request->assignee;      
    $task->created_by = Auth::user()->id;            
       
    //$task->task_prioprity = 1;         
     
    $task->sprint_id = $request->sprint;    
    $task->description = $request->description;     
    $task->summary = $request->summary;    
    $task->task_prioprity = $request->priority;      
    $task->linked_issues = $request->linked_issues;      
    $task->issue = $request->issue;      
    $task->epic_link = $request->epic_link;       
  
    //$task->image=$request->attachment;    
    
    if($request->hasfile('attachment'))  
      {  
                  
        $file = $request->file('attachment');   
        $extension = $file->getClientOriginalExtension();    
        $filename = time().'.'. $extension;        
        $file->move('uploads/',$filename);     
        $task->image = $filename;           
           
      } 
      else
      {    
       
        $task->image = '';           
       
      } 

     // echo "<pre>"; print_r($task); echo "<pre>"; die(); 
     // $task->status = $taskStatus;   

    $task->save();   
    return Redirect('admin/project/team/'.$project_id.'/roadmap');   

  }      

 
   
  public function project_issues(Request $request)
  {  
    
    $project_data = Project::where('id',$request->id)->first();
    $drop_down_data = Project::orderBy('id', 'DESC')->get(); 
    $project_id = $request->id;
    $single_project = 'single_project';
    $issues = Issue::orderBy('id', 'ASC')->get();  
    return view('projects::issues', compact('single_project','project_data','drop_down_data','project_id', 'issues'));
  
  }
  public function settings_access(Request $request){
    $project_id = $request->id;
    $single_project = 'single_project';

    return view('projects::access', compact('single_project','project_id'));
  }

  public function saveIssue(Request $request){

    $validator = Validator::make($request->all(),[
      'new_issue' => 'required',
      'summary' => 'required',
      'description' => 'required'
  ]);

    if ($validator->fails())
    {
      return Redirect::back()->withErrors($validator)->withInput();
    }

    $project_id = $request->project_id;

    $issue = new Issue();
    $issue->project = $project_id;
    $issue->issue_type = $request->new_issue;
    $issue->summary = $request->summary; 
    $issue->description = $request->description;
    $issue->save();
    return Redirect('admin/project/team/'.$project_id.'/issues');     
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

  public function backlog(Request $request)
  {
    
  

    $project_data = Project::where('id',$request->id)->first();
    $drop_down_data = Project::orderBy('id', 'DESC')->get();
    $project_id = $request->id;
    $single_project = 'single_project'; 
    $sprints = AllSprint::where(['project_id'=>$request->id])->get();
    $sprintIssue= Sprint_Issue::where(['project_id'=> $project_id,'status'=>1])
    ->orderBy('id', 'DESC')->get();
 
    return view('projects::backlog', compact('single_project','project_data','drop_down_data','project_id', 'sprints','sprintIssue'));
  
  }

  public function blackLogMove(Request $request){
     echo'<pre>';
     print_r($request);
     die();
  }

  public  function category(Request $request)
  {  
    $data =category::all();  
    $project_data = Project::where('id',$request->id)->first();
    $drop_down_data = Project::orderBy('id', 'DESC')->get();
    $project_id = $request->id;  
    $single_project = 'single_project';    
    $category = category::orderBy('id', 'DESC')->get();
    return view('projects::category', compact('single_project','project_data','drop_down_data','project_id', 'category'));
    
  }

  public function savecategory(Request $request)
  {

    $validator = Validator::make($request->all(),[
      'name' => 'required|unique:category',
      'description' => 'required'
    ]);

  if ($validator->fails()){
      return Redirect::back()->withErrors($validator)->withInput();
  }
     
    $category = new category();
    $category->name = $request->name;
    $category->description = $request->description;
    $category->save();  

    Session::flash('message', ' Category add successfully !'); 
    Session::flash('alert-class', 'alert alert-success');

    return Redirect::back();     

  }

  public function editCategory(Request $request)
  {
    $id=$request->id;
    $category_edit_val= category::where('id',$id)->first();
    return view('projects::editCategory', compact('id','category_edit_val'));

  }  
  
  public function editDataCat(Request $request){

    $validator = Validator::make($request->all(),[
      'name' => 'required',
      'description' => 'required'
    ]);
 
  if ($validator->fails()){
      return Redirect::back()->withErrors($validator)->withInput();
  }

    category::where('id', $request->id)
       ->update([
           'name' => $request->name,
           'description'=> $request->description
        ]);

      Session::flash('message', ' Category Edit successfully !'); 
      Session::flash('alert-class', 'alert alert-success');

       return Redirect('admin/add/category');        

  }

  public function deleteCat(Request $request){
   
     $id = $request->id;
     $flight = category::find($id);
     $flight->delete();
     Session::flash('message', ' Category Delete successfully !'); 
     Session::flash('alert-class', 'alert alert-danger');
     return Redirect::back();
    

  }

  public function edit_sprint(Request $request)
  {

      
        $id = $request->edit_id; 
        $allSprint_dit_val= AllSprint::where('id',$id)->first();
        $single_project = 'single_project';  
        $project_id = $request->project_id;
       
        return view('projects::admin.editSprint', compact('id','allSprint_dit_val','single_project','project_id'));
      
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

     return Redirect("admin/project/team/$project_id/sprints"); 

  

     

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


  public function sprint_create_issue(Request $request)
  { 

    $project_id =  $request->project_id;  
    $sprint_id =  $request->sprint_id;
    $project_data = Project::where('id',$project_id)->first();
    $drop_down_data = Project::orderBy('id', 'DESC')->get();
    $single_project = 'single_project';   
    $sprintIssue= Sprint_Issue::where(['project_id'=> $project_id,'sprint_id'=>$sprint_id])->orderBy('id', 'DESC')->get();
    
    return view('projects::sprint_create_issue', compact('single_project','project_data','drop_down_data','project_id','sprint_id','sprintIssue'));
    
    
  }
  
  public function blackLogIssueCreate(Request $request)
  {
  

    $validator = Validator::make($request->all(),[
      'blacklogIssueCreate' => 'required'
    ]);   
   
    if ($validator->fails())
    {
      return Redirect::back()->withErrors($validator)->withInput();
    }

    $userId = Auth::id();
   
    $sprintIssue= new Sprint_Issue();
    $sprintIssue->issue_name= $request->blacklogIssueCreate;
    $sprintIssue->project_id= $request->project_id;
    $sprintIssue->status= 1;
    $sprintIssue->created_by= $userId;
    $sprintIssue->save();


    return Redirect::back()->with('message','black Log Issue Add Successfully');
    
    

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

   public function start_sprint(Request $request)
   {
    
    $validator = Validator::make($request->all(),[
      'sprint_start_date' => 'required',
      'sprint_name'=>'required',
      'sprint_duration'=>'required',
      'sprint_end_date'=>'required',
      'start_sprint_goal'=>'required'
    ]); 

    if ($validator->fails())
    {
      return Redirect::back()->withErrors($validator)->withInput();
    }
     
   

     $sprint_start= new Sprint_start();
     $sprint_start->product_id = $request->project_id;
     $sprint_start->sprint_id = $request->sprint_id;
     $sprint_start->sprint_name = $request->sprint_name; 
     $sprint_start->sprint_start_date = $request->sprint_start_date; 
     $sprint_start->sprint_duration = $request->sprint_duration;
     $sprint_start->sprint_end_date = $request->sprint_end_date;
     $sprint_start->start_sprint_goal = $request->start_sprint_goal;

     $sprint_start->save();
   

     $affectedRows = AllSprint::where(
       [
         'id' => $request->sprint_id,
         'project_id'=>$request->project_id
         ]
         )
         ->update
         (
           [
             "sprint_start_status" => 1
           ]
        );


     return Redirect::back()->with('message','Sprint Start Successfully');
   
     

   }


   public function complete_sprint(Request $request){

    

      $project_id = $request->project_id;
      $sprint_id = $request->sprint_id;
      $next_id = $request->next_id;

      if($next_id==$sprint_id){
        AllSprint::where(
          [
            'id' => $sprint_id,
            'project_id'=>$project_id
            ]
            )
            ->update(
              ["sprint_start_status" => 2]
            ); 
      }
      else
      {
              

      AllSprint::where(
        [
          'id' => $sprint_id,
          'project_id'=>$project_id
          ]
          )
          ->update(
            ["sprint_start_status" => 2]
          );

      AllSprint::where(
        [
          'id' => $next_id,
          'project_id'=>$project_id
          ]
          )
          ->update(
            ["sprint_start_status" => 5]
          );

      }


   
       return Redirect::back()->with('message','Sprint Complate Successfully');
   

   }

   public function action_issue(Request $request)
   {
      
       if($request->type==1)
       { 
          $action = $request->action; 
          $project_id = $request->project_id; 
          $sprint_id = $request->sprint_id; 
          $issue_id = $request->issue_id;  

             Sprint_Issue::where(
             [
               'id' => $issue_id
               ]
               ) 
               ->update(  
                 ["issue_status" => $action]
               );

           

               $status=200;
               return response()->json(
                 [
                   'status' => $status,
                   'data' => $action,
                   'message'=>"Update Successfully"
                  ]);

 


        
           
       }  
   }



   public function delete_issue(Request $request)
   {
    if ($request->isMethod('get')){

       $id = $request->id;
       $res = Sprint_Issue::where('id',$id)->delete();
       return Redirect::back()->with('message','Sprint Delete Successfully'); 
     }

   }
   

   public function update_issue(Request $request)
   {
    if ($request->isMethod('post'))
    {

        $id = $request->issue_id;
        $name = $request->issue_name; 
     
         $validator = Validator::make($request->all(),[
            'issue_name' => 'required'
         ]); 

         if ($validator->fails())
         {  
            return Redirect::back()->withErrors($validator)->withInput();
         }  
            
         $res = Sprint_Issue::where('id',$id)
         ->update([
          "issue_name"=> $name
         ]); 
         
         return Redirect::back()->with('message','Sprint Update Successfully'); 

    }
   

   }

   public function issue_delete(Request $request)
   {

    if ($request->isMethod('get'))
    {
        $id = $request->id; 
        $res = Issue::where('id',$id)->delete(); 
        return Redirect::back() 
        ->with('message','Issue Delete Successfully');  

    } 

   }


     public function  issue_update(Request $request)
    {

      if ($request->isMethod('post'))
      {
          
          $issue_id = $request->issue_id; 
          $name = $request->name; 
          $eSummary = $request->eSummary; 
          $eDescription = $request->eDescription; 

          $validator = Validator::make($request->all(),[ 
           'issue_id' => 'required',
           'name'=>'required',
           'eSummary'=>'required',
           'eDescription'=>'required'
          ]);  

          if ($validator->fails())
          {
            return Redirect::back()->withErrors($validator)->withInput();
          }
        
          $res = Issue::where('id',$issue_id) 
          ->update([  
            "issue_type" => $name,   
            "summary" => $eSummary,     
            "description" => $eDescription    
           ]);  
        
           return Redirect::back()->with('message','Issue Update Successfully'); 

         
        }

    }

    public function sprints(Request $request)
    {
      
      $project_data = Project::where('id',$request->id)->first();
      $drop_down_data = Project::orderBy('id', 'DESC')->get();
      $project_id = $request->id;
  
      $single_project = 'single_project';   
      $sprints = AllSprint::where('project_id',$request->id)->get();
      
      $logs = AllSprint::where('project_id',$request->id)->get();
      $nums = AllSprint::where('project_id',$request->id)->count();
    
      $last = $sprints->first();  
  
    
  
      return view('projects::sprints', compact('single_project','project_data','drop_down_data','project_id','nums', 'sprints','last','logs'));
       
    }  

    
    public function board(Request $request)
    {

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




  

   

}