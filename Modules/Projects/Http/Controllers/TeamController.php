<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;
use Redirect;
use Modules\Projects\Entities\AllSprint;
use Modules\Projects\Entities\task;
use Modules\Projects\Entities\project;
use Auth;
use App\Models\User;

class TeamController extends Controller
{

   public function index(Request $request){
   }

   public function load_page(Request $request){
      $project_data = project::where('id',$request->id)->first();
      $drop_down_data = project::orderBy('id', 'DESC')->get();
      $project_id = $request->id;
      return view("projects::team.dashboard", compact('drop_down_data','project_data', 'project_id'));
   }

   public function backlog_view(Request $request){ 
     
      $project_id = $request->id;
      $project_data = project::where('id',$request->id)->first();
      $drop_down_data = project::orderBy('id', 'DESC')->get();
      $sprint = AllSprint::where('project_id',$project_id)
                          ->orderBy('id', 'DESC')
                          ->get();
     
      return view("projects::team.backlog", compact('drop_down_data','project_data', 'project_id','sprint'));
   }

   public function create_issue(Request $request){
      $createdby= Auth::user();
      $project_id = $request->id;
      $sprint= allsprint::where('project_id',$request->id)->get();
      $project_data = project::where('id',$request->id)->first();
      $drop_down_data = project::orderBy('id', 'DESC')->get();
      $employee= user::where('user_role',2)->orderBy('id', 'DESC')->get();
  
      return view('projects::team.createissue', compact('drop_down_data','project_data', 'project_id','sprint','createdby','employee'));
   }

   public function store_issue(Request $request){
    
 

      $validator = Validator::make($request->all(),[
           'project_name' => 'required',
           'task_type' => 'required', 
           'summary'=>'required', 
           'description' => 'required',
           'priority' => 'required', 
           'sprint'=>'required',
           // 'browse' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          
       ]);
       if ($validator->fails()){
           return Redirect::back()->withErrors($validator)->withInput();
       }

       $project_id = $request->project_id;
    
     
      $createdby= Auth::id();

      // $image = $request->file('file');
      //   $FileName = $image->getClientOriginalName();
      //   $image->move(public_path('images'), $FileName);
    
      $modal=new task();
        $modal->project_id = $request->input('project_name');
        $modal->task_type = $request->input('task_type');
        $modal->project_type = '1';
        $modal->summary = $request->input('summary');
        $modal->description = $request->input('description');
        $modal->created_by = $createdby;
        $modal->sprint_id = $request->input('sprint');
        $modal->reporter = $createdby;
        $modal->task_prioprity=$request->input('priority');

        $modal->save();
        $project_data = project::where('id',$request->id)->first();
        $drop_down_data = project::orderBy('id', 'DESC')->get();
        $url = "/admin/project/team/backlog/$project_id";
      return redirect($url);
   }
   public function sprint_view(Request $request) 
   {

       $project_id = $request->id;
      
       $project_data = project::where('id',$request->id)->first();
       $drop_down_data = project::orderBy('id', 'DESC')->get();
      return view('projects::team.Sprintview', compact('drop_down_data','project_data', 'project_id'));
   }

      public function store_sprints(Request $request){

          $validator = Validator::make($request->all(),[
           'sprint_name' => 'required',
           'duration' => 'required', 
           'start_date'=>'required', 
           'end_date' => 'required',
           'sprint_goal' => 'required', 

          
       ]);
       if ($validator->fails()){
           return Redirect::back()->withErrors($validator)->withInput();
       }
         $user_check= Auth::id();

        
        $modal=new allsprint();
        $modal->sprint_name=$request->input('sprint_name');
        $modal->duration=$request->input('duration');
        $modal->start_date=$request->input('start_date');
        $modal->end_date=$request->input('end_date');
        $modal->sprint_goal=$request->input('sprint_goal');
        $modal->created_by = $user_check;
        $modal->project_id = $request->input('project_id');;
        $modal->save();

            return redirect()->back();
      }

      public function count_sprints(){
         $all_sprints = DB::table('all_sprints')->get();
         $new_sprints = count($all_sprints)+1;
         $sprint = 'test&nbsp;' . 'sprint&nbsp;' . $new_sprints;
         print_r($sprint);
         // echo '<pre>';
         // print_r( $new_sprints);
          die();
      }

      public function single_sprint(REQUEST $request)
      {

         $project_id = $request->id;
         $project_data = project::where('id',$request->id)->first();
         $drop_down_data = project::orderBy('id', 'DESC')->get();

         $task_id = $request->issue_id;

         $task_data = task::select("task.*","all_sprints.sprint_name","project.name as project_name",'all_sprints.start_date','all_sprints.end_date')
        ->join("all_sprints","all_sprints.id","=","task.sprint_id")
        ->join("project","project.id","=","task.project_id")
        ->get();
  
      
         return view('projects::team.single_sprint', compact('drop_down_data','project_data', 'project_id','task_data'));
      }

}