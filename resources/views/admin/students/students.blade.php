@include('layouts.admin_layout_helper')
@extends($layout)

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100">
        <div class="container mx-auto px-4 py-6 lg:py-8">
            <!-- Header Section -->
            <div class="mb-6 lg:mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 lg:gap-6">
                    <div class="text-center lg:text-left">
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-800 mb-2">Student Directory</h1>
                        <p class="text-sm sm:text-base text-gray-600">Manage and view student information</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap justify-center lg:justify-end gap-2 sm:gap-3">
                        @if (auth()->guard('admin')->user()->role === 'Provost')
                            <a href="{{ route('provost.account.requests') }}"
                                class="inline-flex items-center px-3 py-2 sm:px-4 sm:py-2 bg-yellow-600 text-white text-sm font-medium rounded-lg hover:bg-yellow-700 transition-colors duration-200 shadow-sm hover:shadow-md">
                            @elseif(auth()->guard('admin')->user()->role === 'Co-Provost')
                                <a href="{{ route('co-provost.account.requests') }}"
                                    class="inline-flex items-center px-3 py-2 sm:px-4 sm:py-2 bg-yellow-600 text-white text-sm font-medium rounded-lg hover:bg-yellow-700 transition-colors duration-200 shadow-sm hover:shadow-md">
                                @else
                                    <a href="{{ route('admin.account.requests') }}"
                                        class="inline-flex items-center px-3 py-2 sm:px-4 sm:py-2 bg-yellow-600 text-white text-sm font-medium rounded-lg hover:bg-yellow-700 transition-colors duration-200 shadow-sm hover:shadow-md">
                        @endif
                        <svg class="w-4 h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                        <span class="hidden sm:inline">Account Requests</span>
                        <span class="sm:hidden">Requests</span>
                        </a>
                        <a href="{{ route('admin.students.pdf.generate') }}" target="_blank"
                            class="inline-flex items-center px-3 py-2 sm:px-4 sm:py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                            <span class="hidden sm:inline">View PDF</span>
                            <span class="sm:hidden">PDF</span>
                        </a>
                        <a href="{{ route('admin.students.pdf.download') }}"
                            class="inline-flex items-center px-3 py-2 sm:px-4 sm:py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <span class="hidden sm:inline">Download PDF</span>
                            <span class="sm:hidden">Download</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 lg:mb-8">
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Students</p>
                            <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ count($students) }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Departments</p>
                            <p class="text-xl sm:text-2xl font-bold text-gray-900">
                                {{ $students->unique('department')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition-shadow duration-200 sm:col-span-2 lg:col-span-1">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Active Sessions</p>
                            <p class="text-xl sm:text-2xl font-bold text-gray-900">
                                {{ $students->unique('session_year')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Advanced Search and Filter Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6 p-4 sm:p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Search & Filter Students</h3>
                </div>

                <!-- Filter Controls -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search Input -->
                    <div class="relative">
                        <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-2">Search by Name</label>
                        <input type="text" id="searchInput" placeholder="Enter student name..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <svg class="absolute left-3 top-8 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <!-- Department Filter -->
                    <div>
                        <label for="departmentFilter"
                            class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                        <select id="departmentFilter"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <option value="">All Departments</option>
                            @foreach ($students->unique('department')->sortBy('department') as $student)
                                <option value="{{ $student->department }}">{{ $student->department }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Session Year Filter -->
                    <div>
                        <label for="sessionYearFilter" class="block text-sm font-medium text-gray-700 mb-2">Session
                            Year</label>
                        <select id="sessionYearFilter"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <option value="">All Sessions</option>
                            @foreach ($students->unique('session_year')->sortBy('session_year') as $student)
                                <option value="{{ $student->session_year }}">{{ $student->session_year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Clear Filters Button -->
                    <div class="flex items-end">
                        <button id="clearFilters"
                            class="w-full px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200">
                            Clear All Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Student Records</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="studentTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors duration-150 hidden sm:table-cell"
                                    onclick="sortTable(0)">
                                    <div class="flex items-center space-x-1">
                                        <span>Serial No.</span>
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    </div>
                                </th>
                                <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors duration-150"
                                    onclick="sortTable(1)">
                                    <div class="flex items-center space-x-1">
                                        <span>Student Name</span>
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    </div>
                                </th>
                                <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors duration-150 hidden md:table-cell"
                                    onclick="sortTable(2)">
                                    <div class="flex items-center space-x-1">
                                        <span>Department</span>
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    </div>
                                </th>
                                <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors duration-150 hidden md:table-cell"
                                    onclick="sortTable(3)">
                                    <div class="flex items-center space-x-1">
                                        <span>Session Year</span>
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    </div>
                                </th>
                                <th
                                    class="px-3 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">
                                    Actions
                                </th>
                                <th
                                    class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sm:hidden">
                                    Info
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($students as $index => $student)
                                <tr class="hover:bg-gray-50 transition-colors duration-150 student-row">
                                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900 hidden sm:table-cell"
                                        data-label="Serial No.">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                <span class="text-blue-600 font-medium text-sm">{{ $index + 1 }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap hidden sm:table-cell"
                                        data-label="Student Name">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="{{ asset('storage/' . $student->profile_image) }}"
                                                    alt="{{ $student->name }}'s profile image">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $student->name }}</div>
                                                <div class="text-sm text-gray-500">Student ID: {{ $student->student_id }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap hidden md:table-cell"
                                        data-label="Department">
                                        <span
                                            class="inline-flex px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                            {{ $student->department }}
                                        </span>
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900 hidden md:table-cell"
                                        data-label="Session Year">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            {{ $student->session_year }}
                                        </div>
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-medium hidden sm:table-cell"
                                        data-label="Actions">
                                        <a href="{{ route('admin.student.profile', $student->student_id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            View Profile
                                        </a>
                                    </td>
                                    <!-- Mobile View -->
                                    <td class="px-3 sm:px-6 py-4 sm:hidden" data-label="Info">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3 min-w-0 flex-1">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <img class="h-8 w-8 rounded-full object-cover"
                                                        src="{{ asset('storage/' . $student->profile_image) }}"
                                                        alt="{{ $student->name }}'s profile image">
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <div class="text-sm font-medium text-gray-900 truncate">
                                                        {{ $student->name }}</div>
                                                    <div class="text-xs text-gray-500">ID: {{ $student->student_id }}
                                                    </div>
                                                    <div class="text-xs text-gray-600 mt-1">
                                                        <span
                                                            class="inline-flex px-2 py-0.5 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                                            {{ $student->department }}
                                                        </span>
                                                    </div>
                                                    <div class="text-xs text-gray-500 mt-1">
                                                        Session: {{ $student->session_year }}
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{ route('admin.student.profile', $student->student_id) }}"
                                                class="flex-shrink-0 inline-flex items-center px-2 py-1 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Empty State -->
                <div id="emptyState" class="hidden text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No students found</h3>
                    <p class="mt-1 text-sm text-gray-500">Try adjusting your search criteria.</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .student-row:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .search-highlight {
            background-color: #fef3c7;
            padding: 2px 4px;
            border-radius: 3px;
        }

        /* Mobile responsive improvements */
        @media (max-width: 640px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .grid {
                gap: 1rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const departmentFilter = document.getElementById('departmentFilter');
            const sessionYearFilter = document.getElementById('sessionYearFilter');
            const clearFiltersBtn = document.getElementById('clearFilters');
            const table = document.getElementById('studentTable');
            const tbody = table.querySelector('tbody');
            const emptyState = document.getElementById('emptyState');
            const rows = Array.from(tbody.querySelectorAll('.student-row'));

            // Enhanced search and filter functionality
            function filterStudents() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const selectedDepartment = departmentFilter.value;
                const selectedSessionYear = sessionYearFilter.value;
                let visibleRows = 0;

                rows.forEach(row => {
                    const studentName = row.querySelector(
                            '[data-label="Student Name"] .text-sm.font-medium')?.textContent
                    .toLowerCase() || '';
                    const department = row.querySelector('[data-label="Department"]')?.textContent.trim() ||
                        '';
                    const sessionYear = row.querySelector('[data-label="Session Year"]')?.textContent
                    .trim() || '';

                    // Check search term match
                    const matchesSearch = !searchTerm || studentName.includes(searchTerm);

                    // Check department filter
                    const matchesDepartment = !selectedDepartment || department === selectedDepartment;

                    // Check session year filter
                    const matchesSessionYear = !selectedSessionYear || sessionYear === selectedSessionYear;

                    const isVisible = matchesSearch && matchesDepartment && matchesSessionYear;

                    row.style.display = isVisible ? '' : 'none';
                    if (isVisible) visibleRows++;

                    // Remove previous highlights
                    row.querySelectorAll('.search-highlight').forEach(el => {
                        el.outerHTML = el.innerHTML;
                    });

                    // Add highlight if search term exists and row is visible
                    if (searchTerm && isVisible) {
                        highlightText(row, searchTerm);
                    }
                });

                // Show/hide empty state
                if (visibleRows === 0 && (searchTerm || selectedDepartment || selectedSessionYear)) {
                    emptyState.classList.remove('hidden');
                    tbody.style.display = 'none';
                } else {
                    emptyState.classList.add('hidden');
                    tbody.style.display = '';
                }
            }

            // Event listeners
            searchInput.addEventListener('input', filterStudents);
            departmentFilter.addEventListener('change', filterStudents);
            sessionYearFilter.addEventListener('change', filterStudents);

            clearFiltersBtn.addEventListener('click', function() {
                searchInput.value = '';
                departmentFilter.value = '';
                sessionYearFilter.value = '';
                filterStudents();
            });

            // Highlight search terms
            function highlightText(element, searchTerm) {
                const walker = document.createTreeWalker(
                    element,
                    NodeFilter.SHOW_TEXT,
                    null,
                    false
                );

                const textNodes = [];
                let node;

                while (node = walker.nextNode()) {
                    textNodes.push(node);
                }

                textNodes.forEach(textNode => {
                    const text = textNode.textContent;
                    const regex = new RegExp(`(${searchTerm})`, 'gi');

                    if (regex.test(text)) {
                        const highlightedText = text.replace(regex,
                            '<span class="search-highlight">$1</span>');
                        const wrapper = document.createElement('span');
                        wrapper.innerHTML = highlightedText;
                        textNode.parentNode.replaceChild(wrapper, textNode);
                    }
                });
            }

            // Add fade-in animation to rows
            rows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
                row.classList.add('fade-in');
            });
        });

        // Table sorting functionality
        let sortDirection = {};

        function sortTable(columnIndex) {
            const table = document.getElementById('studentTable');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('.student-row'));

            // Toggle sort direction
            sortDirection[columnIndex] = sortDirection[columnIndex] === 'asc' ? 'desc' : 'asc';

            rows.sort((a, b) => {
                let aValue = a.cells[columnIndex].textContent.trim();
                let bValue = b.cells[columnIndex].textContent.trim();

                // Handle numeric sorting for serial numbers
                if (columnIndex === 0) {
                    aValue = parseInt(aValue);
                    bValue = parseInt(bValue);
                }

                if (sortDirection[columnIndex] === 'asc') {
                    return aValue > bValue ? 1 : -1;
                } else {
                    return aValue < bValue ? 1 : -1;
                }
            });

            // Re-append sorted rows
            rows.forEach(row => tbody.appendChild(row));

            // Update visual indicators
            updateSortIndicators(columnIndex);
        }

        function updateSortIndicators(activeColumn) {
            const headers = document.querySelectorAll('th[onclick]');
            headers.forEach((header, index) => {
                const svg = header.querySelector('svg');
                if (index === activeColumn) {
                    svg.classList.remove('text-gray-400');
                    svg.classList.add(sortDirection[activeColumn] === 'asc' ? 'text-blue-600' : 'text-blue-600');
                } else {
                    svg.classList.remove('text-blue-600');
                    svg.classList.add('text-gray-400');
                }
            });
        }
    </script>

    <!-- Success Modal -->
    @if (session('success'))
        <div id="successModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
            <div
                class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-100 animate-pulse">
                <div class="p-8">
                    <div
                        class="flex items-center justify-center w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-green-100 to-green-200 rounded-full shadow-lg">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 text-center mb-3">Account Activated!</h3>
                    <p class="text-gray-600 text-center mb-8 leading-relaxed">{{ session('success') }}</p>
                    <div class="flex justify-center">
                        <button onclick="closeSuccessModal()"
                            class="px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Continue
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function closeSuccessModal() {
                const modal = document.getElementById('successModal');
                if (modal) {
                    modal.style.opacity = '0';
                    modal.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        modal.style.display = 'none';
                    }, 200);
                }
            }

            // Auto close modal after 4 seconds
            setTimeout(function() {
                const modal = document.getElementById('successModal');
                if (modal) {
                    closeSuccessModal();
                }
            }, 4000);

            // Close modal when clicking outside
            document.getElementById('successModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeSuccessModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeSuccessModal();
                }
            });
        </script>
    @endif
@endsection
