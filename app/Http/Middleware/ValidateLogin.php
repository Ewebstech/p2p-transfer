<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class ValidateLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //if(!isset($_SESSION)) session_start();
        if(!isset($_SESSION)) { session_start(); }
        if(!isset($_SESSION['UserDetails'])){
            
            $_SESSION['PreviousUrl'] = basename($_SERVER['PHP_SELF']); 
            return redirect('/login?cont');
        } else {
            return $next($request);
        }
        return $next($request);
       
    
        
    }
}

