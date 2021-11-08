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
use Modules\Projects\Entities\category;
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

<<<<<<< HEAD
=======


>>>>>>> 8c0573abee867242d94474b16e14c5663139a2a8
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

      $categorys = category::get();
      $project_data = Project::where('id',$request->id)->first();
      $drop_down_data = Project::orderBy('id', 'DESC')->get();
      $project_id = $request->id;
      $single_project = 'single_project';
      return view("projects::project_settngs", compact('drop_down_data','project_data', 'project_id','single_project','categorys'));
    
     }
     public function project_details(Request $request)
     {
      
  
   }
  
  public function project_photo_save(Request $request)
<<<<<<< HEAD
  {
      $title = $_POST["description"];
  
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
                  $request->image->storeAs('image', $fileName);
                }
  
              $results = Project::where('id',$project_id)->update([
              'image' =>  $fileName,
              'Description' => $title,
  
            ]);
              return response()->json(['status' => 'true', 'message' => 'Profile Image updated successfully!']);
  
     }
      }
=======
{
    $name = $_POST["name"];
    $key = $_POST["key"];
    $description = $_POST["description"];

     $project_id = $request->project_id;

         $userexist = Project::select('*')->where('id', $project_id)->first();
          if($userexist == null){

          
        if ($files = $request->file('image')) {
            
             $fileName = time().'.'.$request->image->getClientOriginalExtension();
                $files->move('user/images/',$fileName);
            
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
   

>>>>>>> 8c0573abee867242d94474b16e14c5663139a2a8
}