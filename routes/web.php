<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HallNoticeController;
use App\Http\Controllers\StudentComplaintController;
use App\Http\Controllers\SeatApplicationController;

/*
|--------------------------------------------------------------------------
| Public Routes (Show UI Pages)
|--------------------------------------------------------------------------
*/

// Student Pages
Route::get('/student/auth/{form_type?}', [StudentAuthController::class, 'showAuthForm'])->name('student.auth');

// Admin Pages
Route::view('/admin/login', 'admin.login')->name('admin.login.page');
Route::view('/admin/register', 'admin.register')->name('admin.register.page');

// Home Page
Route::get('/', function () {
    return view('homepage');
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

     Route::get('/hall-notice', [HallNoticeController::class, 'index'])->name('student.hall-notice');
    Route::get('/hall-notice/{id}', [HallNoticeController::class, 'show'])->name('student.hall-notice.show');

    // Placeholder routes for Seat Application and Contact Us
    Route::get('/contact-us', function () { session(['active_nav' => 'contact_us']); return view('student.contact_us'); })->name('student.contact_us');

    //Seat Application Routes
    Route::get('/seat-application', [SeatApplicationController::class, 'showForm'])->name('student.seat_application');
    Route::post('/seat-application/submit', [SeatApplicationController::class, 'store'])
    ->name('seat-application.submit');
});

// Admin Protected Routes
use App\Http\Controllers\AdminController;

Route::middleware('admin-auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/students', [AdminController::class, 'students'])->name('admin.students');
    Route::get('/admin/students/{student_id}', [AdminController::class, 'viewStudentProfile'])->name('admin.student.profile');
    Route::get('/admin/complaints', [AdminController::class, 'complaints'])->name('admin.complaints');
    Route::get('/admin/complaints/{id}', [AdminController::class, 'viewComplaint'])->name('admin.complaint.view');
    Route::post('/admin/complaints/{id}/update-status', [AdminController::class, 'updateComplaintStatus'])->name('admin.complaint.update_status');
    Route::get('/admin/notices', [AdminController::class, 'notices'])->name('admin.notices');
    Route::get('/admin/notices/create', [AdminController::class, 'createNotice'])->name('admin.notices.create');
    Route::post('/admin/notices', [AdminController::class, 'storeNotice'])->name('admin.notices.store');
    Route::get('/admin/notices/{id}/edit', [AdminController::class, 'editNotice'])->name('admin.notices.edit');
    Route::put('/admin/notices/{id}', [AdminController::class, 'updateNotice'])->name('admin.notices.update');
    Route::delete('/admin/notices/{id}', [AdminController::class, 'destroyNotice'])->name('admin.notices.destroy');
    Route::get('/admin/applications', [AdminController::class, 'applications'])->name('admin.applications');
    Route::get('/admin/applications/{id}', [AdminController::class, 'viewApplication'])->name('admin.applications.view');
    Route::post('/admin/applications/{id}/update-status', [AdminController::class, 'updateApplicationStatus'])->name('admin.applications.update_status');
});