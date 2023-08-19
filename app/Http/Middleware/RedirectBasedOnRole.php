<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
  
 public function handle($request, Closure $next)
{
    $user = Auth::user(); // Get the authenticated user

    if ($user) {
        switch ($user->role->name) {
            case 'Doctor':
                if ($request->routeIs('Doctor')) {
                    return $next($request);
                }
                return redirect()->route('Doctor');
            case 'Patient':
                if ($request->routeIs('Patient')) {
                    return $next($request);
                }
                return redirect()->route('Patient');
            default:
                // Handle other roles or show an error
                break;
        }
    }

    return $next($request);
}
}
