<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ScoreController;




// The admin routes
Route::prefix('admin')->group(function () {
    Route::post('/login', [AdminController::class, 'loginAdmin'])->name('admin.login');
    Route::post('/update-password', [AdminController::class, 'updatePassword'])->name('admin.update-password');
});


// The admin dashboard pages routes
Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.home');
    Route::get('/{page}', [DashboardController::class, 'showPage'])->name('dynamic.dashboard.page');
});


// The student login and registration pages routes
Route::get('/student-login', [StudentDashboardController::class, 'studentLoginPage'])
    ->name('student.login.page');

Route::get('/student-registration', [StudentDashboardController::class, 'studentRegistrationPage'])
    ->name('student.register.page');

// Protected Dashboard Routes
Route::prefix('student-dashboard')->group(function () {
    Route::get('/', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/fetch-account', [StudentController::class, 'fetchAccount']);
    Route::get('/{page}', [StudentDashboardController::class, 'showPage']);
    Route::post('/check-result', [StudentController::class, 'checkResult']);
    Route::post('/update-account', [StudentController::class, 'updateAccount']);
    Route::post('/update-password', [StudentController::class, 'updateStudentPassword']);
});



// Student Dashboard pages and api Routes
Route::prefix('student')->group(function () {
    Route::post('/register', [StudentController::class, 'register'])->name('student.register');
    Route::post('/login', [StudentController::class, 'login'])->name('student.login');
});


// The index pages routes
Route::get('/', [IndexController::class, 'home'])->name('home');
Route::get('/admin-login', [IndexController::class, 'adminLoginPage'])->name('admin-login');
Route::post('/logout', [IndexController::class, 'logout'])->name('logout');
Route::get('/blog-detail/{id}', [IndexController::class, 'showSingleBlog'])->name('blog.detail');
Route::get('/{page}', [IndexController::class, 'dynamic'])->name('dynamic.page');




// Blog routes
Route::prefix('blog')->group(function () {
    // Create blog post (with optional image upload)
    Route::post('/createBlog', [BlogController::class, 'createBlog']);

    // List all blogs
    Route::get('/getAllBlogs', [BlogController::class, 'getAllBlogs']);

    // Latest news - 4 latest blogs
    Route::get('/latestNews', [BlogController::class, 'latestNews']);

    // Get single blog by ID
    Route::get('/getSingleBlog/{id}', [BlogController::class, 'getSingleBlog']);

    // Update a blog post (with optional image upload)
    Route::post('/updateSingleBlog/{id}', [BlogController::class, 'updateBlog']);

    // Delete a blog post
    Route::post('/deleteSingleBlog/{id}', [BlogController::class, 'deleteBlog']);

    // Add a comment to a blog post
    Route::post('/{id}/addComment', [BlogController::class, 'addComment']);
});







// CSV Upload routes
Route::prefix('scores')->name('scores.')->controller(ScoreController::class)->group(function () {
    Route::post('/create', 'createScore')->name('create');
    Route::post('/upload', 'importScores')->name('upload');
    Route::get('/list', 'listScores')->name('list');
    Route::get('/getSingle/{id}', 'getSingle')->name('getSingle');
    Route::patch('/updateSingle/{id}', 'updateSingle')->name('updateSingle');
    Route::delete('/deleteSingle/{id}', 'deleteSingle')->name('deleteSingle');
    Route::post('/bulk-delete', 'bulkDelete')->name('bulkDelete');
});
