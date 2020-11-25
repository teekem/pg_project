<?php

namespace App\Http\Middleware;

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
      switch ($guard) {
            case 'student':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('student.dashboard');
              }
             
            default:
              if (Auth::guard($guard)->check()) {
                  return redirect('/admin');
              }
              break;
          }
          return $next($request);
    }
    // public function handle($request, Closure $next, $guard = null)
    // {

    //     //  switch ($guard) {
    //     //     case 'student':
    //     //         if (Auth::guard($guard)->check()) {
    //     //         return redirect('stu.dashboard');
    //     //             }
    //     //         break;

    //     //     default:
    //     //         if (Auth::guard($guard)->check()) {
    //     //         return redirect('/home');
    //     //             }
    //     //         break;
    //     // }

    //     if (Auth::guard($guard)->check()) {
    //         return redirect('/home');
    //     }

    //     return $next($request);
    // }
}
