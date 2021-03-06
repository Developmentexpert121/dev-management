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
use Modules\User\Entities\AssignProjects;
class ProjectsMainController extends Controller
{

  public function index(Request $request)
  {
      if ($request->isMethod('get'))
      { 
        $user_auth = Auth::user();

        if($user_auth->user_role==5)
        {
          return view('projects::admin.template'); 
        }
        elseif($user_auth->user_role==6)
        {
          return view('projects::ceo.template'); 
        }
        elseif($user_auth->user_role==7)
        {
          return view('projects::cto.template'); 
        }
        elseif($user_auth->user_role==1)
        {
          return view('projects::team_leader.template'); 
        }    

      }  
  }

  public function scrum_template(Request $request)
  { 
      if ($request->isMethod('get'))
      { 

        $user_auth = Auth::user();

        if($user_auth->user_role==5)
        {
          return view('projects::admin.scrum_template');
        }
        elseif($user_auth->user_role==6)
        {
          return view('projects::ceo.scrum_template');
        }
        elseif($user_auth->user_role==7)
        {
          return view('projects::cto.scrum_template');
        }
        elseif($user_auth->user_role==1)
        {
          return view('projects::team_leader.scrum_template');
        }

      }
  }

  public function team_management(Request $request)
  {
    if ($request->isMethod('get'))
    { 

      $user_auth = Auth::user();

      if($user_auth->user_role==5)
      {
         return view('projects::admin.team_management');  
      }
      elseif($user_auth->user_role==6){

        return view('projects::ceo.team_management'); 

      }
      elseif($user_auth->user_role==7){

        return view('projects::cto.team_management');  

      }
      elseif($user_auth->user_role==1){

        return view('projects::team_leader.team_management');  

      }
      
    }   
  }

  public function company_management(Request $request)
  {
      if ($request->isMethod('get'))
      { 
          $user_auth = Auth::user();

          if($user_auth->user_role==5)
          {
            return view('projects::admin.company_management');   
          } 
          elseif($user_auth->user_role==6)
          {
            return view('projects::ceo.company_management');   
          } 
          elseif($user_auth->user_role==7)
          {
            return view('projects::cto.company_management');   
          } 
          elseif($user_auth->user_role==1)
          {
            return view('projects::team_leader.company_management');   
          } 
      } 
 
 }

  public function slug(Request $request)
  {  
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

  public function company_management_insert(Request $request)
  {

    if ($request->isMethod('post'))
    { 
      
        $user_auth = Auth::user();
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

        $data = array(
              'name'=> $name, 
              'key' => $key,
              'createby'=> $user_check['id'] , 
              'template' => $template,
              'project_type' => $project_type
        );

        $data_val = Project::insert($data);
        $lastId = DB::getPdo()->lastInsertId();

        if($data_val)
        {  
          if($user_auth->user_role==5)
          {
             return Redirect('admin/project/company/'.$lastId); 
          }
          elseif($user_auth->user_role==6)
          {
            return Redirect('admin/project/company/'.$lastId); 
          }
          elseif($user_auth->user_role==7)
          {
            return Redirect('admin/project/company/'.$lastId); 
          } 
          elseif($user_auth->user_role==1)
          {
            return Redirect('team_leader/project/company/'.$lastId); 
          }       
        }

     }
  }
  
  public function team_management_insert(Request $request)
  { 
    
    if ($request->isMethod('post'))
    { 
          $user_auth = Auth::user();
      
          $validator = Validator::make($request->all(),[
              'name' => 'required|unique:project',
              'key' => 'required',
          ]);

          if ($validator->fails())
          {
              return Redirect::back()->withErrors($validator)->withInput();
          }

          $user_check = Auth::user();
          $name = $request->name;
          $key = $request->key;
          $template = $request->template;
          $project_type = $request->project_type; 

          $data = array(
                    'name' => $name, 
                    'key' => $key,
                    'createby' => $user_check['id'] , 
                    'template' => $template,
                    'project_type' => $project_type
              ); 

          $data_val = Project::insert($data);
          $lastId = DB::getPdo()->lastInsertId();

          if($data_val)
          {  
              if($user_auth->user_role==5)
              {
                return Redirect('admin/project/team/'.$lastId);
              }
              elseif($user_auth->user_role==6)
              {
                return Redirect('ceo/project/team/'.$lastId);
              }
              elseif($user_auth->user_role==7)
              {
                return Redirect('cto/project/team/'.$lastId);
              } 
              elseif($user_auth->user_role==1)
              {
                return Redirect('team_leader/project/team/'.$lastId);
              }         
          }

     }  

  }
      
  public function information(Request $request){ 
   
    
    if ($request->isMethod('get'))
    {
        $user_id = Auth::user()->id; 
        $user_auth = Auth::user(); 
        $project_assign= $user_auth->project_assign; 
       
        // if($user_auth->user_role==1)
        // {
        //     $project_list =  DB::table('project') 
        //     ->select('project.*','users.name as username') 
        //     ->join('users','users.id','=','project.createby') 
        //     ->whereIn('project.id',array($project_assign))  
        //     ->orderBy('project.id', 'DESC')   
        //     ->get();    
        // }
        // else
        // { 

            $project_list =  DB::table('project') 
            ->select('project.*','users.name as username','role.name as role') 
            ->join('users','users.id','=','project.createby')
            ->join('role','role.id','=','users.user_role')  
            ->orderBy('project.id', 'DESC')
            ->get();    
            
  
        // } 
         
        $profiledata = usersdata::where('user_id' , $user_id)->first(); 
      
    
        // if($user_auth->user_role==1)
        // { 
        //    return view('projects::admin.projectList',compact('profiledata'))->with('project_list',$project_list);  
        // }

        if($user_auth->user_role==5)
        { 
           return view('projects::admin.projectList',compact('profiledata'))->with('project_list',$project_list);  
        }
        elseif($user_auth->user_role==6)
        { 
            return view('projects::ceo.projectList',compact('profiledata'))->with('project_list',$project_list);  
        }
        elseif($user_auth->user_role==7)
        {    
            return view('projects::cto.projectList',compact('profiledata'))->with('project_list',$project_list);  
        }

    }
  
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

  public function createissue(Request $request)
  {

    if ($request->isMethod('get'))
    { 
       
        $project_data = Project::where('id',$request->id)->first(); 
        $drop_down_data = Project::orderBy('id', 'DESC')->get();
        $project_id = $request->id; 
        $single_project = 'single_project';
        $sprints = AllSprint::where('project_id',$request->id)->get();
        $types = Issue::get();
        $data_user = Auth::user();
        $task = Auth::user()->name;
        $users = User::where('user_role',1)->get(); 

        if($data_user->user_role==5)
        {
          return view('projects::admin.issue', compact('single_project','project_data','drop_down_data','project_id','sprints', 'types','task','users','data_user'));
        }
        elseif($data_user->user_role==6)
        {
          return view('projects::ceo.issue', compact('single_project','project_data','drop_down_data','project_id','sprints', 'types','task','users','data_user'));
        }
        elseif($data_user->user_role==7)
        {
          return view('projects::cto.issue', compact('single_project','project_data','drop_down_data','project_id','sprints', 'types','task','users','data_user'));
        }
        elseif($data_user->user_role==1)
        {
          return view('projects::team_leader.issue', compact('single_project','project_data','drop_down_data','project_id','sprints', 'types','task','users','data_user'));
        }
        elseif($data_user->user_role==2)
        {
          return view('projects::employee.issue', compact('single_project','project_data','drop_down_data','project_id','sprints', 'types','task','users','data_user'));
        }
     }
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
                return Redirect('admin/project/team/'.$project_id.'/backlog');  
              }
              else
              { 
                return Redirect('admin/project/sprint/create_issue/'.$project_id.'/'.$sprint);
              }

          

        }
          

    }

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

     $data_user = Auth::user();
     $project_data = Project::where('id',$request->id)->first();
     $drop_down_data = Project::orderBy('id', 'DESC')->get(); 
     $project_id = $request->id;
     $single_project = 'single_project';
     $issues = Issue::orderBy('id', 'ASC')->get();  
     return view('projects::issues', compact('single_project','project_data','drop_down_data','project_id', 'issues','data_user'));
  
  }

  
  public function settings_access(Request $request){

    $data_user = Auth::user();
    $user_access = Auth::user();
    // echo '<pre>';
    // print_r($user_access);
    // die();
    $project_id = $request->id;
    $single_project = 'single_project';

    return view('projects::access', compact('single_project','project_id','user_access','data_user'));
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
   
    if ($request->isMethod('post'))
    { 
      
        $data_user = Auth::user();

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

       

        if(!$chk=='')
        {
        
        if(!empty($chk['sprint_start_status']==2))
        { 
            $sprint->sprint_start_status = 5;   
        }  

        } 

        $sprint->save();   
        
        Session::flash('message', $request->new_sprint.' Sprint Create Successfully');   
        Session::flash('alert-class', 'alert alert-success'); 

        if($data_user->user_role==5)
        {
          return Redirect('admin/project/team/'.$request->project_id.'/sprints');  
        }
        elseif($data_user->user_role==6)
        {
          return Redirect('ceo/project/team/'.$request->project_id.'/sprints');   
        }
        elseif($data_user->user_role==7)
        {
          return Redirect('cto/project/team/'.$request->project_id.'/sprints');   
        } 
        elseif($data_user->user_role==1)
        {
          return Redirect('team_leader/project/team/'.$request->project_id.'/sprints');   
        }       
     

        
    }
  }

  public function backlog(Request $request)
  {
    
    if ($request->isMethod('get'))
      {

        $data_user = Auth::user();
        $project_data = Project::where('id',$request->id)->first();
        $drop_down_data = Project::orderBy('id', 'DESC')->get();
        $project_id = $request->id;
        $single_project = 'single_project'; 
        $sprints = AllSprint::where(['project_id'=>$request->id])->get();
        $sprintIssue= Sprint_Issue::where(['project_id'=> $project_id,'status'=>1])
        ->orderBy('id', 'DESC')->get();

        if($data_user->user_role==5)
        {
          return view('projects::admin.backlog', compact('single_project','project_data','drop_down_data','project_id', 'sprints','sprintIssue','data_user'));
        }
        elseif($data_user->user_role==6)
        {
          return view('projects::ceo.backlog', compact('single_project','project_data','drop_down_data','project_id', 'sprints','sprintIssue','data_user'));  
        }
        elseif($data_user->user_role==7)
        {
          return view('projects::cto.backlog', compact('single_project','project_data','drop_down_data','project_id', 'sprints','sprintIssue','data_user'));  
        }
        elseif($data_user->user_role==1)
        {
          return view('projects::team_leader.backlog', compact('single_project','project_data','drop_down_data','project_id', 'sprints','sprintIssue','data_user'));  
        }
        elseif($data_user->user_role==2)
        {
         
          return view('projects::employee.backlog', compact('single_project','project_data','drop_down_data','project_id', 'sprints','sprintIssue','data_user'));  
        }
      }
  
  }

  public function blackLogMove(Request $request)
  {
     
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

  public  function role(Request $request)
  {  
    $data =category::all(); 
    $role = DB::table('role')->where('status',0)->get();
    $user_auth = Auth::user(); 
    $project_data = Project::where('id',$request->id)->first();
    $drop_down_data = Project::orderBy('id', 'DESC')->get();
    $project_id = $request->id;  
    $single_project = 'single_project';    
    $category = category::orderBy('id', 'DESC')->get();
    return view('projects::admin.category', compact('single_project','project_data','drop_down_data','project_id', 'category','user_auth','role'));
    
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
    $user_auth = Auth::user(); 
    $category_edit_val= category::where('id',$id)->first();
    return view('projects::editCategory', compact('id','category_edit_val','user_auth'));

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

       if ($request->isMethod('get'))
       { 
      
            $user_auth = Auth::user(); 
            $id = $request->edit_id; 
            $allSprint_dit_val= AllSprint::where('id',$id)->first();
            $single_project = 'single_project';  
            $project_id = $request->project_id; 
            $project_data = Project::where('id',$project_id)->first(); 
            if($user_auth->user_role==5)
            {
              return view('projects::admin.editSprint', compact('project_data','id','allSprint_dit_val','single_project','project_id','user_auth'));
            }
            elseif($user_auth->user_role==6)
            {
              return view('projects::ceo.editSprint', compact('project_data','id','allSprint_dit_val','single_project','project_id','user_auth'));
            }
            elseif($user_auth->user_role==7)
            {
              return view('projects::cto.editSprint', compact('project_data','id','allSprint_dit_val','single_project','project_id','user_auth'));
            }
            elseif($user_auth->user_role==1)
            {
              return view('projects::team_leader.editSprint', compact('project_data','id','allSprint_dit_val','single_project','project_id','user_auth'));
            }
       }
  }

  public function editData_sprint(Request $request)
  {  
    
      if ($request->isMethod('post'))
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
          $data_user = Auth::user();

          Session::flash('message', ' Sprint Edit successfully !'); 
          Session::flash('alert-class', 'alert alert-success');

          if($data_user->user_role==5)
          {
             return Redirect("admin/project/team/$project_id/sprints");  
          }
          elseif($data_user->user_role==6)
          {
            return Redirect("ceo/project/team/$project_id/sprints");
          }  
          elseif($data_user->user_role==7)
          {
            return Redirect("cto/project/team/$project_id/sprints");
          } 
          elseif($data_user->user_role==1)
          {
            return Redirect("team_leader/project/team/$project_id/sprints");
          }   

  

     }   

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


    if ($request->isMethod('get'))
    { 
    
       $data_user = Auth::user();
       $project_id =  $request->project_id;  
       $sprint_id =  $request->sprint_id;
       $project_data = Project::where('id',$project_id)->first();
       $sprintIssue = Sprint_Issue::where(['project_id'=> $project_id,'sprint_id'=>$sprint_id,'status'=>0])
       ->orderBy('id', 'DESC')->get();
       $AssignProjects = AssignProjects::where(['project_id'=>$project_id])->count();
       $project_Assign_Users = DB::table('assign_projects')
       ->select('assign_projects.*','users.name')
       ->join('users', 'assign_projects.assign_to', '=', 'users.id') 
       ->where('assign_projects.project_id',$project_id)
       ->groupBy('assign_projects.assign_to')
       ->get(); 
    
       if($data_user->user_role==5)
       {
           return view('projects::admin.sprint_create_issue',compact('project_data','project_id','sprint_id','sprintIssue','project_Assign_Users'));
       }
       elseif($data_user->user_role==6)
       {
          return view('projects::ceo.sprint_create_issue',compact('project_data','project_id','sprint_id','sprintIssue','project_Assign_Users'));
       }
       elseif($data_user->user_role==7)
       {
          return view('projects::cto.sprint_create_issue',compact('project_data','project_id','sprint_id','sprintIssue','project_Assign_Users'));
       } 
       elseif($data_user->user_role==1)
       { 
          return view('projects::team_leader.sprint_create_issue',compact('project_data','project_id','sprint_id','sprintIssue','project_Assign_Users'));
       }
       elseif($data_user->user_role==2)
       { 
          return view('projects::employee.sprint_create_issue',compact('project_data','project_id','sprint_id','sprintIssue','project_Assign_Users'));
       }   


    }
  
    
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
        $assign = $request->assign;
     
         $validator = Validator::make($request->all(),[
            'issue_name' => 'required',
            'assign'=>'required',
         ]); 

         if ($validator->fails())
         {  
            return Redirect::back()->withErrors($validator)->withInput();
         }  
            
         $res = Sprint_Issue::where('id',$id)
         ->update([
          "issue_name"=> $name,
          "assign_to" =>$assign
         ]); 
         
         return Redirect::back()->with('message','Issue Update Successfully'); 

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
      
      if ($request->isMethod('get'))
      {  
      
          
          $data_user = Auth::user(); 
          $project_data = Project::where('id',$request->id)->first();
         
          $tasks = Auth::user()->id;
          $profiledata = usersdata::where('user_id' , $tasks)->first();
          $drop_down_data = Project::orderBy('id', 'DESC')->get();
          $project_id = $request->id;
     

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

          if($data_user->user_role==5)
          { 
            return view('projects::admin.sprints', compact('project_data','drop_down_data','project_id','nums', 'sprints','last','logs','data_user','profiledata'));
          }
          elseif($data_user->user_role==6)
          { 
            return view('projects::ceo.sprints', compact('project_data','drop_down_data','project_id','nums', 'sprints','last','logs','data_user','profiledata'));
          }
          elseif($data_user->user_role==7)
          {
            return view('projects::cto.sprints', compact('project_data','drop_down_data','project_id','nums', 'sprints','last','logs','data_user','profiledata'));
          }
          elseif($data_user->user_role==1)
          {
            return view('projects::team_leader.sprints', compact('project_data','drop_down_data','project_id','nums', 'sprints','last','logs','data_user','profiledata'));
          }
          elseif($data_user->user_role==2)
          {
            return view('projects::employee.sprints', compact('project_data','drop_down_data','project_id','nums', 'sprints','last','logs','data_user','profiledata'));
          }    
      }
    }  

    
    public function board(Request $request)
    {

      if ($request->isMethod('get'))
      { 
          
          $data_user = Auth::user();
          $project_data = Project::where('id',$request->project_id)->first(); 
          $drop_down_data = Project::orderBy('id', 'DESC')->get(); 
          $project_id = $request->project_id;  
          $statusResult = DB::table('board_heading')->get();
          $getSprint = AllSprint::where('project_id',$project_id)->first();
          if(!empty($getSprint))
          {

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
        
        if($data_user->user_role==5)
        {
          return view('projects::admin.board',compact('project_data','drop_down_data','project_id','statusResult','taskResult','data_user')); 
        }
        elseif($data_user->user_role==6)
        {
          return view('projects::ceo.board',compact('project_data','drop_down_data','project_id','statusResult','taskResult','data_user')); 
        }
        elseif($data_user->user_role==7)
        {
          return view('projects::cto.board',compact('project_data','drop_down_data','project_id','statusResult','taskResult','data_user')); 
        }
        elseif($data_user->user_role==1)
        {
          return view('projects::team_leader.board',compact('project_data','drop_down_data','project_id','statusResult','taskResult','data_user')); 
        }
        elseif($data_user->user_role==2)
        {
          return view('projects::employee.board',compact('project_data','drop_down_data','project_id','statusResult','taskResult','data_user')); 
        }
        
        
          //$taskResult = Sprint_Issue::get(); 

          // $taskResult = DB::table('sprint_issue')
          // ->Join('all_sprints', 'all_sprints.id', '=', 'sprint_issue.sprint_id')
          // ->select(['sprint_issue.*','all_sprints.sprint_start_status'])
          // ->where('sprint_issue.project_id',$project_id)
          // ->orderBy('sprint_issue.id', 'desc') 
          // ->get();
          
          // return view('projects::board',compact('single_project','project_data','drop_down_data','project_id','statusResult','taskResult')); 
      }
 
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