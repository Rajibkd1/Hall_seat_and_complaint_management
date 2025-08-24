@extends('layouts.app')

@section('title', 'Student Profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/student_profile_professional.css') }}">
@endpush

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50">
        <!-- Subtle Background Pattern -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-gray-100/30 to-gray-200/20 rounded-full blur-3xl animate-float">
            </div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-gray-200/30 to-gray-100/20 rounded-full blur-3xl animate-float"
                style="animation-delay: -2s;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Enhanced Header Section with Edit Button -->
            <div
                class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/50 mb-8 overflow-hidden animate-fade-in">
                <div class="bg-gradient-to-r from-gray-50 to-white px-8 py-6 border-b border-gray-200/50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-gray-600 to-gray-800 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 mb-1">Student Profile</h1>
                                <p class="text-gray-600 font-medium">View your personal information and documents</p>
                            </div>
                        </div>

                        <!-- Edit Profile Button - Moved to top-right corner -->
                        <a href="{{ route('student.profile.edit') }}"
                            class="bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center gap-2 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Profile Information - Main Content -->
                <div class="lg:col-span-2">
                    <div
                        class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden animate-slide-up">
                        <div class="bg-gradient-to-r from-gray-50 to-white px-8 py-6 border-b border-gray-200/50">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 bg-gradient-to-br from-gray-500 to-gray-700 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-900">Personal Information</h2>
                            </div>
                        </div>

                        <form id="profileForm" class="p-8" enctype="multipart/form-data">
                            @csrf

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <!-- Student Name -->
                                <div class="form-group">
                                    <label for="name"
                                        class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="name" name="name" value="{{ $student->name }}"
                                            readonly
                                            class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50/50 text-gray-900 font-medium transition-all duration-300 focus:border-gray-400 focus:bg-white focus:shadow-lg">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- University ID -->
                                <div class="form-group">
                                    <label for="university_id"
                                        class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider">
                                        University ID <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="university_id" name="university_id"
                                            value="{{ $student->university_id }}" readonly
                                            class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50/50 text-gray-900 font-medium transition-all duration-300 focus:border-gray-400 focus:bg-white focus:shadow-lg">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email"
                                        class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider">
                                        Email Address
                                    </label>
                                    <div class="relative">
                                        <input type="email" id="email" name="email" value="{{ $student->email }}"
                                            readonly
                                            class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-100/50 text-gray-600 font-medium transition-all duration-300">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="form-group">
                                    <label for="phone"
                                        class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="tel" id="phone" name="phone"
                                            value="{{ $student->phone }}" readonly
                                            class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50/50 text-gray-900 font-medium transition-all duration-300 focus:border-gray-400 focus:bg-white focus:shadow-lg">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Department -->
                                <div class="form-group">
                                    <label for="department"
                                        class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider">
                                        Department <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="department" name="department"
                                            value="{{ $student->department }}" readonly
                                            class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50/50 text-gray-900 font-medium transition-all duration-300 focus:border-gray-400 focus:bg-white focus:shadow-lg"
                                            autocomplete="off">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                </path>
                                            </svg>
                                        </div>
                                        <div id="department-dropdown" class="department-dropdown"></div>
                                    </div>
                                </div>

                                <!-- Session Year -->
                                <div class="form-group">
                                    <label for="session_year"
                                        class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider">
                                        Session Year <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="session_year" name="session_year"
                                            value="{{ $student->session_year }}" readonly
                                            class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50/50 text-gray-900 font-medium transition-all duration-300 focus:border-gray-400 focus:bg-white focus:shadow-lg">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- Enhanced Sidebar -->
                <div class="lg:col-span-1 space-y-8">
                    <!-- Profile Picture -->
                    <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden animate-slide-up"
                        style="animation-delay: 0.2s;">
                        <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-200/50">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-6 h-6 bg-gradient-to-br from-gray-500 to-gray-700 rounded-lg flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Profile Picture</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="text-center">
                                <div id="profileImgContainer" class="relative inline-block">
                                    <img id="profileImg" src="{{ $student->profile_image_url }}" alt="Profile Picture"
                                        class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 mx-auto">
                                    <div id="profileOverlay"
                                        class="absolute inset-0 bg-black bg-opacity-50 rounded-full flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-200 cursor-pointer"
                                        style="display: none;">
                                        <span class="text-white text-sm font-medium">Change Photo</span>
                                    </div>
                                </div>
                                <input type="file" id="profileImageUpload" name="profile_image" accept="image/*"
                                    class="hidden">
                                <p class="mt-2 text-sm text-gray-500">Click to upload new photo</p>
                                <p class="text-xs text-gray-400">JPG, PNG, GIF up to 2MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- University ID Cards -->
                    <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden animate-slide-up"
                        style="animation-delay: 0.4s;">
                        <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-200/50">
                            <div class="flex items-center gap-3 mb-2">
                                <div
                                    class="w-6 h-6 bg-gradient-to-br from-gray-500 to-gray-700 rounded-lg flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">University ID Card</h3>
                            </div>
                            <p class="text-sm text-gray-600 font-medium">Upload both sides of your ID card</p>
                        </div>
                        <div class="p-6 space-y-4">
                            <!-- ID Card Front -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Front Side</label>
                                <div class="id-card-upload" data-type="front">
                                    @if ($student->id_card_front)
                                        <img src="{{ asset('storage/' . $student->id_card_front) }}" alt="ID Card Front"
                                            class="id-card-preview">
                                    @else
                                        <div class="id-card-placeholder">
                                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                            <span class="text-sm text-gray-500">Upload Front Side</span>
                                        </div>
                                    @endif
                                    <input type="file" name="id_card_front" accept="image/*" class="hidden">
                                </div>
                            </div>

                            <!-- ID Card Back -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Back Side</label>
                                <div class="id-card-upload" data-type="back">
                                    @if ($student->id_card_back)
                                        <img src="{{ asset('storage/' . $student->id_card_back) }}" alt="ID Card Back"
                                            class="id-card-preview">
                                    @else
                                        <div class="id-card-placeholder">
                                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                            <span class="text-sm text-gray-500">Upload Back Side</span>
                                        </div>
                                    @endif
                                    <input type="file" name="id_card_back" accept="image/*" class="hidden">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Seat Information -->
                    @if ($seatDetails)
                        <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden animate-slide-up"
                            style="animation-delay: 0.6s;">
                            <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-200/50">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-6 h-6 bg-gradient-to-br from-gray-500 to-gray-700 rounded-lg flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">Hall Seat Information</h3>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Room Number:</span>
                                        <span class="text-sm text-gray-900">{{ $seatDetails->room_number }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Bed Number:</span>
                                        <span class="text-sm text-gray-900">{{ $seatDetails->bed_number }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Floor:</span>
                                        <span class="text-sm text-gray-900">{{ $seatDetails->floor }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Block:</span>
                                        <span class="text-sm text-gray-900">{{ $seatDetails->block }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Status:</span>
                                        <span
                                            class="inline-flex px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                            Active
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden animate-slide-up"
                            style="animation-delay: 0.6s;">
                            <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-200/50">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-6 h-6 bg-gradient-to-br from-gray-500 to-gray-700 rounded-lg flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">Hall Seat Information</h3>
                                </div>
                            </div>
                            <div class="p-8 text-center">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-gray-600 mb-1">No hall seat assigned</p>
                                <p class="text-xs text-gray-400">Apply for a seat to see details here</p>
                            </div>
                        </div>
                    @endif

                    <!-- Quick Stats Section -->
                    <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden animate-slide-up"
                        style="animation-delay: 0.8s;">
                        <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-200/50">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-6 h-6 bg-gradient-to-br from-gray-500 to-gray-700 rounded-lg flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Profile Status</h3>
                            </div>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Profile Completion</span>
                                <div class="flex items-center gap-2">
                                    <div class="w-16 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-gray-600 to-gray-800 rounded-full"
                                            style="width: {{ $profileCompletion ?? 75 }}%"></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">{{ $profileCompletion ?? 75 }}%</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div
                                    class="text-center p-3 bg-gradient-to-br from-gray-50 to-white rounded-xl border border-gray-200">
                                    <div class="text-lg font-bold text-gray-900">{{ $student->created_at->format('M Y') }}
                                    </div>
                                    <div class="text-xs text-gray-600 font-medium">Joined</div>
                                </div>
                                <div
                                    class="text-center p-3 bg-gradient-to-br from-gray-50 to-white rounded-xl border border-gray-200">
                                    <div class="text-lg font-bold text-gray-900">
                                        {{ $student->updated_at->diffForHumans() }}</div>
                                    <div class="text-xs text-gray-600 font-medium">Last Updated</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Notification Container -->
    <div id="notificationContainer" class="fixed top-4 right-4 z-50 space-y-2"></div>
@endsection

@push('scripts')
    <script src="{{ asset('js/student_profile.js') }}"></script>
@endpush
