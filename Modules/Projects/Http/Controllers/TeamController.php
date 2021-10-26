<?php
/* Add Namespace */
namespace Modules\Projects\Http\Controllers;
/* Load Vendors */
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;
use Redirect;
/* Load Models */
use Modules\Projects\Entities\AllSprint;
use Modules\Projects\Entities\Task;
use Modules\Projects\Entities\Project;
use App\Models\User;
/* Load Auth  */
use Auth;

class TeamController extends Controller
{
    public function load_page(Request $request){
      $project_data = Project::where('id',$request->id)->first();
      $drop_down_data = Project::orderBy('id', 'DESC')->get();
      $project_id = $request->id;
      $single_project = 'single_project';
      return view("projects::single", compact('drop_down_data','project_data', 'project_id','single_project'));
    }

   public function backlog_view(Request $request){ 
      $project_id = $request->id;
      $project_data = Project::where('id',$request->id)->first();
      $drop_down_data = Project::orderBy('id', 'DESC')->get();
      $sprint = AllSprint::where('project_id',$project_id)->orderBy('id', 'DESC')->get();
      return view("projects::team.backlog", compact('drop_down_data','project_data', 'project_id','sprint'));
   }

   public function create_issue(Request $request){
      $createdby = Auth::user();
      $project_id = $request->id;
      $sprint = AllSprint::where('project_id',$request->id)->get();
      $project_data = Project::where('id',$request->id)->first();
      $drop_down_data = Project::orderBy('id', 'DESC')->get();
      $employee = User::where('user_role',2)->orderBy('id', 'DESC')->get();
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
       ]);


       if ($validator->fails()){
          return Redirect::back()->withErrors($validator)->withInput();
       }

      $project_id = $request->project_id;
      $createdby = Auth::id();

      // $image = $request->file('file');
      //   $FileName = $image->getClientOriginalName();
      //   $image->move(public_path('images'), $FileName);
    
      $modal = new Task();
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

   public function sprint_view(Request $request){
    $project_id = $request->id;
    $project_data = Project::where('id',$request->id)->first();
    $drop_down_data = Project::orderBy('id', 'DESC')->get();
    return view('projects::team.Sprintview', compact('drop_down_data','project_data', 'project_id'));
   }

  public function project_settngs(Request $request){

    $project_data = Project::where('id',$request->id)->first();
    $drop_down_data = Project::orderBy('id', 'DESC')->get();
    $project_id = $request->id;
    $single_project = 'single_project';
    return view("projects::project_settngs", compact('drop_down_data','project_data', 'project_id','single_project'));
  
   }
}