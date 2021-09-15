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
    public function slug()
    {
        
        $num = str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);

        return response()->json(
            [
                'success' => true,
                'message' => $num
            ]
        );

    }


    public function company_management_insert(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
            'name' => 'required',
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


        if($data)
        {  
            return Redirect::back()->with('message', 'Thanks for Project registering!');    
        }


    }

    public function team_management_insert(Request $request)
    {
   
        $validator = Validator::make($request->all(),[
            'name' => 'required',
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


        if($data)
        {  
            return Redirect::back()->with('message', 'Thanks for Project registering!');    
        }
 
    }   

 
}
