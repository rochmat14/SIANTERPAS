<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class AdminAuthenticate
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
        if (!Auth::check()){

            // $url_home = LaravelLocalization::getCurrentLocale().'/';
            $url_home = '/';
            return redirect($url_home);

        } else {

            $user = Auth::user();

            if ($user->status == 0) {
                Auth::logout();
                $url_home = LaravelLocalization::getCurrentLocale().'/';
                return redirect($url_home);

            }
            
            if (
                $user->hasRole('Superadministrator') || 
                $user->hasRole('SU') ||
                $user->hasRole('Finance') ||
                $user->hasRole('Account Manager') ||
                $user->hasRole('Admin Konten') ||
                $user->hasRole('Members') 
            ) {

                return $next($request);

            } else {

                Auth::logout();
                $url_home = LaravelLocalization::getCurrentLocale().'/';
                return redirect($url_home);

            }
        }
    }
}
