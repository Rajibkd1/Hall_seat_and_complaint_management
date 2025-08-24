@extends('layouts.app')

@section('title', 'Edit Profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/edit_profile.css') }}">
@endpush

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Professional Header Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
                <div class="px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gray-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 mb-1">Edit Profile</h1>
                                <p class="text-gray-600">Update your personal information and documents</p>
                            </div>
                        </div>

                        <!-- Back to Profile Button -->
                        <a href="{{ route('student.profile') }}"
                            class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-200 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18">
                                </path>
                            </svg>
                            Back to Profile
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Profile Information - Main Content -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-semibold text-gray-900">Personal Information</h2>
                            </div>
                        </div>

                        <form id="editProfileForm" class="p-8" method="POST"
                            action="{{ route('student.profile.update') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <!-- Student Name -->
                                <div class="space-y-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700 uppercase tracking-wide">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="name" name="name"
                                            value="{{ old('name', $student->name) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-colors duration-200 @error('name') border-red-500 @enderror">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('name')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- University ID -->
                                <div class="space-y-2">
                                    <label for="university_id" class="block text-sm font-medium text-gray-700 uppercase tracking-wide">
                                        University ID <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="university_id" name="university_id"
                                            value="{{ old('university_id', $student->university_id) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-colors duration-200 @error('university_id') border-red-500 @enderror">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('university_id')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="space-y-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700 uppercase tracking-wide">
                                        Email Address
                                    </label>
                                    <div class="relative">
                                        <input type="email" id="email" name="email" value="{{ $student->email }}"
                                            readonly
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 cursor-not-allowed">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500">Email cannot be changed</p>
                                </div>

                                <!-- Phone -->
                                <div class="space-y-2">
                                    <label for="phone" class="block text-sm font-medium text-gray-700 uppercase tracking-wide">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="tel" id="phone" name="phone"
                                            value="{{ old('phone', $student->phone) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-colors duration-200 @error('phone') border-red-500 @enderror">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('phone')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Department -->
                                <div class="space-y-2">
                                    <label for="department" class="block text-sm font-medium text-gray-700 uppercase tracking-wide">
                                        Department <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="department" name="department"
                                            value="{{ old('department', $student->department) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-colors duration-200 @error('department') border-red-500 @enderror"
                                            autocomplete="off">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <div id="department-dropdown" class="department-dropdown"></div>
                                    </div>
                                    @error('department')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Session Year -->
                                <div class="space-y-2">
                                    <label for="session_year" class="block text-sm font-medium text-gray-700 uppercase tracking-wide">
                                        Session Year <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="session_year" name="session_year"
                                            value="{{ old('session_year', $student->session_year) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-colors duration-200 @error('session_year') border-red-500 @enderror">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('session_year')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row gap-4">
                                <button type="submit" id="saveBtn"
                                    class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Save Changes
                                </button>

                                <a href="{{ route('student.profile') }}"
                                    class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Professional Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Profile Picture -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 bg-gray-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Profile Picture</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="text-center">
                                <div id="profileImgContainer" class="relative inline-block">
                                    <img id="profileImg" src="{{ $student->profile_image_url }}" alt="Profile Picture"
                                        class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 mx-auto">
                                    <div id="profileOverlay"
                                        class="absolute inset-0 bg-black bg-opacity-50 rounded-full flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-200 cursor-pointer">
                                        <span class="text-white text-sm font-medium">Change Photo</span>
                                    </div>
                                </div>
                                <input type="file" id="profileImageUpload" name="profile_image" accept="image/*"
                                    class="hidden">
                                <p class="mt-2 text-sm text-gray-600">Click to upload new photo</p>
                                <p class="text-xs text-gray-500">JPG, PNG, GIF up to 2MB</p>
                                @error('profile_image')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ID Card Status Info -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 bg-gray-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">University ID Card</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-5 h-5 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-blue-900 mb-1">ID Card Upload</h4>
                                        <p class="text-xs text-blue-700 leading-relaxed">
                                            To upload or update your University ID Card images, please go back to your profile page and use the "Upload ID Card" button.
                                        </p>
                                        <a href="{{ route('student.profile') }}" class="inline-flex items-center mt-2 text-xs font-medium text-blue-600 hover:text-blue-800 transition-colors">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                            </svg>
                                            Go to Profile Page
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Status Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 bg-gray-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Profile Status</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <!-- Profile Completion -->
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">Profile Completion</span>
                                    <div class="flex items-center gap-2">
                                        <div class="w-16 h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-gray-600 rounded-full" style="width: 85%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">85%</span>
                                    </div>
                                </div>
                                
                                <!-- Quick Tips -->
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                    <div class="flex items-start gap-3">
                                        <div class="w-5 h-5 bg-gray-600 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-900 mb-1">Profile Tips</h4>
                                            <p class="text-xs text-gray-600 leading-relaxed">
                                                Complete all fields and upload your ID card images to improve your profile score and application success rate.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="notificationContainer" class="fixed top-4 right-4 z-50 space-y-2"></div>
@endsection

@push('scripts')
    <script src="{{ asset('js/edit_profile.js') }}"></script>
@endpush
