<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard){

            case 'admin':
                if (Auth::guard('admin')->check()) {
                    return redirect('admin');
                }
                break;
                case 'resturant':
                if (Auth::guard('resturant')->check()) {
                    return redirect('resturant');
                }
                break;
            default:
                if (Auth::guard('web')->check()) {
                    return redirect('/');
                }
                break;
        }


        return $next($request);
    }
}
