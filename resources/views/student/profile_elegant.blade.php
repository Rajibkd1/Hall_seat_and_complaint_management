@extends('layouts.app')

@section('title', 'Student Profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/student_profile_professional.css') }}">
    <style>
        /* Enhanced Beautiful Styling */
        .elegant-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(255, 255, 255, 0.1);
        }

        .elegant-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .elegant-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 极 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3极%3C/svg%3E") repeat;
        }

        .profile-avatar {
            position: relative;
            background: linear-gradient(145deg, #f8fafc, #e2e8f0);
            border: 4px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .info-field {
            background: linear-gradient(145deg, #ffffff, #f8fafc);
            border: 2px solid transparent;
            background-clip: padding-box;
            position: relative;
        }

        .info-field::before {
            content: '';
            position: absolute;
            inset: 0;
            padding: 2px;
            background: linear-gradient(145deg, #e2e8f0, #cbd5e1);
            border-radius: inherit;
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: exclude;
            z-index: -1;
        }

        .status-badge-elegant {
            background: linear-gradient(145deg, #10b981, #059669);
            box-shadow: 0 4px 14px 0 rgba(16, 185, 129, 0.3);
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .floating-circle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(145deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            animation: float 6s ease-in-out infinite;
        }

        .floating-circle:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            right: 10%;
            animation-delay: 0s;
        }

        .floating-circle:nth-child(2) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 15%;
            animation-delay: -2s;
        }

        .floating-circle:nth-child(3) {
            width: 40px;
            height: 40px;
            top: 60%;
            right: 20%;
            animation-delay: -4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            33% {
                transform: translateY(-10px) rotate(120deg);
            }
            66% {
                transform: translateY(5px) rotate(240deg);
            }
        }

        .elegant-button {
            background: linear-gradient(145deg, #667eea, #764ba2);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .elegant-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .elegant-button:hover::before {
            left: 100%;
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 relative">
        <!-- Enhanced Background Elements -->
        <div class="floating-elements">
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <极 class="floating-circle"></div>
        </div>

        <!-- Subtle Background Pattern -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none opacity-30">
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-gradient-to-br from-indigo-200/40 to-purple-200/40 rounded-full blur-3xl animate-pulse">
            </div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-tr from-purple-200/40 to-indigo-200/40 rounded-full blur-3xl animate-pulse" style="animation-delay: -2s;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Elegant Header Section -->
            <div class="elegant-card rounded-3xl mb-10 overflow-hidden animate-fade-in">
                <div class="elegant-header px-10 py-8 text-white relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-6">
                            <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-xl">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 极 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-4xl font-bold mb-2 text-white drop-shadow-lg">Student Profile</h1>
                                <p class="text-white/90 font-medium text-lg">Manage your personal information and academic details</p>
                            </div>
                        </div>

                        <!-- Elegant Edit Profile Button -->
                        <a href="{{ route('student.profile.edit') }}" class="elegant-button text-white font-bold py-4 px-8 rounded-2xl transition-all duration-500 flex items-center gap-3 shadow-2xl hover:shadow-3xl transform hover:scale-105 hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Profile Information - Main Content -->
                <div class="lg:col-span-3">
                    <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden animate-slide-up">
                        <div class="bg-gradient-to-r from-gray-50 to-white px-8 py-6 border-b border-gray-200/50">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-gray-500 to-gray-700 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 极 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-900">Personal Information</h2>
                            </div>
                        </div>

                        <div class="p-10">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                                <!-- Student Name -->
                                <div class="form-group">
                                    <label class="block text-sm font-bold text-gray-600 mb-4 uppercase tracking-wider">
                                        Full Name <span class="text-red-400">*</span>
                                    </label>
                                    <div class="info-field rounded-2xl p-5 relative">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-800 font-medium text-lg">{{ $student->name }}</span>
                                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- University ID -->
                                <div class="form-group">
                                    <label class="block text-sm font-bold text-gray-600 mb-4 uppercase tracking-wider">
                                        University ID <span class="text-red-400">*</span>
                                    </label>
                                    <div class="info-field rounded-2xl p-5 relative">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-800 font-medium text-lg">{{ $student->university_id }}</span>
                                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2极9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 极 00-2-2h-5m-4 0V4a2 2 0 114 0极2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label class="block text-sm font-bold text-gray-600 mb-4 uppercase tracking-wider">
                                        Email Address
                                    </label>
                                    <div class="info-field rounded-2xl p-5 relative">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-600 font-medium text-lg">{{ $student->email }}</span>
                                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="form-group">
                                    <label class="block text-sm font-bold text-gray-600 mb-4 uppercase tracking-wider">
                                        Phone Number <span class="text-red-400">*</span>
                                    </label>
                                    <div class="info-field rounded-2xl p-5 relative">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-800 font-medium text-lg">{{ $student->phone }}</span>
                                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Department -->
                                <div class="form-group">
                                    <label class="block text-sm font-bold text-gray-600 mb-4 uppercase tracking-wider">
                                        Department <span class="text-red-400">*</span>
                                    </label>
                                    <div class="info-field rounded-2xl p-5 relative">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-800 font-medium text-lg">{{ $student->department }}</span>
                                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Session Year -->
                                <div class="form-group">
                                    <label class="block text-sm font-bold text-gray-600 mb-4 uppercase tracking-wider">
                                        Session Year <span class="text-red-400">*</span>
                                    </label>
                                    <div class="info-field rounded-2xl p-5 relative">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-800 font-medium text-lg">{{ $student->session_year }}</span>
                                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2极7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Elegant Sidebar -->
                <div class="lg:col-span-1 space-y-8">
                    <!-- Profile Picture Card -->
                    <div class="elegant-card rounded-3xl overflow-hidden animate-slide-up" style="animation-delay: 0.2s;">
                        <div class="elegant-header px-8 py-6 text-white relative z-10">
                            <div class="flex items-center gap-4">
                                <div class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-white">Profile Picture</h3>
                            </div>
                        </div>
