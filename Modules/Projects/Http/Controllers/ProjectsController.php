<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Usersdata;
use Modules\User\Entities\User;
use Modules\Projects\Entities\Project;
use Modules\Projects\Entities\category;
use Validator;
use Redirect;
use DB;
use Auth;
class ProjectsController extends Controller
{
   
    public function index() 
    {
        return view('projects::index');    
    }

    public function scrum_template(){

        return view('projects::admin.scrum_template');   

    }

    public function team_management()
    {
        return view('projects::admin.team_management');  
    }

    public function company_management()
    {
      
        return view('projects::admin.company_management');  
    } 
    public function slug(Request $request)
    {
      
        $divider = '-';

        $text=$request->name ;

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
        
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:project',
            'key' => 'required',
        ]);
       
         
        if ($validator->fails()){
 
            return Redirect::back()->withErrors($validator)->withInput();
 
        }

       $user_check= Auth::user();
     
       $name= $request->name;
       $key= $request->key;
       $template= $request->template;
       $project_type= $request->project_type;
      
    
        $data = DB::table('project')->insert(
            array(
                   'name'=> $name, 
                   'key' => $key,
                   'createby'=> $user_check['id'] , 
                   'template' => $template,
                   'project_type'=>$project_type
            )
        );
        $lastId=DB::getPdo()->lastInsertId();

        if($data)
        {  
            return Redirect('admin/project/company/'.$lastId);    
        }


    } 
    

    public function team_management_insert(Request $request)
    {
   
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:project',
            'key' => 'required',
        ]);
         
         
        if ($validator->fails()){
 
            return Redirect::back()->withErrors($validator)->withInput();
 
        }

       $user_check= Auth::user();
       $name= $request->name;
       $key= $request->key;
       $template= $request->template;
       $project_type= $request->project_type; 
      
    
        $data = DB::table('project')->insert(
            array(
                   'name'=> $name, 
                   'key' => $key,
                   'createby'=> $user_check['id'] , 
                   'template' => $template,
                   'project_type'=>$project_type
            )
        ); 
        $lastId=DB::getPdo()->lastInsertId();
     

        if($data)
        {  
            
            return Redirect('admin/project/team/'.$lastId);    
        }
 
    } 
    
    public function information()
    { 
        $tasks = Auth::user()->id;
        $profiledata = usersdata::where('user_id' , $tasks)->first();
        $project_list =  DB::table('project')
       ->select('project.*','users.name as username')
       ->join('users','users.id','=','project.createby')
       ->orderBy('project.id', 'DESC')
       ->get();
       
       
        return view('projects::admin.datatable',compact('profiledata'))->with('project_list',$project_list);  

    }
    public function view(Request $request){ 
        $project_data = Project::where('id',$request->id)->first();
        // echo '<pre>';
        // print_r($project_data);
        // die();
        $user_auth = Auth::user();  
        $user_data = User::where('id',$request->id)->first();
        $url_link = env("APP_URL").'/management/storage/app/public/images';
        return view('projects::admin.view')->with(compact('user_data','url_link','user_auth','project_data')); 
    }

    public function project_settngs(Request $request){

        $data_user = Auth::user();
        $categorys = category::get();
        $project_data = Project::where('id',$request->id)->first();
        $drop_down_data = Project::orderBy('id', 'DESC')->get();
        $project_id = $request->id;
        //$single_project = 'single_project';
        return view("projects::admin.project_settngs", compact('drop_down_data','project_data', 'project_id','categorys','data_user'));
      
       }
    public function project_photo_save(Request $request)
    {
        
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
   

    public function delete(Request $request){
        if($request->id)
        {
            $deleteval = Project::find($request->id)->delete();
            if($deleteval)
            {
                return redirect('admin/project/information')->with('message', 'Delete Successfully');  
            } 
        }
    } 

 
}
