<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
        $project_list =  DB::table('project')
       ->select('project.*','users.name as username')
       ->join('users','users.id','=','project.createby')
       ->orderBy('project.id', 'DESC')
       ->get();
       
       
        return view('projects::admin.datatable')->with('project_list',$project_list);  

    }

 
}
