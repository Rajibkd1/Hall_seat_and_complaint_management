<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\StudentComplaintController;

/*
|--------------------------------------------------------------------------
| Public Routes (Show UI Pages)
|--------------------------------------------------------------------------
*/

// Student Pages
Route::view('/student/login', 'student.login')->name('student.login');
Route::view('/student/register', 'student.register')->name('student.register.page');

// Admin Pages
Route::view('/admin/login', 'admin.login')->name('admin.login.page');
Route::view('/admin/register', 'admin.register')->name('admin.register.page');

// Home Page
Route::get('/', function () {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| Auth Submission Routes (POST)
|--------------------------------------------------------------------------
*/

// Student Auth (Form submission)
Route::post('/student/send-code', [StudentAuthController::class, 'sendVerificationCode'])->name('student.send-code');
Route::post('/student/verify-code', [StudentAuthController::class, 'verifyCode'])->name('student.verify-code');
Route::post('/student/register', [StudentAuthController::class, 'register'])->name('student.register.submit');
Route::post('/student/login', [StudentAuthController::class, 'login'])->name('student.login.submit');


// Admin Auth (Form submission)
Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register.submit');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

// Student Protected Routes
Route::middleware('student-auth')->group(function () {
    Route::get('/student/dashboard', [StudentAuthController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/profile', [\App\Http\Controllers\StudentController::class, 'profile'])->name('student.profile');
    Route::post('/student/profile', [\App\Http\Controllers\StudentController::class, 'update'])->name('student.profile.update');
    Route::post('/student/logout', [StudentAuthController::class, 'logout'])->name('student.logout');
    // Complaint List
    Route::get('/complaint_list', [StudentComplaintController::class, 'complaintList'])->name('student.complaint_list');
    
    // Create Complaint
    Route::get('/create_complaint', [StudentComplaintController::class, 'createComplaint'])->name('student.create_complaint');
    Route::post('/create_complaint', [StudentComplaintController::class, 'storeComplaint'])->name('student.store_complaint');
    
    // Track Complaint
    Route::get('/track_complaint', [StudentComplaintController::class, 'trackComplaint'])->name('student.track_complaint');
    Route::post('/search_complaint', [StudentComplaintController::class, 'searchComplaint'])->name('student.search_complaint');
    
    // Delete Complaint
    Route::delete('/complaint/{complaint}', [StudentComplaintController::class, 'deleteComplaint'])->name('student.delete_complaint');
});

// Admin Protected Routes
Route::middleware('admin-auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return response()->json(['message' => 'Welcome to Admin Dashboard']);
    });
});
