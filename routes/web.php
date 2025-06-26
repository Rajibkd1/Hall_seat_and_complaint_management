<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\AdminAuthController;

/*
|--------------------------------------------------------------------------
| Public Routes (Show UI Pages)
|--------------------------------------------------------------------------
*/

// Student Pages
Route::view('/student/login', 'student.login')->name('student.login.page');
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
    Route::get('/student/dashboard', function () {
        return response()->json(['message' => 'Welcome to Student Dashboard']);
    });
});

// Admin Protected Routes
Route::middleware('admin-auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return response()->json(['message' => 'Welcome to Admin Dashboard']);
    });
});
