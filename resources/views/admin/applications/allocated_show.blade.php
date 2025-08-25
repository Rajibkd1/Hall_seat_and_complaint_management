@include('layouts.admin_layout_helper')
@extends($layout)

@section('content')
    <div class="min-h-screen bg-gray-50 p-6">
        <div class="max-w-7xl mx-auto">

            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8 overflow-hidden">
                <div class="bg-gray-800 px-8 py-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-white mb-2">Allocated Student Details</h1>
                            <p class="text-gray-300">Comprehensive information about the seat allocation</p>
                            <div class="flex items-center mt-4 space-x-4">
                                <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                                    <span class="text-white text-sm font-medium">Allotment ID</span>
                                    <div class="text-white text-xl font-bold">#{{ $allotment->allotment_id }}</div>
                                </div>
                                <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                                    <span class="text-white text-sm font-medium">Allocated On</span>
                                    <div class="text-white text-lg font-semibold">
                                        {{ \Carbon\Carbon::parse($allotment->start_date)->format('M j, Y') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('admin.applications.allocated') }}"
                                class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm border border-white/30 text-white font-semibold rounded-lg hover:bg-white/30 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Back to Allocated Students
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Profile Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8 overflow-hidden">
                <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
                    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between">
                        <div class="flex items-center space-x-6">
                            <div class="relative">
                                @if ($allotment->student && $allotment->student->profile_image)
                                    <img src="{{ asset('storage/' . $allotment->student->profile_image) }}"
                                        alt="Profile Image"
                                        class="w-24 h-24 rounded-lg object-cover border-4 border-white shadow-lg">
                                @else
                                    <div
                                        class="w-24 h-24 rounded-lg bg-gray-300 flex items-center justify-center text-white text-2xl font-bold border-4 border-white shadow-lg">
                                        {{ substr($allotment->student->name ?? 'N', 0, 1) }}
                                    </div>
                                @endif
                                <div
                                    class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center border-2 border-white">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                                    {{ $allotment->student->name ?? 'Student Name N/A' }}
                                </h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                        <span
                                            class="font-medium">{{ $allotment->student->email ?? 'No email provided' }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zM8 6a2 2 0 114 0v1H8V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span
                                            class="font-bold text-lg text-blue-600 bg-blue-50 px-3 py-1 rounded-full font-mono">{{ $allotment->student->university_id ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="font-medium">{{ $allotment->application->department ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                        </svg>
                                        <span
                                            class="font-medium">{{ $allotment->application->academic_year ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 lg:mt-0">
                            <div class="text-right">
                                <div class="text-sm text-gray-500 mb-2">Allocation Status</div>
                                <span
                                    class="inline-flex items-center px-4 py-2 rounded-lg text-lg font-bold shadow-lg bg-green-500 text-white">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ ucfirst($allotment->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- University ID Card Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
                <div class="bg-gray-700 px-8 py-6">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zM8 6a2 2 0 114 0v1H8V6z"
                                clip-rule="evenodd" />
                        </svg>
                        University ID Card
                    </h3>
                    <p class="text-gray-300 mt-2">Student's University ID card images (front and back)</p>
                </div>
                <div class="p-8">
                    @if ($allotment->student)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Front Side -->
                            <div class="text-center">
                                <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Front Side
                                </h4>
                                @if ($allotment->student->id_card_front)
                                    <div
                                        class="border-2 border-gray-200 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                        <img src="{{ asset('storage/' . $allotment->student->id_card_front) }}"
                                            alt="University ID Card - Front"
                                            class="w-full h-64 object-contain bg-gray-50 cursor-pointer hover:bg-gray-100 transition-colors duration-200"
                                            onclick="openImageModal('{{ asset('storage/' . $allotment->student->id_card_front) }}', 'University ID Card - Front')">
                                    </div>
                                    <p class="text-sm text-green-600 font-medium mt-3 flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Uploaded
                                    </p>
                                @else
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 bg-gray-50">
                                        <div
                                            class="flex items-center justify-center w-16 h-16 bg-gray-200 rounded-lg mb-4 mx-auto">
                                            <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 font-medium">Not Uploaded</p>
                                        <p class="text-xs text-gray-400 mt-1">Front side image not available</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Back Side -->
                            <div class="text-center">
                                <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Back Side
                                </h4>
                                @if ($allotment->student->id_card_back)
                                    <div
                                        class="border-2 border-gray-200 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                        <img src="{{ asset('storage/' . $allotment->student->id_card_back) }}"
                                            alt="University ID Card - Back"
                                            class="w-full h-64 object-contain bg-gray-50 cursor-pointer hover:bg-gray-100 transition-colors duration-200"
                                            onclick="openImageModal('{{ asset('storage/' . $allotment->student->id_card_back) }}', 'University ID Card - Back')">
                                    </div>
                                    <p class="text-sm text-green-600 font-medium mt-3 flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Uploaded
                                    </p>
                                @else
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 bg-gray-50">
                                        <div
                                            class="flex items-center justify-center w-16 h-16 bg-gray-200 rounded-lg mb-4 mx-auto">
                                            <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 font-medium">Not Uploaded</p>
                                        <p class="text-xs text-gray-400 mt-1">Back side image not available</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <p class="text-xl text-gray-500 font-semibold mb-2">Student Information Not Available</p>
                            <p class="text-gray-400">Unable to display ID card images</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Information Cards Grid -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-8">
                <!-- Seat Details Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-blue-500 px-6 py-4">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                            Seat Information
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Room
                                    Number</span>
                                <span
                                    class="text-sm font-bold text-gray-900">{{ $allotment->seat->room_number ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Bed Number</span>
                                <span
                                    class="text-sm font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">{{ $allotment->seat->bed_number ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Block</span>
                                <span
                                    class="text-sm font-bold text-gray-900">{{ $allotment->seat->block ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Floor</span>
                                <span
                                    class="text-sm font-bold text-gray-900">{{ $allotment->seat->floor ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3">
                                <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Seat
                                    Status</span>
                                <span
                                    class="text-sm font-bold text-green-600 bg-green-50 px-3 py-1 rounded-full">{{ ucfirst($allotment->seat->status ?? 'N/A') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Allocation Details Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-green-500 px-6 py-4">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Allocation Details
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Allocated
                                    By</span>
                                <span
                                    class="text-sm font-bold text-gray-900">{{ $allotment->admin->name ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Admin Role</span>
                                <span
                                    class="text-sm font-bold text-green-600 bg-green-50 px-3 py-1 rounded-full">{{ ucfirst($allotment->admin->role ?? 'Admin') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Start Date</span>
                                <span
                                    class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($allotment->start_date)->format('F j, Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">End Date</span>
                                <span class="text-sm font-bold text-gray-900">
                                    @if ($allotment->end_date)
                                        {{ \Carbon\Carbon::parse($allotment->end_date)->format('F j, Y') }}
                                    @else
                                        <span class="text-green-600">Ongoing</span>
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-3">
                                <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Duration</span>
                                <span
                                    class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($allotment->start_date)->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Application Summary Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-purple-500 px-6 py-4">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd" />
                            </svg>
                            Application Summary
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Application
                                    ID</span>
                                <span
                                    class="text-sm font-bold text-purple-600 bg-purple-50 px-3 py-1 rounded-full">#{{ $allotment->application->application_id ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Program</span>
                                <span
                                    class="text-sm font-bold text-gray-900">{{ ucfirst($allotment->application->program ?? 'N/A') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">CGPA</span>
                                <span
                                    class="text-sm font-bold text-green-600 bg-green-50 px-3 py-1 rounded-full">{{ $allotment->application->cgpa ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Application
                                    Date</span>
                                <span
                                    class="text-sm font-bold text-gray-900">{{ $allotment->application ? \Carbon\Carbon::parse($allotment->application->application_date)->format('F j, Y') : 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3">
                                <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Application
                                    Status</span>
                                <span
                                    class="text-sm font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">{{ ucfirst($allotment->application->status ?? 'N/A') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="flex flex-wrap gap-4">
                    @if ($allotment->application)
                        <a href="{{ route('admin.applications.view', $allotment->application->application_id) }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            View Full Application
                        </a>
                    @endif

                    @if ($allotment->student)
                        <a href="{{ route('admin.student.profile', $allotment->student->student_id) }}"
                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            View Student Profile
                        </a>
                    @endif

                    <a href="{{ route('admin.seats.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        View Seat Management
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 overflow-y-auto h-full w-full z-50 hidden">
        <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 id="modalTitle" class="text-lg leading-6 font-medium text-gray-900"></h3>
                    <button id="closeImageModal" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="text-center">
                    <img id="modalImage" src="" alt=""
                        class="max-w-full max-h-96 mx-auto rounded-lg shadow-lg">
                </div>
                <div class="flex justify-center mt-6">
                    <button id="closeImageModalBtn"
                        class="px-6 py-2 bg-gray-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors duration-200">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Image Modal Functions
        function openImageModal(imageSrc, title) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');

            modalImage.src = imageSrc;
            modalImage.alt = title;
            modalTitle.textContent = title;
            modal.classList.remove('hidden');
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('imageModal');
            const closeBtn = document.getElementById('closeImageModal');
            const closeBtnBottom = document.getElementById('closeImageModalBtn');

            if (closeBtn) {
                closeBtn.addEventListener('click', closeImageModal);
            }

            if (closeBtnBottom) {
                closeBtnBottom.addEventListener('click', closeImageModal);
            }

            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    closeImageModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeImageModal();
                }
            });
        });
    </script>
@endsection
