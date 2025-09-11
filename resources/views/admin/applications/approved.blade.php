@include('layouts.admin_layout_helper')
@extends($layout)

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100">
        <div class="container mx-auto px-4 py-6 lg:py-8">
            <!-- Header Section -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 lg:mb-8 gap-4 lg:gap-6">
                <div class="text-center lg:text-left">
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-800 mb-2">Approved & Verified
                        Applications</h1>
                    <p class="text-sm sm:text-base text-gray-600">List of all approved and verified seat applications</p>
                </div>
                <div class="flex flex-wrap justify-center lg:justify-end gap-2 sm:gap-3">
                    <a href="{{ route('admin.applications.index') }}"
                        class="inline-flex items-center px-3 py-2 sm:px-4 sm:py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        <span class="hidden sm:inline">All Applications</span>
                        <span class="sm:hidden">All Apps</span>
                    </a>
                    <a href="{{ route('admin.applications.pdf.generate') }}" target="_blank"
                        class="inline-flex items-center px-3 py-2 sm:px-4 sm:py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                        <span class="hidden sm:inline">View PDF Report</span>
                        <span class="sm:hidden">PDF</span>
                    </a>
                    <a href="{{ route('admin.applications.pdf.download') }}"
                        class="inline-flex items-center px-3 py-2 sm:px-4 sm:py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="hidden sm:inline">Download PDF Report</span>
                        <span class="sm:hidden">Download</span>
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 lg:mb-8">
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Approved</p>
                            <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $approvedApplications->count() }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Seat Assigned</p>
                            <p class="text-xl sm:text-2xl font-bold text-gray-900">
                                {{ $approvedApplications->filter(function ($app) {return $app->seatAllotments()->where('status', 'active')->exists();})->count() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-orange-100">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Needs Seat</p>
                            <p class="text-xl sm:text-2xl font-bold text-gray-900">
                                {{ $approvedApplications->filter(function ($app) {return !$app->seatAllotments()->where('status', 'active')->exists();})->count() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Avg CGPA</p>
                            <p class="text-xl sm:text-2xl font-bold text-gray-900">
                                {{ number_format($approvedApplications->avg('cgpa'), 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Advanced Search and Filter Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6 p-4 sm:p-6">
                <div class="space-y-4">
                    <!-- Advanced Search and Filter Section -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-green-800 mb-3">Advanced Search & Filter</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Search by Name -->
                            <div class="relative">
                                <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-2">Search by
                                    Name</label>
                                <input type="text" id="searchInput" placeholder="Enter student name..."
                                    class="w-full pl-10 pr-4 py-2 border border-green-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <svg class="absolute left-3 top-8 h-5 w-5 text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>

                            <!-- Department Filter -->
                            <div>
                                <label for="departmentFilter"
                                    class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                                <select id="departmentFilter"
                                    class="w-full px-3 py-2 border border-green-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option value="">All Departments</option>
                                    @foreach ($approvedApplications->unique('department')->sortBy('department') as $application)
                                        <option value="{{ $application->department }}">{{ $application->department }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Session Year Filter -->
                            <div>
                                <label for="sessionYearFilter"
                                    class="block text-sm font-medium text-gray-700 mb-2">Session Year</label>
                                <select id="sessionYearFilter"
                                    class="w-full px-3 py-2 border border-green-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option value="">All Sessions</option>
                                    @foreach ($approvedApplications->unique('academic_year')->sortBy('academic_year') as $application)
                                        <option value="{{ $application->academic_year }}">
                                            {{ $application->academic_year }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Number of Semesters Filter -->
                            <div>
                                <label for="semesterFilter" class="block text-sm font-medium text-gray-700 mb-2">Number of
                                    Semesters</label>
                                <select id="semesterFilter"
                                    class="w-full px-3 py-2 border border-green-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option value="">All Semesters</option>
                                    @for ($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}">
                                            {{ $i }} {{ $i == 1 ? 'Semester' : 'Semesters' }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <!-- Additional Filters Row -->
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mt-4">
                            <!-- CGPA Range Filter -->
                            <div>
                                <label for="cgpaMinFilter" class="block text-sm font-medium text-gray-700 mb-2">Min
                                    CGPA</label>
                                <input type="number" id="cgpaMinFilter" step="0.01" min="0" max="4"
                                    placeholder="0.00"
                                    class="w-full px-3 py-2 border border-green-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label for="cgpaMaxFilter" class="block text-sm font-medium text-gray-700 mb-2">Max
                                    CGPA</label>
                                <input type="number" id="cgpaMaxFilter" step="0.01" min="0" max="4"
                                    placeholder="4.00"
                                    class="w-full px-3 py-2 border border-green-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <!-- Seat Status Filter -->
                            <div>
                                <label for="seatStatusFilter" class="block text-sm font-medium text-gray-700 mb-2">Seat
                                    Status</label>
                                <select id="seatStatusFilter"
                                    class="w-full px-3 py-2 border border-green-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option value="">All Status</option>
                                    <option value="assigned">Seat Assigned</option>
                                    <option value="needs_seat">Needs Seat</option>
                                </select>
                            </div>

                            <!-- Sort Options -->
                            <div>
                                <label for="sortBy" class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                                <select id="sortBy"
                                    class="w-full px-3 py-2 border border-green-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option value="application_date">Application Date</option>
                                    <option value="name">Student Name</option>
                                    <option value="cgpa">CGPA</option>
                                    <option value="department">Department</option>
                                </select>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2 mt-4">
                            <button onclick="filterApplications()"
                                class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-200">
                                Apply Filters
                            </button>
                            <button onclick="clearFilters()"
                                class="flex-1 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200">
                                Clear All
                            </button>
                        </div>
                    </div>

                    <!-- Search Info -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-sm text-green-800">
                                <strong>Note:</strong> Search and filter functions work across all approved applications.
                                Use multiple filters to narrow down results.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Applications Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Approved Applications List</h3>
                </div>

                @if ($approvedApplications->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm md:text-base" id="approvedTable">
                            <thead class="sticky top-0 z-10">
                                <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                    <th
                                        class="px-3 sm:px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                        #
                                    </th>
                                    <th
                                        class="px-3 sm:px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                        Student Information
                                    </th>
                                    <th
                                        class="hidden sm:table-cell px-3 sm:px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                        Department
                                    </th>
                                    <th
                                        class="hidden md:table-cell px-3 sm:px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                        CGPA
                                    </th>
                                    <th
                                        class="hidden lg:table-cell px-3 sm:px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                        Application Date
                                    </th>
                                    <th
                                        class="px-3 sm:px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                        Status
                                    </th>
                                    <th
                                        class="px-3 sm:px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                        Seat Status
                                    </th>
                                    <th
                                        class="px-3 sm:px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200" id="approvedTableBody">
                                @foreach ($approvedApplications as $index => $application)
                                    @php
                                        $hasActiveSeat = $application
                                            ->seatAllotments()
                                            ->where('status', 'active')
                                            ->exists();
                                    @endphp
                                    <tr class="hover:bg-gray-50 transition-colors duration-150 approved-row"
                                        data-name="{{ strtolower($application->student->name ?? 'N/A') }}"
                                        data-email="{{ strtolower($application->student->email ?? '') }}"
                                        data-department="{{ strtolower($application->department) }}"
                                        data-academic-year="{{ $application->academic_year }}"
                                        data-number-of-semester="{{ $application->number_of_semester }}"
                                        data-cgpa="{{ $application->cgpa }}"
                                        data-seat-status="{{ $hasActiveSeat ? 'assigned' : 'needs_seat' }}"
                                        data-application-date="{{ $application->application_date->format('Y-m-d') }}">
                                        <td
                                            class="px-3 sm:px-6 py-3 md:py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-3 sm:px-6 py-3 md:py-4">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-8 h-8 md:w-10 md:h-10">
                                                    @if ($application->student && $application->student->profile_image)
                                                        <img class="w-8 h-8 md:w-10 md:h-10 rounded-full object-cover border-2 border-gray-200"
                                                            src="{{ asset('storage/' . $application->student->profile_image) }}"
                                                            alt="{{ $application->student->name }}">
                                                    @else
                                                        <div
                                                            class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-gradient-to-br from-gray-400 to-gray-600 flex items-center justify-center text-white font-semibold text-xs md:text-sm border-2 border-gray-200">
                                                            {{ substr($application->student->name ?? 'N/A', 0, 1) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ml-2 md:ml-4 min-w-0 flex-1">
                                                    <div class="text-xs md:text-sm font-semibold text-gray-900 truncate">
                                                        {{ $application->student->name ?? 'N/A' }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 truncate">
                                                        {{ $application->student->email ?? 'No email' }}
                                                    </div>
                                                    <div class="text-xs text-indigo-600 font-mono">
                                                        ID: {{ $application->student->university_id ?? 'N/A' }}
                                                    </div>
                                                    <!-- Mobile-only additional info -->
                                                    <div class="sm:hidden mt-1 space-y-1">
                                                        <div class="text-xs text-gray-600">
                                                            📚 {{ $application->department }}
                                                        </div>
                                                        <div class="text-xs text-gray-600">
                                                            📊 CGPA: {{ $application->cgpa }}
                                                        </div>
                                                        <div class="text-xs text-gray-600">
                                                            📅 {{ $application->application_date->format('M d, Y') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="hidden sm:table-cell px-3 sm:px-6 py-3 md:py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $application->department }}
                                        </td>
                                        <td class="hidden md:table-cell px-3 sm:px-6 py-3 md:py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $application->cgpa }}
                                            </span>
                                        </td>
                                        <td
                                            class="hidden lg:table-cell px-3 sm:px-6 py-3 md:py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                {{ $application->application_date->format('M d, Y') }}
                                            </div>
                                        </td>
                                        <td class="px-3 sm:px-6 py-3 md:py-4 whitespace-nowrap">
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                <span aria-hidden="true"
                                                    class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                <span class="relative">{{ ucfirst($application->status) }}</span>
                                            </span>
                                        </td>
                                        <td class="px-3 sm:px-6 py-3 md:py-4 whitespace-nowrap">
                                            @if ($hasActiveSeat)
                                                <span
                                                    class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                                                    <span aria-hidden="true"
                                                        class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">Seat Assigned</span>
                                                </span>
                                            @else
                                                <span
                                                    class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                                    <span aria-hidden="true"
                                                        class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">Needs Seat</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-3 sm:px-6 py-3 md:py-4 whitespace-nowrap text-center">
                                            <div class="flex flex-col sm:flex-row gap-2 justify-center">
                                                <a href="{{ route('admin.applications.approved.show', $application->application_id) }}"
                                                    class="inline-flex items-center px-2 md:px-3 py-1 bg-indigo-600 text-white text-xs md:text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200">
                                                    <svg class="w-3 h-3 md:w-4 md:h-4 md:mr-1" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    <span class="hidden md:inline ml-1">Details</span>
                                                </a>
                                                @if (!$hasActiveSeat)
                                                    @if (auth('admin')->user()->role === 'Provost')
                                                        <a href="{{ route('provost.seats.index') }}"
                                                            class="inline-flex items-center px-2 md:px-3 py-1 bg-orange-600 text-white text-xs md:text-sm font-medium rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200">
                                                            <svg class="w-3 h-3 md:w-4 md:h-4 md:mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                            </svg>
                                                            <span class="hidden md:inline ml-1">Assign Seat</span>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('admin.seats.index') }}"
                                                            class="inline-flex items-center px-2 md:px-3 py-1 bg-orange-600 text-white text-xs md:text-sm font-medium rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200">
                                                            <svg class="w-3 h-3 md:w-4 md:h-4 md:mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                            </svg>
                                                            <span class="hidden md:inline ml-1">Assign Seat</span>
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No approved applications found</h3>
                        <p class="mt-2 text-gray-500">There are currently no approved applications to display.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.applications.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                View All Applications
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Results Summary -->
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-2">
                <div class="text-sm text-gray-700">
                    Total approved applications: <span class="font-medium">{{ $approvedApplications->count() }}</span>
                </div>
                <div class="text-sm text-gray-500">
                    Last updated: {{ now()->format('M d, Y H:i') }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function searchApplications() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const departmentFilter = document.getElementById('departmentFilter').value;
            const sessionYearFilter = document.getElementById('sessionYearFilter').value;
            const semesterFilter = document.getElementById('semesterFilter').value;
            const cgpaMinFilter = document.getElementById('cgpaMinFilter').value;
            const cgpaMaxFilter = document.getElementById('cgpaMaxFilter').value;
            const seatStatusFilter = document.getElementById('seatStatusFilter').value;

            const table = document.getElementById('approvedTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            let visibleCount = 0;

            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const name = row.getAttribute('data-name').toLowerCase();
                const email = row.getAttribute('data-email').toLowerCase();
                const department = row.getAttribute('data-department').toLowerCase();
                const academicYear = row.getAttribute('data-academic-year') || '';
                const numberOfSemester = row.getAttribute('data-number-of-semester') || '';
                const cgpa = parseFloat(row.getAttribute('data-cgpa')) || 0;
                const seatStatus = row.getAttribute('data-seat-status');

                // Check search term match
                const matchesSearch = searchTerm === '' ||
                    name.includes(searchTerm) ||
                    email.includes(searchTerm) ||
                    department.includes(searchTerm);

                // Check department filter
                const matchesDepartment = departmentFilter === '' || department === departmentFilter.toLowerCase();

                // Check session year filter
                const matchesSessionYear = sessionYearFilter === '' || academicYear === sessionYearFilter;

                // Check semester filter
                const matchesSemester = semesterFilter === '' || numberOfSemester === semesterFilter;

                // Check CGPA range filter
                const matchesCgpaMin = cgpaMinFilter === '' || cgpa >= parseFloat(cgpaMinFilter);
                const matchesCgpaMax = cgpaMaxFilter === '' || cgpa <= parseFloat(cgpaMaxFilter);

                // Check seat status filter
                const matchesSeatStatus = seatStatusFilter === '' || seatStatus === seatStatusFilter;

                if (matchesSearch && matchesDepartment && matchesSessionYear && matchesSemester && matchesCgpaMin &&
                    matchesCgpaMax && matchesSeatStatus) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }

            // Update the total count display
            const totalApplications = {{ $approvedApplications->count() }};
            const resultsSummary = document.querySelector('.text-sm.text-gray-700');
            if (resultsSummary) {
                resultsSummary.innerHTML =
                    `Showing <span class="font-medium">${visibleCount}</span> of <span class="font-medium">${totalApplications}</span> approved applications`;
            }
        }

        function filterApplications() {
            searchApplications(); // Use the combined search function
        }

        function clearFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('departmentFilter').value = '';
            document.getElementById('sessionYearFilter').value = '';
            document.getElementById('semesterFilter').value = '';
            document.getElementById('cgpaMinFilter').value = '';
            document.getElementById('cgpaMaxFilter').value = '';
            document.getElementById('seatStatusFilter').value = '';
            searchApplications();
        }

        function sortApplications() {
            const sortBy = document.getElementById('sortBy').value;
            const table = document.getElementById('approvedTable');
            const tbody = table.getElementsByTagName('tbody')[0];
            const rows = Array.from(tbody.getElementsByTagName('tr'));

            rows.sort((a, b) => {
                let aValue, bValue;

                switch (sortBy) {
                    case 'name':
                        aValue = a.getAttribute('data-name').toLowerCase();
                        bValue = b.getAttribute('data-name').toLowerCase();
                        return aValue.localeCompare(bValue);
                    case 'cgpa':
                        aValue = parseFloat(a.getAttribute('data-cgpa')) || 0;
                        bValue = parseFloat(b.getAttribute('data-cgpa')) || 0;
                        return bValue - aValue;
                    case 'department':
                        aValue = a.getAttribute('data-department').toLowerCase();
                        bValue = b.getAttribute('data-department').toLowerCase();
                        return aValue.localeCompare(bValue);
                    case 'application_date':
                    default:
                        aValue = new Date(a.getAttribute('data-application-date'));
                        bValue = new Date(b.getAttribute('data-application-date'));
                        return bValue - aValue;
                }
            });

            // Re-append sorted rows
            rows.forEach((row, index) => {
                tbody.appendChild(row);
                // Update row numbers
                const numberCell = row.getElementsByTagName('td')[0];
                numberCell.textContent = index + 1;
            });

            // Reapply search/filter after sorting
            searchApplications();
        }

        // Add event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const departmentFilter = document.getElementById('departmentFilter');
            const sessionYearFilter = document.getElementById('sessionYearFilter');
            const semesterFilter = document.getElementById('semesterFilter');
            const cgpaMinFilter = document.getElementById('cgpaMinFilter');
            const cgpaMaxFilter = document.getElementById('cgpaMaxFilter');
            const seatStatusFilter = document.getElementById('seatStatusFilter');
            const sortBy = document.getElementById('sortBy');

            if (searchInput) searchInput.addEventListener('input', searchApplications);
            if (departmentFilter) departmentFilter.addEventListener('change', searchApplications);
            if (sessionYearFilter) sessionYearFilter.addEventListener('change', searchApplications);
            if (semesterFilter) semesterFilter.addEventListener('change', searchApplications);
            if (cgpaMinFilter) cgpaMinFilter.addEventListener('input', searchApplications);
            if (cgpaMaxFilter) cgpaMaxFilter.addEventListener('input', searchApplications);
            if (seatStatusFilter) seatStatusFilter.addEventListener('change', searchApplications);
            if (sortBy) sortBy.addEventListener('change', sortApplications);
        });
    </script>
@endsection
