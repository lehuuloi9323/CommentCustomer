<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
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
        // Check if the user is not authenticated
        if (!Auth::check()) {
            // Redirect to the admin login page
            return redirect()->route('login_admin');
        }

        // User is authenticated, proceed to the next middleware or route
        return $next($request);
    }
}
