<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MemberAuth
{
    // public function handle($request, Closure $next)
    // {
    //     // Periksa apakah user sudah login dan memiliki role 'members'
    //     if (Auth::check() && Auth::user()->hasRole('Members')) {
    //         return $next($request);
    //     }

    //     // Redirect ke halaman login atau error jika tidak memenuhi
    //     return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    // }

    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();

        if (!$user->hasRole('Members')) {
            Auth::logout();
            return redirect('/');
        }

        return $next($request);
    }
}
