<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Restrict access to logged-in admin
     */
    public function __construct()
    {
        // Inline middleware to check login and admin role
        $this->middleware(function ($request, $next) {
            if (!Session::get('loggedIn')) {
                // Redirect to login page if not logged in
                return redirect('/admin-login')->with('error', 'You must be logged in as admin.');
            }

            $user = Session::get('user');
            if (!$user || ($user['role'] ?? '') !== 'admin') {
                // If logged in but not admin, deny access
                abort(403, 'Access denied. Admins only.');
            }

            return $next($request);
        });
    }

    /**
     * Show default dashboard (Create page)
     */
    public function index()
    {
        return view('dashboard.main-layout', ['page' => 'dashboard.pages.create']);
    }

    /**
     * Show dynamic dashboard page
     */
    public function showPage($page)
    {
        \Log::info("DashboardController: Requested page - $page");
        $data = ['page' => 'dashboard.pages.' . $page];

        return view('dashboard.main-layout', $data);
    }
}
