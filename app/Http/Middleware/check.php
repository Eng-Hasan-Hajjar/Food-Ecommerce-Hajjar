<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class check
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
       $auth =auth('resturant')->user();
       if($auth ==null ){
            return $next($request);
        }
        else{
            return redirect()->back();

        }
    }
}
