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
      return view("projects::team.backlog", compact('drop_down_data','project_data', 'project_id'));
   }

   public function create_issue(Request $request){
      $project_id = $request->id;
   $project_data = project::where('id',$request->id)->first();
      $drop_down_data = project::orderBy('id', 'DESC')->get();
      return view('projects::team.createissue', compact('drop_down_data','project_data', 'project_id'));
   }

   public function store_issue(Request $request){

      $validator = Validator::make($request->all(),[
           'project_name' => 'required',
           'task_type' => 'required', 
           'summary'=>'required', 
           'description' => 'required',
           'priority' => 'required', 
          
       ]);
       if ($validator->fails()){
           return Redirect::back()->withErrors($validator)->withInput();
       }

       $project_id = $request->project_id;
    
     
      $createdby= Auth::id();

    
      $modal=new task();
        $modal->project_name=$request->input('project_name');
        $modal->task_type=$request->input('task_type');
        $modal->project_type='1';
        $modal->summary=$request->input('summary');
        $modal->description=$request->input('description');
        $modal->created_by=$createdby;
        $modal->task_prioprity=$request->input('priority');

        $modal->save();

      
    $project_data = project::where('id',$request->id)->first();
      $drop_down_data = project::orderBy('id', 'DESC')->get();
      $url = "/admin/project/team/backlog/$project_id";
      return redirect($url);
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
         $user_check= Auth::user();
        
      $modal=new allsprint();
        $modal->sprint_name=$request->input('sprint_name');
        $modal->duration=$request->input('duration');
        $modal->start_date=$request->input('start_date');
        $modal->end_date=$request->input('end_date');
        $modal->sprint_goal=$request->input('sprint_goal');
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
   
      public function create_sprint(){
         die('gfgg');
      $project_data = project::where('id',$request->id)->first();
      $drop_down_data = project::orderBy('id', 'DESC')->get();
        
        
      }

     
}