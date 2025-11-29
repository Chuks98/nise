<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class IndexController extends Controller
{
    // ✅ Home page
    public function home()
    {
        $user = session('user');        
        $role = $user['role'] ?? null;  

        return view('index.main_layout', [
            'page' => 'index.pages.index',
            'user' => $user,
            'role' => $role
        ]);
    }

    // ✅ Admin Login page
    public function adminLoginPage()
    {
        $user = session('user');

        // Redirect to /dashboard only if the logged-in user is an admin
        if ($user && isset($user['role']) && $user['role'] === 'admin') {
            return redirect('/dashboard');
        }

        // Otherwise, show the admin login page
        return view('index.pages.admin-login');
    }


    // ✅ Student Login page
    public function studentLoginPage()
    {
        $user = session('user');

        // Redirect to /student-dashboard only if logged in and role is 'user'
        if ($user && isset($user['role']) && $user['role'] === 'user') {
            return redirect('/student-dashboard');
        }

        // Otherwise, show the student login page
        return view('index.pages.student-login');
    }



    // ✅ Register page
    public function register()
    {
        if (session()->has('user')) {
            return redirect('/dashboard'); 
        }
        return view('index.pages.student-registration');
    }



    // ✅ Logout
    public function logout(Request $request)
    {
        // Get the user's role BEFORE clearing the session
        $role = session('user.role');
        Log::info("User with role '{$role}' is logging out.");

        // Clear session
        session()->forget(['user', 'role']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Decide redirect URL based on role
        $redirectTo = ($role === 'admin')
            ? '/admin-login'
            : '/student-login';

        return response()->json([
            'message' => 'Logged out successfully',
            'redirect' => $redirectTo
        ]);
    }


    // ✅ Dynamic catch-all pages (like /about, /services)
    public function dynamic($page)
    {
        $user = session('user');
        $role = $user['role'] ?? null;

        return view('index.main_layout', [
            'page' => "index.pages.$page",
            'user' => $user,
            'role' => $role
        ]);
    }
}
