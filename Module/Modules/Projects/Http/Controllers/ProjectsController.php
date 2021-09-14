<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProjectsController extends Controller
{
 
    public function index() 
    {
        return view('projects::index');    
    }

    public function scrum_template(){

        return view('projects::scrum_template');   

    }

    public function team_management()
    {
        return view('projects::team_management');  
    }

    public function company_management()
    {
      
        return view('projects::company_management');  
    } 
    public function slug()
    {
        $string='addd13';
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));

        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );

    }

 
}
