<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use DB;
use Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;

class UsersContollerRole extends Controller
{

    
    public function __construct()
    {
   
          
    }
    

     public function  index(Request $request)
     {
           
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'password' => 'min:6', 
            'password_confirmation' => 'required_with:password|same:password|min:6',
            'email' => 'required|email|unique:users',
            'user_role'=>'required', 
            'image' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048',
        ]);
      
        if ($request->hasFile('image')) {
            
            $image = $request->file('image');
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('images', $request->file('image'), $image_name);
        
        }
       
        if ($validator->fails()){

            return redirect('user')
            ->withErrors($validator)
            ->withInput();  
        }

       
         $user_name=$request->name;
         $email=$request->email;
         $user_role=$request->user_role;
         $password=$request->password;
         $hashed = Hash::make($password);
         
         $data = DB::table('users')->insert(
            array(
                   'name'=> $user_name , 
                   'email' => $email,
                   'user_role'=> $user_role , 
                   'password' => $hashed,
                   'image'=>$image_name
            )
        );

        if($data)
        {  
            return redirect('user')->with('message', 'Thanks for registering!');    
        }
       
     }

     public function addUser()
     {
        return view('admin.user');  
     }

     public  function admindashboard()
     {
         die('admin dashboard');   
      
     }

     public function userlist(Request $request) 
     {  
        $user_list = DB::table('users')
        ->select('*')
        ->where('user_role','!=',5)
        ->get();  
        
        return view('admin.userlist')->with(compact('user_list'));   

     } 
       
     public function user_edit(Request $request)
     { 
      
 
        $user_data = DB::table('users')
        ->select('*')
        ->where('id',$request->id)
        ->first(); 

        $url_link ='http://localhost/management/storage/app/public/images';

        return view('admin.edit_user')->with(compact('user_data','url_link'));

     }

     public function edit_user(Request $request)
     {
       
     

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'edit_id' => 'required', 
            'user_role'=>'required', 
        ]);
       

        if ($validator->fails()){

            return Redirect::back()->withErrors($validator)->withInput();

        }
       
        if ($request->hasFile('edit_image')) {
            
            $image = $request->file('edit_image');
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('images', $request->file('edit_image'), $image_name);
        
            $image_array=array('image'=>$image_name);
        
        }
        else
        {
            $image_array=array(); 
        }
       
    
        $user_id= $request->edit_id;
        $name= $request->name;
        $user_role= $request->user_role;
         
        if($user_id)
        { 
           
           $update_filed = array(
                'name'=>$name,
                'user_role'=>$user_role,
           );

          $update_value = array_merge($update_filed,$image_array);

         $data= DB::table('users')
         ->where('id',$user_id)
         ->update($update_value);
      
      
         if($data)
         {  
            return redirect('userlist')->with('message', 'Update Successfully');    
         }
         else
         {
            return redirect('userlist');    
         }

       }

     }


     public function  view(Request $request)
     {  
       
         $user_data = DB::table('users')
         ->select('*')
         ->where('id',$request->id)
         ->first(); 

         $url_link ='http://localhost/management/storage/app/public/images';

         return view('admin.view')->with(compact('user_data','url_link')); 


     }



}
