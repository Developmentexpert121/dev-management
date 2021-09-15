<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class userRoll
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request, Closure $next)
    { 
        $user = Auth::user();  

       

        if (Auth::check())
        {
          
             if(Auth::user()->isAdmin())
             {
                 return $next($request);
             }
        }
     
        return $next($request);


    }
}
