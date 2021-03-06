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
class ProjectsController extends Controller
{

 

    public function slug(Request $request){ 
      $divider = '-';
      $text = $request->name ;
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

   
    
}