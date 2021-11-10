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
        $user_auth = Auth::user();
        $tasks = Auth::user()->id;
        $profiledata = usersdata::where('user_id' , $tasks)->first();
        return view('user::admin.dashboard',compact('user_auth','profiledata'));        
    }

    public function addUser(Request $request){
        $user_auth = Auth::user();
        return view('user::admin.user',compact('user_auth'));   
    }

    public function userlist(Request $request){
         $user_auth = Auth::user();
         $tasks = Auth::user()->id;
         $profiledata = usersdata::where('user_id' , $tasks)->first();
        $user_list = User::where('user_role','!=',5)
        ->get();
       return view('user::admin.userlist')->with(compact('user_list','user_auth','profiledata')); 
    }

    public function user_edit(Request $request){ 
        $user_auth = Auth::user();
        $user_data = User::where('id',$request->id)
        ->first();
       $url_link ='http://localhost/management/storage/app/public/images';
       return view('user::admin.edit_user')->with(compact('user_data','user_auth','url_link'));
    }

    public function edit_user(Request $request){
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
       }else{
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
           return redirect('admin/userlist')->with('message', 'Update Successfully');    
        }else{  
           return redirect('admin/userlist');    
        }

      }
    }

    public function  index(Request $request){

        $validator = Validator::make($request->all(),[
           'name' => 'required',
           'password' => 'min:6', 
           'password_confirmation' => 'required_with:password|same:password|min:6',
           'email' => 'required|email|unique:users',
           'user_role'=>'required', 
           'image' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048',
        ]);
        
        if($request->hasFile('image')) {
           $image = $request->file('image');
           $image_name = rand() . '.' . $image->getClientOriginalExtension();
           Storage::disk('public')->putFileAs('images', $request->file('image'), $image_name);
        }

        if($validator->fails()){
           return redirect('admin/user')
           ->withErrors($validator)
           ->withInput();  
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

        if($data_val){ 
          return redirect('admin/user')->with('message', 'Thanks for registering!');    
        }
    }

    public function view(Request $request){ 
        $user_auth = Auth::user();  
        $user_data = User::where('id',$request->id)->first();
        $url_link = env("APP_URL").'/management/storage/app/public/images';
        return view('user::admin.view')->with(compact('user_data','url_link','user_auth')); 
    }

    public function delete(Request $request){
        if($request->id)
        {
            $deleteval = User::find($request->id)->delete();
            if($deleteval)
            {
                return redirect('admin/userlist')->with('message', 'Delete Successfully');  
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

    public function your_organisation(Request $request){

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

        if ($files = $request->file('image')) {
            
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

    public function teamleader(Request $request){
        $user_auth = Auth::user();
        $tasks = Auth::user()->id;
        $profiledata = usersdata::where('user_id' , $tasks)->first();
    $user_list = User::where('user_role','=',1)
    ->get();
    return view('user::admin.userlist')->with(compact('user_list','user_auth','profiledata')); 
    }

    public function employeelist(Request $request){
        $user_auth = Auth::user();
        $tasks = Auth::user()->id;
        $profiledata = usersdata::where('user_id' , $tasks)->first();
       $user_list = User::where('user_role','=',2)
       ->get();
      return view('user::admin.userlist')->with(compact('user_list','user_auth','profiledata')); 
   }
   public function managerlist(Request $request){
    $user_auth = Auth::user();
    $tasks = Auth::user()->id;
    $profiledata = usersdata::where('user_id' , $tasks)->first();
   $user_list = User::where('user_role','=',3)
   ->get();
  return view('user::admin.userlist')->with(compact('user_list','user_auth','profiledata')); 
}
    public function hrlist(Request $request){
        $user_auth = Auth::user();
        $tasks = Auth::user()->id;
        $profiledata = usersdata::where('user_id' , $tasks)->first();
    $user_list = User::where('user_role','=',4)
    ->get();
    return view('user::admin.userlist')->with(compact('user_list','user_auth','profiledata')); 
    }
    



   

 //======================== END ==============================


}