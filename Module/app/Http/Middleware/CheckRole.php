<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
  
        if(!Auth::user())
        {
           
            return redirect('login');
        }
        else
        {
            if(Auth::user()->isAdmin())
            {
                return $next($request); 
            }
            elseif (Auth::user()->isTeamLeader())
            {
                return $next($request);
            }
            elseif (Auth::user()->isEmployee())
            {
                return $next($request); 
            }
            elseif (Auth::user()->isManager())
            {
                return $next($request); 
            }
            elseif (Auth::user()->isHr())
            {
                return $next($request); 
            }
            else
            { 
                return redirect('login');  
            }
         
           
        }  
        
    }
}
