<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated and if their role is in the allowed roles
        if (Auth::check() && in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // If the user is not authorized, redirect them to a specific page, e.g., the home page
        return redirect()->route('home')->with('error', 'Access denied.');
    }
}
