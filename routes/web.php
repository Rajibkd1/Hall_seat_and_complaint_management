<?php

use App\Models\Seat;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HallNoticeController;
use App\Http\Controllers\StudentComplaintController;
use App\Http\Controllers\SeatApplicationController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdminAuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ProvostController;
use App\Http\Controllers\CoProvostController;
use App\Http\Controllers\StaffController;

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

// Super Admin Pages
Route::get('/super-admin/login', [SuperAdminAuthController::class, 'showLogin'])->name('super_admin.login');

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/public-notice/{id}', [HomeController::class, 'showPublicNotice']);

// Demo Page
Route::get('/demo/navigation', function () {
    return view('demo.navigation_demo');
})->name('demo.navigation');

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

// Super Admin Auth (Form submission)
Route::post('/super-admin/login', [SuperAdminAuthController::class, 'login'])->name('super_admin.login.submit');
Route::post('/super-admin/logout', [SuperAdminAuthController::class, 'logout'])->name('super_admin.logout');

// Super Admin OTP Routes
Route::post('/super-admin/send-otp', [SuperAdminAuthController::class, 'sendOTP'])->name('super_admin.send_otp');
Route::post('/super-admin/verify-otp', [SuperAdminAuthController::class, 'verifyOTP'])->name('super_admin.verify_otp');

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
    Route::get('/contact-us', function () {
        session(['active_nav' => 'contact_us']);
        return view('student.contact_us');
    })->name('student.contact_us');

    //Seat Application Routes
    Route::get('/seat-application', [SeatApplicationController::class, 'showForm'])->name('student.seat_application');
    Route::post('/seat-application/submit', [SeatApplicationController::class, 'store'])
        ->name('seat-application.submit');
});

// Super Admin Protected Routes
Route::middleware('super-admin-auth')->prefix('super-admin')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('super_admin.dashboard');
    Route::get('/provosts', [SuperAdminController::class, 'provosts'])->name('super_admin.provosts');
    Route::get('/provosts/{id}', [SuperAdminController::class, 'viewProvost'])->name('super_admin.view_provost');

    // Provost Registration
    Route::get('/register-provost', [SuperAdminAuthController::class, 'showProvostRegistration'])->name('super_admin.register_provost');
    Route::post('/register-provost', [SuperAdminAuthController::class, 'registerProvost'])->name('super_admin.register_provost.submit');
});

// Admin Protected Routes with Role-Based Permissions
use App\Http\Controllers\AdminController;

Route::middleware(['admin-auth', 'set-active-menu'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Admin Creation (Provost only)
    Route::middleware('role-permission:create_admins')->group(function () {
        Route::get('/create-admin', [AdminAuthController::class, 'showCreateAdmin'])->name('admin.create_admin');
        Route::post('/create-admin', [AdminAuthController::class, 'createAdmin'])->name('admin.create_admin.submit');
        Route::post('/send-admin-otp', [AdminAuthController::class, 'sendAdminOTP'])->name('admin.send_admin_otp');
    });

    // Student Management (Provost and Co-Provost)
    Route::middleware('role-permission:view_students')->group(function () {
        Route::get('/students', [AdminController::class, 'students'])->name('admin.students');
        Route::get('/students/{student_id}', [AdminController::class, 'viewStudentProfile'])->name('admin.student.profile');
    });

    // Complaint Management (All roles)
    Route::middleware('role-permission:manage_complaints')->group(function () {
        Route::get('/complaints', [AdminController::class, 'complaints'])->name('admin.complaints');
        Route::get('/complaints/{id}', [AdminController::class, 'viewComplaint'])->name('admin.complaint.view');
        Route::post('/complaints/{id}/update-status', [AdminController::class, 'updateComplaintStatus'])->name('admin.complaint.update_status');
    });

    // Notice Management - View notices (All roles)
    Route::get('/notices', [AdminController::class, 'notices'])->name('admin.notices');

    // Notice Creation/Management (Provost and Co-Provost only)
    Route::middleware('role-permission:verify_applications')->group(function () {
        Route::get('/notices/create', [AdminController::class, 'createNotice'])->name('admin.notices.create');
        Route::post('/notices', [AdminController::class, 'storeNotice'])->name('admin.notices.store');
        Route::get('/notices/{id}/edit', [AdminController::class, 'editNotice'])->name('admin.notices.edit');
        Route::put('/notices/{id}', [AdminController::class, 'updateNotice'])->name('admin.notices.update');
        Route::delete('/notices/{id}', [AdminController::class, 'destroyNotice'])->name('admin.notices.destroy');
    });

    // Notice Approval (Provost only)
    Route::middleware('role-permission:approve_notices')->group(function () {
        Route::post('/notices/{id}/approve', [AdminController::class, 'approveNotice'])->name('admin.notices.approve');
        Route::post('/notices/{id}/reject', [AdminController::class, 'rejectNotice'])->name('admin.notices.reject');
    });

    // Application Management (Provost and Co-Provost)
    Route::middleware('role-permission:verify_applications')->group(function () {
        Route::get('/applications', [SeatApplicationController::class, 'adminIndex'])->name('admin.applications.index');
        Route::get('/applications/{application}', [SeatApplicationController::class, 'adminShow'])->name('admin.applications.view');
        Route::patch('/applications/{application}/update-status', [SeatApplicationController::class, 'updateStatus'])->name('admin.applications.update_status');
        Route::post('/applications/{application}/send-email', [SeatApplicationController::class, 'sendEmail'])->name('admin.applications.send_email');

        // Approved Applications Routes
        Route::get('/applications-approved', [SeatApplicationController::class, 'approvedApplications'])->name('admin.applications.approved');
        Route::get('/applications-approved/{application}', [SeatApplicationController::class, 'approvedShow'])->name('admin.applications.approved.show');

        // PDF Report Routes
        Route::get('/applications/pdf/generate', [SeatApplicationController::class, 'generatePDFReport'])->name('admin.applications.pdf.generate');
        Route::get('/applications/pdf/download', [SeatApplicationController::class, 'downloadPDFReport'])->name('admin.applications.pdf.download');

        // Allocated Students Routes
        Route::get('/allocated-students', [SeatApplicationController::class, 'allocatedStudents'])->name('admin.applications.allocated');
        Route::get('/allocated-students/{allotment}', [SeatApplicationController::class, 'allocatedShow'])->name('admin.applications.allocated.show');
        Route::get('/allocated-students/pdf/generate', [SeatApplicationController::class, 'generateAllocatedPDFReport'])->name('admin.applications.allocated.pdf.generate');
        Route::get('/allocated-students/pdf/download', [SeatApplicationController::class, 'downloadAllocatedPDFReport'])->name('admin.applications.allocated.pdf.download');
    });

    // Seat Management Routes (All can view)
    Route::get('/seats', [SeatController::class, 'index'])->name('admin.seats.index');
    Route::get('/seats/rooms', [SeatController::class, 'getRooms'])->name('admin.seats.rooms');
    Route::get('/seats/room-seats', [SeatController::class, 'getRoomSeats'])->name('admin.seats.room_seats');
    Route::get('/seats/{seat}/details', [SeatController::class, 'getSeatDetails'])->name('admin.seats.details');
    Route::get('/seats/available-students', [SeatController::class, 'getAvailableStudents'])->name('admin.seats.available_students');

    // Seat Allocation (Provost only)
    Route::middleware('role-permission:allocate_seats')->group(function () {
        Route::get('/seats/{seat}/assign', [SeatController::class, 'showAssignmentPage'])->name('admin.seats.assign_page');
        Route::post('/seats/assign', [SeatController::class, 'assignSeat'])->name('admin.seats.assign');
        Route::delete('/seats/{seat}/release', [SeatController::class, 'releaseSeat'])->name('admin.seats.release');
    });

    // OTP Routes for Admin Creation
    Route::post('/send-otp', [AdminAuthController::class, 'sendOTP'])->name('admin.send-otp');
});

// Unified Login Routes - Redirect all role-based logins to student auth
Route::get('/provost/login', function () {
    return redirect()->route('student.auth', ['form_type' => 'login']);
})->name('provost.login');

Route::get('/co-provost/login', function () {
    return redirect()->route('student.auth', ['form_type' => 'login']);
})->name('co-provost.login');

Route::get('/staff/login', function () {
    return redirect()->route('student.auth', ['form_type' => 'login']);
})->name('staff.login');

// Provost Protected Routes
Route::middleware(['admin-auth', 'role-permission:Provost'])->prefix('provost')->group(function () {
    Route::get('/dashboard', [ProvostController::class, 'dashboard'])->name('provost.dashboard');

    // Provost-specific routes
    Route::get('/students', [ProvostController::class, 'students'])->name('provost.students');
    Route::get('/students/{student_id}', [ProvostController::class, 'viewStudentProfile'])->name('provost.student.profile');
    Route::get('/complaints', [ProvostController::class, 'complaints'])->name('provost.complaints');
    Route::get('/complaints/{id}', [ProvostController::class, 'viewComplaint'])->name('provost.complaint.view');
    Route::post('/complaints/{id}/update-status', [ProvostController::class, 'updateComplaintStatus'])->name('provost.complaint.update_status');
    Route::get('/notices', [ProvostController::class, 'notices'])->name('provost.notices');
    Route::get('/notices/create', [ProvostController::class, 'createNotice'])->name('provost.notices.create');
    Route::post('/notices', [ProvostController::class, 'storeNotice'])->name('provost.notices.store');
    Route::get('/notices/{id}/edit', [ProvostController::class, 'editNotice'])->name('provost.notices.edit');
    Route::put('/notices/{id}', [ProvostController::class, 'updateNotice'])->name('provost.notices.update');
    Route::delete('/notices/{id}', [ProvostController::class, 'destroyNotice'])->name('provost.notices.destroy');
    Route::post('/notices/{id}/approve', [ProvostController::class, 'approveNotice'])->name('provost.notices.approve');
    Route::post('/notices/{id}/reject', [ProvostController::class, 'rejectNotice'])->name('provost.notices.reject');
    Route::get('/applications', [ProvostController::class, 'applications'])->name('provost.applications.index');
    Route::get('/applications/{application}', [ProvostController::class, 'viewApplication'])->name('provost.applications.view');
    Route::patch('/applications/{application}/update-status', [ProvostController::class, 'updateApplicationStatus'])->name('provost.applications.update_status');
    Route::post('/applications/{application}/send-email', [ProvostController::class, 'sendApplicationEmail'])->name('provost.applications.send_email');
    
    // Approved Applications Routes
    Route::get('/applications-approved', [SeatApplicationController::class, 'approvedApplications'])->name('provost.applications.approved');
    Route::get('/applications-approved/{application}', [SeatApplicationController::class, 'approvedShow'])->name('provost.applications.approved.show');
    
    // PDF Report Routes
    Route::get('/applications/pdf/generate', [SeatApplicationController::class, 'generatePDFReport'])->name('provost.applications.pdf.generate');
    Route::get('/applications/pdf/download', [SeatApplicationController::class, 'downloadPDFReport'])->name('provost.applications.pdf.download');
    
    // Allocated Students Routes
    Route::get('/allocated-students', [SeatApplicationController::class, 'allocatedStudents'])->name('provost.applications.allocated');
    Route::get('/allocated-students/{allotment}', [SeatApplicationController::class, 'allocatedShow'])->name('provost.applications.allocated.show');
    Route::get('/allocated-students/pdf/generate', [SeatApplicationController::class, 'generateAllocatedPDFReport'])->name('provost.applications.allocated.pdf.generate');
    Route::get('/allocated-students/pdf/download', [SeatApplicationController::class, 'downloadAllocatedPDFReport'])->name('provost.applications.allocated.pdf.download');
    Route::get('/seats', [ProvostController::class, 'seats'])->name('provost.seats.index');
    Route::get('/seats/rooms', [ProvostController::class, 'getRooms'])->name('provost.seats.rooms');
    Route::get('/seats/room-seats', [ProvostController::class, 'getRoomSeats'])->name('provost.seats.room_seats');
    Route::get('/seats/{seat}/details', [ProvostController::class, 'getSeatDetails'])->name('provost.seats.details');
    Route::get('/seats/available-students', [ProvostController::class, 'getAvailableStudents'])->name('provost.seats.available_students');
    Route::get('/seats/{seat}/assign', [ProvostController::class, 'showAssignmentPage'])->name('provost.seats.assign_page');
    Route::post('/seats/assign', [ProvostController::class, 'assignSeat'])->name('provost.seats.assign');
    Route::delete('/seats/{seat}/release', [ProvostController::class, 'releaseSeat'])->name('provost.seats.release');
    Route::get('/create-admin', [ProvostController::class, 'showCreateAdmin'])->name('provost.create_admin');
    Route::post('/create-admin', [ProvostController::class, 'createAdmin'])->name('provost.create_admin.submit');
    Route::post('/send-admin-otp', [ProvostController::class, 'sendAdminOTP'])->name('provost.send_admin_otp');

    // Legacy routes
    Route::get('/create-co-provost', [ProvostController::class, 'showCreateCoProvost'])->name('provost.create-co-provost');
    Route::post('/create-co-provost', [ProvostController::class, 'storeCoProvost'])->name('provost.store-co-provost');
    Route::get('/create-staff', [ProvostController::class, 'showCreateStaff'])->name('provost.create-staff');
    Route::post('/create-staff', [ProvostController::class, 'storeStaff'])->name('provost.store-staff');
    Route::post('/logout', [ProvostController::class, 'logout'])->name('provost.logout');
});

// Co-Provost Protected Routes
Route::middleware(['admin-auth', 'role-permission:Co-Provost'])->prefix('co-provost')->group(function () {
    Route::get('/dashboard', [CoProvostController::class, 'dashboard'])->name('co-provost.dashboard');

    // Co-Provost-specific routes
    Route::get('/students', [CoProvostController::class, 'students'])->name('co-provost.students');
    Route::get('/students/{student_id}', [CoProvostController::class, 'viewStudentProfile'])->name('co-provost.student.profile');
    Route::get('/complaints', [CoProvostController::class, 'complaints'])->name('co-provost.complaints');
    Route::get('/complaints/{id}', [CoProvostController::class, 'viewComplaint'])->name('co-provost.complaint.view');
    Route::post('/complaints/{id}/update-status', [CoProvostController::class, 'updateComplaintStatus'])->name('co-provost.complaint.update_status');
    Route::get('/notices', [CoProvostController::class, 'notices'])->name('co-provost.notices');
    Route::get('/notices/create', [CoProvostController::class, 'createNotice'])->name('co-provost.notices.create');
    Route::post('/notices', [CoProvostController::class, 'storeNotice'])->name('co-provost.notices.store');
    Route::get('/notices/{id}/edit', [CoProvostController::class, 'editNotice'])->name('co-provost.notices.edit');
    Route::put('/notices/{id}', [CoProvostController::class, 'updateNotice'])->name('co-provost.notices.update');
    Route::delete('/notices/{id}', [CoProvostController::class, 'destroyNotice'])->name('co-provost.notices.destroy');
    Route::get('/applications', [CoProvostController::class, 'applications'])->name('co-provost.applications.index');
    Route::get('/applications/{application}', [CoProvostController::class, 'viewApplication'])->name('co-provost.applications.view');
    Route::patch('/applications/{application}/update-status', [CoProvostController::class, 'updateApplicationStatus'])->name('co-provost.applications.update_status');
    Route::post('/applications/{application}/send-email', [CoProvostController::class, 'sendApplicationEmail'])->name('co-provost.applications.send_email');
    
    // Approved Applications Routes
    Route::get('/applications-approved', [SeatApplicationController::class, 'approvedApplications'])->name('co-provost.applications.approved');
    Route::get('/applications-approved/{application}', [SeatApplicationController::class, 'approvedShow'])->name('co-provost.applications.approved.show');
    
    // PDF Report Routes
    Route::get('/applications/pdf/generate', [SeatApplicationController::class, 'generatePDFReport'])->name('co-provost.applications.pdf.generate');
    Route::get('/applications/pdf/download', [SeatApplicationController::class, 'downloadPDFReport'])->name('co-provost.applications.pdf.download');
    
    // Allocated Students Routes
    Route::get('/allocated-students', [SeatApplicationController::class, 'allocatedStudents'])->name('co-provost.applications.allocated');
    Route::get('/allocated-students/{allotment}', [SeatApplicationController::class, 'allocatedShow'])->name('co-provost.applications.allocated.show');
    Route::get('/allocated-students/pdf/generate', [SeatApplicationController::class, 'generateAllocatedPDFReport'])->name('co-provost.applications.allocated.pdf.generate');
    Route::get('/allocated-students/pdf/download', [SeatApplicationController::class, 'downloadAllocatedPDFReport'])->name('co-provost.applications.allocated.pdf.download');

    // Co-Provost Seat Management (View Only - No Allocation)
    Route::get('/seats', [CoProvostController::class, 'seats'])->name('co-provost.seats.index');
    Route::get('/seats/rooms', [CoProvostController::class, 'getRooms'])->name('co-provost.seats.rooms');
    Route::get('/seats/room-seats', [CoProvostController::class, 'getRoomSeats'])->name('co-provost.seats.room_seats');
    Route::get('/seats/{seat}/details', [CoProvostController::class, 'getSeatDetails'])->name('co-provost.seats.details');
    Route::get('/seats/available-students', [CoProvostController::class, 'getAvailableStudents'])->name('co-provost.seats.available_students');

    Route::post('/logout', [CoProvostController::class, 'logout'])->name('co-provost.logout');
});

// Staff Protected Routes
Route::middleware(['admin-auth', 'role-permission:Staff'])->prefix('staff')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');

    // Staff-specific routes
    Route::get('/complaints', [StaffController::class, 'complaints'])->name('staff.complaints');
    Route::get('/complaints/{id}', [StaffController::class, 'viewComplaint'])->name('staff.complaint.view');
    Route::post('/complaints/{id}/update-status', [StaffController::class, 'updateComplaintStatus'])->name('staff.complaint.update_status');
    Route::get('/notices', [StaffController::class, 'notices'])->name('staff.notices');

    Route::post('/logout', [StaffController::class, 'logout'])->name('staff.logout');
});
