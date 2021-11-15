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
use Modules\User\Entities\Role; 

class AdminController extends Controller
{

    public  function role(Request $request)
    {  
  
      if ($request->isMethod('get'))
      {
      
        $data =category::all(); 
        $role = DB::table('role')->where('default',1)->orderBy('id', 'DESC')->get();
        $user_auth = Auth::user(); 
        $project_data = Project::where('id',$request->id)->first();
        $drop_down_data = Project::orderBy('id', 'DESC')->get();
        $project_id = $request->id;  
        $single_project = 'single_project';    
        $category = category::orderBy('id', 'DESC')->get();
        return view('projects::admin.role', compact('single_project','project_data','drop_down_data','project_id', 'category','user_auth','role'));
      
      } 

    }

   
    public function delete_role(Request $request)
    {
      if ($request->isMethod('post'))
      {
         $id = $request->role_id;

         $validator = Validator::make($request->all(),[
          'role_id' => 'required'
        ]); 

        if ($validator->fails())
        {
          return Redirect::back()->withErrors($validator)->withInput();
        }
 
        $res = Role::where('id',$id)->delete();  
        
        if($res==1)
        {
          Session::flash('message', 'Role Delete Successfully !'); 
          Session::flash('alert-class', 'alert-danger'); 

          return Redirect::back();
        }

      }
       
    }


    public function roleAdd(Request $request)
    {
       if ($request->isMethod('post'))
       {
          
          $validator = Validator::make($request->all(),[
            'name' => 'required|unique:role',
            'slug' => 'required'
          ]);

          if ($validator->fails())
          {
            return Redirect::back()->withErrors($validator)->withInput();
          }

          $role = new Role;
          $role->name = $request->name; 
          $role->slug = $request->slug;
          $role->status = 0 ;
          $role->default = 1 ;

          $role->save(); 
           
          Session::flash('message', 'Role Add Successfully !'); 
          Session::flash('alert-class', 'alert-success'); 

          return Redirect::back();

       }


    }




   

}