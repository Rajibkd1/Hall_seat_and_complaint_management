@include('layouts.admin_layout_helper')
@extends($layout)

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100">
        <div class="container mx-auto px-4 py-8">
            <!-- Header with Breadcrumb -->
            <div class="mb-8">
                <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-4">
                    <a href="{{ route('admin.students') }}"
                        class="hover:text-blue-600 transition-colors duration-200">Students</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-900 font-medium">Profile</span>
                </nav>
                <h1 class="text-4xl font-bold text-gray-800">Student Profile</h1>
            </div>

            @if ($student)
                <!-- Profile Header Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8 profile-card">
                    <div class="relative bg-gradient-to-r from-blue-600 to-purple-700 h-32">
                        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                        <div class="absolute -bottom-16 left-8">
                            <div class="relative">
                                <div class="w-32 h-32 rounded-full overflow-hidden bg-white p-1 shadow-lg profile-image">
                                    @if ($student->profile_image)
                                        <img src="{{ asset('storage/' . $student->profile_image) }}" alt="Profile Image"
                                            class="w-full h-full object-cover rounded-full">
                                    @else
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                            <span
                                                class="text-white text-4xl font-bold">{{ substr($student->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div
                                    class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-20 pb-8 px-8">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="mb-4 md:mb-0">
                                <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $student->name }}</h2>
                                <div class="flex flex-wrap items-center gap-3">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                        {{ $student->department }}
                                    </span>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ $student->session_year }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Information Cards Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Contact Information -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6 info-card">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900">Contact Information</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div
                                        class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                        <div
                                            class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600 font-medium">Email Address</p>
                                            <p class="text-gray-900">{{ $student->email }}</p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600 font-medium">Phone Number</p>
                                            <p class="text-gray-900">{{ $student->phone }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div
                                        class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                        <div
                                            class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600 font-medium">University ID</p>
                                            <p class="text-gray-900">{{ $student->university_id }}</p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                        <div
                                            class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600 font-medium">Student ID</p>
                                            <p class="text-gray-900">{{ $student->student_id }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats Sidebar -->
                    <div class="space-y-6">
                        <!-- Status Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 info-card">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Status</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Account Status</span>
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-1"></div>
                                        Active
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Enrollment</span>
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-1"></div>
                                        Enrolled
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Last Login</span>
                                    <span class="text-sm text-gray-900">2 hours ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Error State -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.268 18.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Student Not Found</h3>
                    <p class="text-gray-600 mb-6">The student profile you're looking for doesn't exist or has been removed.
                    </p>
                    <a href="{{ route('admin.students') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Students
                    </a>
                </div>
            @endif

            <!-- Back Button -->
            <div class="mt-8">
                <a href="{{ route('admin.students') }}"
                    class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 hover:shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Student List
                </a>
            </div>
        </div>
    </div>




@endsection
