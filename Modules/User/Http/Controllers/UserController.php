<?php
namespace Modules\User\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Auth;
use Modules\User\Entities\User;
use Modules\User\Entities\Usersdata;
use Modules\Projects\Entities\Project;
use Modules\Projects\Entities\Issue;
use Modules\User\Entities\Role;
use Modules\User\Entities\AssignProjects;
use Redirect;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

   // public function index()
   // {
   //     return view('user::index');  
   // } 

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::create');
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('user::show');
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('user::edit');
    }
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function dashbaord(Request $request)
    {  
        
        if ($request->isMethod('get'))
        {
            
            $user_auth = Auth::user();
            $tasks = Auth::user()->id;
            $profiledata = usersdata::where('user_id',$tasks)->first();
            
            if($user_auth->user_role==5)
            {
                return view('user::admin.dashboard',compact('user_auth','profiledata')); 
            } 
            elseif($user_auth->user_role==6)
            {
                return view('user::ceo.dashboard',compact('user_auth','profiledata'));  
            } 
            elseif($user_auth->user_role==7)
            {
                return view('user::cto.dashboard',compact('user_auth','profiledata'));  
            } 
       
        }        
     }


    public function addUser(Request $request)
    {
      
        if ($request->isMethod('get'))
        {

            $user_auth = Auth::user();
            $role=Role::where('status',0)->get();
            if($user_auth->user_role==5)
            {
                return view('user::admin.user',compact('user_auth','role')); 

            }
            elseif($user_auth->user_role==6)
            {
                return view('user::ceo.user',compact('user_auth','role')); 
            }
            elseif($user_auth->user_role==7)
            {
                return view('user::cto.user',compact('user_auth','role')); 
            }
                

        }  

    }

    public function userlist(Request $request)
    {
        
        if ($request->isMethod('get'))
         {
           
            $user_auth = Auth::user();
            $tasks = Auth::user()->id;
            $profiledata = usersdata::where('user_id' , $tasks)->first();

            //$user_list = User::where('user_role','!=',5)
           // ->get();

            $user_list =  DB::table('users') 
            ->select('users.*','role.name as role') 
            ->join('role','role.id','=','users.user_role')  
            ->where('user_role','!=',5)
            ->orderBy('users.id', 'DESC')
            ->get(); 
            
            if($user_auth->user_role==5)
            {   
                return view('user::admin.userlist')->with(compact('user_list','user_auth','profiledata')); 
            }
            elseif($user_auth->user_role==6)
            {  
                return view('user::ceo.userlist')->with(compact('user_list','user_auth','profiledata')); 
            }
            elseif($user_auth->user_role==7)
            {     
                return view('user::cto.userlist')->with(compact('user_list','user_auth','profiledata')); 
            }


        }
   
    }

    public function project_issues(Request $request)
    {  
      
           
        if ($request->isMethod('get'))
         {
            $data_user = Auth::user();
            $project_data = Project::where('id',$request->id)->first();
            $issues = Issue::orderBy('id', 'ASC')->get();  
            return view('user::admin.issues', compact('project_data','issues','data_user'));
         }   
  
    }

    public function issue_edit(Request $request)
    {
        if ($request->isMethod('post'))
        {

                $id = $request->id;
                $name = $request->name; 
                $eSummary = $request->eSummary; 
                $eDescription = $request->eDescription; 
            
                $validator = Validator::make($request->all(),[
                    'name' => 'required',
                    'eSummary'=>'required',
                    'eDescription'=>'required'
                ]); 

                if ($validator->fails())
                {  
                    return Redirect::back()->withErrors($validator)->withInput();
                }  
                    
                $res = Issue::where('id',$id)
                ->update([
                "issue_type"=> $name,
                "summary" =>$eSummary,
                "description"=>$eDescription
                ]); 

                Session::flash('message', 'Issue Update Successfully'); 
                Session::flash('alert-class', 'alert-success');

                return Redirect::back(); 


        }

    }

   
   public function update_issue(Request $request)
   {

    if ($request->isMethod('post'))
    {

        $id = $request->issue_id;
        $name = $request->issue_name; 
     
         $validator = Validator::make($request->all(),[
            'issue_name' => 'required'
         ]); 

         if ($validator->fails())
         {  
            return Redirect::back()->withErrors($validator)->withInput();
         }  
            
         $res = Sprint_Issue::where('id',$id)
         ->update([
          "issue_name"=> $name
         ]); 
         
         return Redirect::back()->with('message','Sprint Update Successfully'); 

    }
   
   }


    public function admin_info(Request $request)
    {
         $user_auth = Auth::user();
         $tasks = Auth::user()->id;
         $profiledata = usersdata::where('user_id' , $tasks)->first();
         $user_list = User::where('user_role','=',5)
         ->get();

         return view('user::ceo.adminlist')->with(compact('user_list','user_auth','profiledata')); 
    }

    public function user_edit(Request $request)
    { 
         if ($request->isMethod('get'))
         {
                $user_auth = Auth::user();
                $user_data = User::where('id',$request->id)
                ->first();

                $url_link ='http://localhost/management/storage/app/public/images';


                if($user_auth->user_role==5)
                {
                    return view('user::admin.edit_user')->with(compact('user_data','user_auth','url_link'));
                }
                elseif($user_auth->user_role==6)
                {
                    return view('user::ceo.edit_user')->with(compact('user_data','user_auth','url_link'));
                }
                elseif($user_auth->user_role==7)
                {
                    return view('user::cto.edit_user')->with(compact('user_data','user_auth','url_link'));
                }

        }
    
    }

    public function edit_user(Request $request)
    {
         
        if ($request->isMethod('post'))
        {  
            $user_auth = Auth::user();

            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'edit_id' => 'required', 
                'user_role'=>'required', 
            ]);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            if ($request->hasFile('edit_image')) 
            {
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
            
            if($user_id){

                $update_filed = array(
                'name'=>$name,
                'user_role'=>$user_role,
                );

                $update_value = array_merge($update_filed,$image_array);
                $data=  User::where('id',$user_id)->update($update_value);

                if($data)
                {  
                    
                    if($user_auth->user_role==5)
                    {
                      return redirect('admin/userlist')->with('message', 'Update Successfully');   
                    }
                    elseif($user_auth->user_role==6)
                    {
                        return redirect('ceo/userlist')->with('message', 'Update Successfully');
                    } 
                    elseif($user_auth->user_role==7)
                    {
                        return redirect('cto/userlist')->with('message', 'Update Successfully');
                    } 
                }
                else
                {  
                   
                    if($user_auth->user_role==5)
                    {
                        return redirect('admin/userlist');  
                    }
                    elseif($user_auth->user_role==6)
                    {
                        return redirect('ceo/userlist');  
                    } 
                    elseif($user_auth->user_role==7)
                    {
                        return redirect('cto/userlist');  
                    }  
                }

            }

       }

    }

    public function  index(Request $request){

        if ($request->isMethod('post'))
        { 
              
               
                $user_auth = Auth::user();
                $validator = Validator::make($request->all(),[
                'name' => 'required',
                'password' => 'min:6', 
                'password_confirmation' => 'required_with:password|same:password|min:6',
                'email' => 'required|email|unique:users',
                'user_role'=>'required', 
                'image' => 'image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048',
                ]);  
        
              

                if($validator->fails())
                {
                   // die('error');
                    
                    if($user_auth->user_role==5)
                    {
                            return redirect('admin/user')
                            ->withErrors($validator)
                            ->withInput();  
                    }
                    elseif($user_auth->user_role==6){
                        return redirect('ceo/user')
                        ->withErrors($validator)
                        ->withInput();  
                    } 
                    elseif($user_auth->user_role==7){
                        return redirect('cto/user')
                        ->withErrors($validator)
                        ->withInput();  
                    }        
                }
                else
                {

                    if($request->hasFile('image')) 
                    {
                    
                        $image_name = $this->getFileName($request->image);
                        $request->image->move(base_path('public/images'), $image_name);
    
                    // $image = $request->file('image'); 
                    // $image_name = rand() . '.' . $image->getClientOriginalExtension();
                    // Storage::disk('public')->putFileAs('images', $request->file('image'), $image_name);
                    }
                    else
                    {
                        $image_name=null; 
                    }
                     
                    $user_name = $request->name;
                    $email = $request->email;
                    $user_role = $request->user_role;
                    $password = $request->password;
                    $hashed = Hash::make($password);
            
                    $data = array(
                            'name'=> $user_name , 
                            'email' => $email,
                            'user_role'=> $user_role , 
                            'password' => $hashed,
                            'image'=>$image_name
                    );
    
                    $data_val = User::insert($data);
    
                    if($data_val)
                    { 
                        if($user_auth->user_role==5)
                        {
                            return redirect('admin/user')->with('message', 'Thanks for registering!'); 
                        }
                        elseif($user_auth->user_role==6)
                        {
    
                        return redirect('ceo/user')->with('message', 'Thanks for registering!'); 
    
                        }  
                        elseif($user_auth->user_role==7)
                        {
                            return redirect('cto/user')->with('message', 'Thanks for registering!'); 
                        }      
                    }

                }
             

               

         } 
    }

    public function view(Request $request)
    { 

        if ($request->isMethod('get'))
        {
            
                $user_auth = Auth::user();  
                $user_data = User::where('id',$request->id)->first();
                $url_link = env("APP_URL").'/management/storage/app/public/images';  

                $project_list =  DB::table('project')
                ->select('*')
                ->orderBy('name', 'ASC')
                ->get();


                $assignProjects = AssignProjects::where('assign_to',$request->id)->get();
                $project_assign_id=array();

                foreach($assignProjects as $k => $assign_pro_id)
                {
                   
                     $project_assign_id [] .= $assign_pro_id->project_id;
                   
                }
          
        
                if($user_auth->user_role==5)
                {

                    return view('user::admin.view')->with(compact('user_data','url_link','user_auth','project_list','project_assign_id')); 
                }
                elseif($user_auth->user_role==6)
                {
                    return view('user::ceo.view')->with(compact('user_data','url_link','user_auth','project_list','project_assign_id')); 

                }
                elseif($user_auth->user_role==7)
                {
                    return view('user::cto.view')->with(compact('user_data','url_link','user_auth','project_list','project_assign_id')); 

                }
                elseif($user_auth->user_role==1)
                {
                    return view('user::tl.view')->with(compact('user_data','url_link','user_auth','project_list','project_assign_id')); 

                }
         }

    }

    public function assign_project(Request $request)
    {
        // echo'<pre>';
        // print_r($request->all());
        // die();
        $method = $request->method();

        $user_auth = Auth::user();  

     
        //$user_auth = Auth::user();  
        if ($request->isMethod('post'))
        {

            $id = $request->id;
            $assign_project = $request->assign_project; 

          
            $validator = Validator::make($request->all(),[
                'assign_project' => 'required' 
             ]);
             
             if($validator->fails())
             {
                return Redirect::back()->withErrors($validator)->withInput(); 
             }
             
            

            foreach($assign_project as $project_id)
            {

                $check = AssignProjects::where(['project_id'=>$project_id,'assign_to'=>$id])->count();

                if($check < 1){

                    $assignProjects = new AssignProjects(); 
                    $assignProjects->assign_by = $user_auth->id;  // assign by login  user
                    $assignProjects->assign_to = $id; // assign user id
                    $assignProjects->project_id = $project_id;
                    $assignProjects->status = 0;
                    $assignProjects->save();

                } 
              
            }

        
              Session::flash('message', 'Assign Project Successfully'); 
              Session::flash('alert-class', 'alert-success');
              return Redirect::back();



        }

    }


    public function delete(Request $request)
    {
        if($request->id)
        { 
            $deleteval = User::find($request->id)->delete();
            if($deleteval)
            {  
                $user_auth = Auth::user();  
                if($user_auth->user_role==5)
                {
                  return redirect('admin/userlist')->with('message', 'Delete Successfully'); 
                }
                elseif($user_auth->user_role==6){
                    return redirect('ceo/userlist')->with('message', 'Delete Successfully');   
                }
                elseif($user_auth->user_role==7){
                    return redirect('cto/userlist')->with('message', 'Delete Successfully');   
                }  
            } 
        }
    } 


//  ========================START R-DEV ========================

    public function profile()
    { 
        $task = Auth::user();
        $tasks = Auth::user()->id;
        $profiledata = usersdata::where('user_id' , $tasks)->first();

        return view('user::profile.profile',compact('task','profiledata'));
    }


    public function user_job_title(Request $request){

    $title = $_POST["job_title"];
    $user_id = Auth::user()->id;
    $processexist = usersdata::select('*')->where('user_id', $user_id)->first();
        if($processexist == null)
    {

    $processes = usersdata::create([
            'user_id'   => $user_id,
            'job_title' => $title,
            'your_department' => '',
            'your_organisation' => '',
            'your_location' => '',
            'image' => '',
        ]); 
    return response()->json(['status' => 'true', 'message' => 'job_title added successfully!']);


    }
    else
    {
    $processes = usersdata::where('user_id', $user_id)->update([
        'job_title' =>$title,
    ]);
    return response()->json(['status' => 'true', 'message' => 'job_title updated successfully!']);
    }
    }

    public function your_department(Request $request){

    $your_department = $_POST["your_department"];
    $user_id = Auth::user()->id;
    $processexist = usersdata::select('*')->where('user_id', $user_id)->first();

    if($processexist == null)
    {
    $processes = usersdata::create([
            'user_id'   => $user_id,
            'job_title' => '',
            'your_department' => $your_department,
            'your_organisation' => '',
            'your_location' => '',
            'image' => '',
        ]);
        return response()->json(['status' => 'true', 'message' => 'your department added successfully!']);

    }
    else
    {
    $processes = usersdata::where('user_id', $user_id)->update([
        'your_department' =>$your_department,
    ]);
    return response()->json(['status' => 'true', 'message' => 'your department updated successfully!']);

    }
    }

    public function your_organisation(Request $request)
    {

        $your_organisation = $_POST["your_organisation"];
        $user_id = Auth::user()->id;
        $processexist = usersdata::select('*')->where('user_id', $user_id)->first();
            if($processexist == null)
        {
        $processes = usersdata::create([
                'user_id'   => $user_id,
                'job_title' => '',
                'your_department' => '',
                'your_organisation' => $your_organisation,
                'your_location' => '',
                'image' => '',
            ]);
            return response()->json(['status' => 'true', 'message' => 'your organisation added successfully!']); 
        }
        else
        { 
            
        $processes = usersdata::where('user_id', $user_id)->update([
            'your_organisation' =>$your_organisation,
        ]);
        return response()->json(['status' => 'true', 'message' => 'your organisation updated successfully!']);

        }
    
    }

    public function your_location(Request $request){

    $your_location = $_POST["your_location"]; 
    $user_id = Auth::user()->id;
    $processexist = usersdata::select('*')->where('user_id', $user_id)->first();
        if($processexist == null)
    {
    $processes = usersdata::create([
            'user_id'   => $user_id,
            'job_title' => '',
            'your_department' => '',
            'your_organisation' => '',
            'your_location' => $your_location,
            'image' => '',
        ]);
        return response()->json(['status' => 'true', 'message' => 'your location added successfully!']); 
    }
    else
    {
    $processes = usersdata::where('user_id', $user_id)->update([
        'your_location' =>$your_location,
    ]);
    return response()->json(['status' => 'true', 'message' => 'your location updated successfully!']);


    }
    }

    public function save(Request $request)
    {
        $user_id = Auth::user()->id;
        $userexist = usersdata::select('*')->where('user_id', $user_id)->first();
        if($userexist == null){
        if ($files = $request->file('image')) {
            
            $fileName =  "image-".time().'.'.$request->image->getClientOriginalExtension();
            $request->image->storeAs('image', $fileName);
            
            $image = new usersdata;
            $image->image = $fileName;
            $image->user_id = $user_id;
            $image->job_title = '';
            $image->your_department = '';
            $image->your_organisation = '';
            $image->your_location = '';
            $image->save();

        
        
        } 
        return response()->json(['status' => 'true', 'message' => 'Profile Image added successfully!']);
    }else{

        if ($files = $request->file('image')) 
        {
            
            $fileName = time().'.'.$request->image->getClientOriginalExtension();
            $files->move('user/images/',$fileName); 
        }

        $results = usersdata::where('user_id',$user_id)->update([
        'image' =>  $fileName,
    ]);
        return response()->json(['status' => 'true', 'message' => 'Profile Image updated successfully!']);


    }

    }

    public function manageprofile(){

    $task = Auth::user();
    $tasks = Auth::user()->id;
    $profiledata = usersdata::where('user_id' , $tasks)->first();

    return view('user::profile.manage',compact('task','profiledata'));
    }

    public function security()
    {

     return view('user::profile.Security');

    }

    public function changePassword(Request $request)
    {
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|string|min:6|confirmed',
        'password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password does not match!');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password successfully changed!');

    }

    public function profileEmail(){

    $userdata = Auth::user();

    return view('user::profile.email',compact('userdata'));
    }

    public function teamleader(Request $request)
    {

        if ($request->isMethod('get'))
        { 
            $user_auth = Auth::user();
            $tasks = Auth::user()->id;
            $profiledata = usersdata::where('user_id' , $tasks)->first();
            // $user_list = User::where('user_role','=',1)
            // ->get();

            $user_list =  DB::table('users') 
            ->select('users.*','role.name as role') 
            ->join('role','role.id','=','users.user_role')  
            ->where('user_role','=',1)
            ->orderBy('users.id', 'DESC')
            ->get(); 
            
            if($user_auth->user_role==5)
            {
                return view('user::admin.userlist')->with(compact('user_list','user_auth','profiledata')); 
            }
            elseif($user_auth->user_role==6)
            {
                return view('user::ceo.userlist')->with(compact('user_list','user_auth','profiledata')); 
            }
            elseif($user_auth->user_role==7)
            {
                return view('user::cto.userlist')->with(compact('user_list','user_auth','profiledata')); 
            }
         }   
    }

    public function employeelist(Request $request){

        if ($request->isMethod('get'))
        { 
                $user_auth = Auth::user();
                $tasks = Auth::user()->id;
                $profiledata = usersdata::where('user_id' , $tasks)->first();
                // $user_list = User::where('user_role','=',2)
                // ->get();

                 $user_list =  DB::table('users') 
                 ->select('users.*','role.name as role') 
                 ->join('role','role.id','=','users.user_role')  
                 ->where('user_role','=',2)
                 ->orderBy('users.id', 'DESC')
                  ->get(); 

                if($user_auth->user_role==5)
                {
                  return view('user::admin.userlist')->with(compact('user_list','user_auth','profiledata')); 
                }
                elseif($user_auth->user_role==6){
                    return view('user::ceo.userlist')->with(compact('user_list','user_auth','profiledata')); 
                }
                elseif($user_auth->user_role==7){
                    return view('user::cto.userlist')->with(compact('user_list','user_auth','profiledata')); 
                }
        }   

    }
   public function managerlist(Request $request)
   {
     
    if ($request->isMethod('get'))
    { 
        $user_auth = Auth::user();
        $tasks = Auth::user()->id;
        $profiledata = usersdata::where('user_id' , $tasks)->first();

        // $user_list = User::where('user_role','=',3)
        // ->get();

        $user_list =  DB::table('users') 
            ->select('users.*','role.name as role') 
            ->join('role','role.id','=','users.user_role')  
            ->where('user_role','=',3)
            ->orderBy('users.id', 'DESC')
            ->get(); 

        if($user_auth->user_role==5)
        {
           return view('user::admin.userlist')->with(compact('user_list','user_auth','profiledata')); 
        }
        elseif($user_auth->user_role==6){
           return view('user::ceo.userlist')->with(compact('user_list','user_auth','profiledata'));  
        }
        elseif($user_auth->user_role==7){
            return view('user::cto.userlist')->with(compact('user_list','user_auth','profiledata'));  
         }
    }
}

    public function hrlist(Request $request)
    {
        
        if ($request->isMethod('get'))
        { 

            $user_auth = Auth::user();
            $tasks = Auth::user()->id;
            $profiledata = usersdata::where('user_id' , $tasks)->first();
            
            // $user_list = User::where('user_role','=',4)
            // ->get();

            $user_list =  DB::table('users') 
            ->select('users.*','role.name as role') 
            ->join('role','role.id','=','users.user_role')  
            ->where('user_role','=',4)
            ->orderBy('users.id', 'DESC')
            ->get(); 


            if($user_auth->user_role==5)
            {
               return view('user::admin.userlist')->with(compact('user_list','user_auth','profiledata')); 
            }
            elseif($user_auth->user_role==6)
            {

                return view('user::ceo.userlist')->with(compact('user_list','user_auth','profiledata')); 
            }
            elseif($user_auth->user_role==7)
            {
                return view('user::cto.userlist')->with(compact('user_list','user_auth','profiledata')); 
            }
        }
    }

    public  function role(Request $request)
    {  
  
      if ($request->isMethod('get'))
      {
      
  
        $role = DB::table('role')->orderBy('id', 'DESC')->get();
        $user_auth = Auth::user();   

        if($user_auth->user_role==5)
        {
           return view('user::admin.role', compact('user_auth','role'));
        }
        elseif($user_auth->user_role==6)
        {
            return view('user::ceo.role', compact('user_auth','role'));
        } 
        elseif($user_auth->user_role==7)
        {
            return view('user::cto.role', compact('user_auth','role'));
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



   

 //======================== END ==============================


}