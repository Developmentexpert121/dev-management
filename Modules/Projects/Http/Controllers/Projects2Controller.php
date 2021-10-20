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
use Modules\Projects\Entities\task;
use Modules\Projects\Entities\Issue;
use Modules\Projects\Entities\category;
use Session;

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
    $types = Issue::where('project',$request->id)->get();
    $tasks = DB::table('task')->select('*')->join('all_sprints', 'all_sprints.id', '=', 'task.sprint_id')->where('task.project_id', $project_id)->get();
    return view('projects::roadmap', compact('single_project','project_data','drop_down_data','project_id', 'tasks','sprints', 'types'));
  
  }

  public function taskSave(Request $request){

    $validator = Validator::make($request->all(),[
      'new_task' => 'required',
      'sprint' => 'required'
 
  ]);

  if ($validator->fails()){
      return Redirect::back()->withErrors($validator)->withInput();
  }

    $project_id = $request->project_id;
    $taskName = $request->new_task;
    $taskStatus = 'to-do';
    $task = new task();
    $task->project_id = $project_id;
    $task->project_type = 1;
    $task->task_type = $taskName;
    $task->reporter = Auth::user()->id;
    $task->assignee = Auth::user()->id;
    $task->created_by = Auth::user()->id;
    $task->summary = $taskName;
    $task->description = $taskName;
    $task->task_prioprity = 1;
    $task->sprint_id = $request->sprint;
    // $task->status = $taskStatus;
    $task->save();
    return Redirect('admin/project/team/'.$project_id.'/roadmap');
  }

  public function sprints(Request $request){
     
    $project_data = Project::where('id',$request->id)->first();
    $drop_down_data = Project::orderBy('id', 'DESC')->get();
    $project_id = $request->id;
 
    $single_project = 'single_project';
    $sprints = AllSprint::where('project_id',$request->id)->orderBy('id', 'DESC')->get();
    return view('projects::sprints', compact('single_project','project_data','drop_down_data','project_id', 'sprints'));
    
  }

  public function project_issues(Request $request){
    $project_data = Project::where('id',$request->id)->first();
    $drop_down_data = Project::orderBy('id', 'DESC')->get();
    $project_id = $request->id;
    $single_project = 'single_project';
    $issues = Issue::orderBy('id', 'ASC')->get();
    return view('projects::issues', compact('single_project','project_data','drop_down_data','project_id', 'issues'));
  }

  public function saveIssue(Request $request){
    $project_id = $request->project_id;

    $issue = new Issue();
    $issue->project = $project_id;
    $issue->issue_type = $request->new_issue;
    $issue->summary = $request->summary;
    $issue->description = $request->issuedescription;
    $issue->save();
    return Redirect('admin/project/team/'.$project_id.'/issues');    
  }

  public function saveSprint(Request $request){

    $validator = Validator::make($request->all(),[
      'new_sprint' => 'required',
      'duration' => 'required', 
      'start_date'=>'required', 
      'end_date'=>'required', 
      'sprint_goal'=>'required', 
  ]);

  if ($validator->fails()){
      return Redirect::back()->withErrors($validator)->withInput();
  }

    $sprint = new AllSprint();
    $sprint->sprint_name = $request->new_sprint;
    $sprint->created_by = Auth::user()->id;
    $sprint->duration = $request->duration;
    $sprint->start_date = $request->start_date;
    $sprint->end_date = $request->end_date;
    $sprint->sprint_goal = $request->sprint_goal;
    $sprint->project_id = $request->project_id;

    Session::flash('message', '! '.$request->new_sprint.' Sprint Add Successfully');  
    Session::flash('alert-class', 'alert alert-success');  

    $sprint->save();
    return Redirect('admin/project/team/'.$request->project_id.'/sprints');    
  }

  public function backlog(Request $request){
    $project_data = Project::where('id',$request->id)->first();
    $drop_down_data = Project::orderBy('id', 'DESC')->get();
    $project_id = $request->id;
    $single_project = 'single_project';
    $sprints = AllSprint::where('project_id',$request->id)->get();
    return view('projects::backlog', compact('single_project','project_data','drop_down_data','project_id', 'sprints'));
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

   

}