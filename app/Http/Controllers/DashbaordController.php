<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashbaordController extends Controller
{
    public function __construct()
    {
     
          
    }
    public function index(Request $request)
    {
      
        $role=check_user();

        if(!empty($role))
        { 
              
            if($role['user_role']==1)
            {
                return redirect('team_leader/dashbaord'); 
            }
            elseif($role['user_role']==2)
            {
                return redirect('employee/dashbaord');
            }
            elseif($role['user_role']==3)
            {
                return redirect('manager/dashbaord');
            } 
            elseif($role['user_role']==4)
            {
                return redirect('hr/dashbaord');
            }
            elseif($role['user_role']==5)
            {
                return redirect('admin/dashbaord');
            }
            elseif($role['user_role']==6)
            {
                return redirect('ceo/dashbaord');   
            } 
            elseif($role['user_role']==7)
            {
                return redirect('cto/dashbaord');   
            }  
            elseif($role['user_role']==8)
            {   
                return redirect('admin/dashbaord');   
            } 
            elseif($role['user_role']==9)
            {
                return redirect('admin/dashbaord');   
            } 

        }
        else
        {   
            return redirect('/');
        }

       
    } 
}
