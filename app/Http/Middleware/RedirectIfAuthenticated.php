<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{

//    public function handle(Request $request, Closure $next, ...$guards)
            public function handle($request, Closure $next)
    {
//        $guards = empty($guards) ? [null] : $guards;
//
//        foreach ($guards as $guard) {
//            if (Auth::guard($guard)->check()) {
//                return redirect(RouteServiceProvider::HOME);
//            }
//        }
//
//        return $next($request);

                if (auth('web')->check()) {
                    return redirect(RouteServiceProvider::HOME);
                }

                if (auth('student')->check()) {
                    return redirect(RouteServiceProvider::STUDENT);
                }

                if (auth('teacher')->check()) {
                    return redirect(RouteServiceProvider::TEACHER);
                }

                if (auth('parent')->check()) {
                    return redirect(RouteServiceProvider::PARENT);
                }

                return $next($request);
    }
}
