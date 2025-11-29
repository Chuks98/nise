<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if admin is logged in
        if (Session::get('loggedIn') === true) {
            return $next($request);
        }

        // Redirect to login page if not
        return redirect('/admin-login')->with('error', 'You must be logged in as admin.');
    }
}
