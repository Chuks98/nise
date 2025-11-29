<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class StudentDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $routeName = $request->route()->getName();

            // PUBLIC ROUTES — login & registration pages
            if (in_array($routeName, ['student.login.page', 'student.register.page'])) {

                // If already logged in, redirect to dashboard
                if (Session::get('loggedInStudent')) {
                    return redirect('/student-dashboard');
                }

                return $next($request);
            }

            // PROTECTED ROUTES — require session
            if (!Session::get('loggedInStudent')) {
                return redirect('/student-login')->with('error', 'You must be logged in as a student.');
            }

            $user = Session::get('user');

            if (!$user || ($user['role'] ?? '') !== 'student') {
                abort(403, 'Access denied. Students only.');
            }

            return $next($request);
        });
    }

    /**
     * PUBLIC — Student Login Page
     */
    public function studentLoginPage()
    {
        return view('student-dashboard.pages.student-login');
    }

    /**
     * PUBLIC — Student Registration Page
     */
    public function studentRegistrationPage()
    {
        return view('student-dashboard.pages.student-registration');
    }

    /**
     * PROTECTED — Dashboard Home
     */
    public function index()
    {
        return view('student-dashboard.main-layout', [
            'page' => 'student-dashboard.pages.check-result'
        ]);
    }

    /**
     * PROTECTED — Dynamic Dashboard Pages
     */
    public function showPage($page)
    {
        Log::info("StudentDashboardController: Requested page - $page");

        return view('student-dashboard.main-layout', [
            'page' => 'student-dashboard.pages.' . $page
        ]);
    }
}
