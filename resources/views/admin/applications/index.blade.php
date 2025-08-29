@include('layouts.admin_layout_helper')
@extends($layout)

@section('content')
    <div class="container mx-auto p-6">
        <!-- Enhanced Header Section -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8">
            <div class="mb-4 lg:mb-0">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Seat Application Management</h1>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.applications.approved') }}"
                    class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-lg hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Approved Applications
                </a>
                <a href="{{ route('admin.applications.pdf.generate') }}" target="_blank"
                    class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-lg hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Generate PDF Report
                </a>
            </div>
        </div>

        <!-- Application Statistics -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-4 md:p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs md:text-sm font-medium opacity-90">Total Applications</p>
                        <p class="text-xl md:text-3xl font-bold">{{ $applications->count() }}</p>
                    </div>
                    <div class="w-8 h-8 md:w-12 md:h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl p-4 md:p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs md:text-sm font-medium opacity-90">Pending Review</p>
                        <p class="text-xl md:text-3xl font-bold">{{ $applications->where('status', 'pending')->count() }}
                        </p>
                    </div>
                    <div class="w-8 h-8 md:w-12 md:h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-4 md:p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs md:text-sm font-medium opacity-90">Approved</p>
                        <p class="text-xl md:text-3xl font-bold">{{ $applications->where('status', 'approved')->count() }}
                        </p>
                    </div>
                    <div class="w-8 h-8 md:w-12 md:h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl p-4 md:p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs md:text-sm font-medium opacity-90">Rejected</p>
                        <p class="text-xl md:text-3xl font-bold">{{ $applications->where('status', 'rejected')->count() }}
                        </p>
                    </div>
                    <div class="w-8 h-8 md:w-12 md:h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-4 md:p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs md:text-sm font-medium opacity-90">High Priority</p>
                        <p class="text-xl md:text-3xl font-bold">
                            {{ $applications->filter(function ($app) {return $app->getPriorityLevel() === 'High';})->count() }}
                        </p>
                    </div>
                    <div class="w-8 h-8 md:w-12 md:h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl p-4 md:p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs md:text-sm font-medium opacity-90">Avg Priority Score</p>
                        <p class="text-xl md:text-3xl font-bold">{{ number_format($applications->avg('score'), 1) }}%</p>
                    </div>
                    <div class="w-8 h-8 md:w-12 md:h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons Section -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-6 p-4 md:p-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.applications.priority') }}"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-indigo-700 focus:ring-4 focus:ring-purple-300 focus:ring-offset-2 transition-all duration-200 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Priority-Based Applications
                    </a>

                    <a href="{{ route('admin.applications.pdf.generate') }}"
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 focus:ring-offset-2 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Generate PDF Report
                    </a>
                </div>

                <div class="text-sm text-gray-600">
                    <span class="font-medium">Total Applications:</span> {{ $applications->count() }}
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-6 p-4 md:p-6">
            <div class="space-y-4">
                <!-- Quick Search Section -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-blue-800 mb-3">Quick Search & Filter</h3>
                    <div class="flex flex-wrap items-center gap-3">
                        <input type="text" id="searchInput" placeholder="Search by name, email, or department..."
                            class="flex-1 px-4 py-2 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        <select id="statusFilter"
                            class="px-3 py-2 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="waitlisted">Waitlisted</option>
                            <option value="allocated">Allocated</option>
                        </select>

                        <button onclick="filterApplications()"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                            Apply Filters
                        </button>

                        <button onclick="clearFilters()"
                            class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200">
                            Clear All
                        </button>
                    </div>
                </div>

                <!-- Search Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm text-blue-800">
                            <strong>Note:</strong> Search and filter functions work across all applications. Scroll down to
                            view more applications.
                        </p>
                    </div>
                </div>

                <!-- Search Field -->
                <div class="w-full">
                    <div class="relative">
                        <input type="text" id="searchInput"
                            placeholder="Search applications by name, email, or department..."
                            oninput="searchApplications()"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 text-sm md:text-base">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Filter Controls -->
                <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Filter & Sort</h3>
                    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                        <select id="statusFilter" onchange="filterApplications()"
                            class="px-3 md:px-4 py-2 md:py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 text-sm md:text-base">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="verified">Verified</option>
                            <option value="rejected">Rejected</option>
                            <option value="waitlisted">Waitlisted</option>
                        </select>
                        <select id="sortBy" onchange="sortApplications()"
                            class="px-3 md:px-4 py-2 md:py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 text-sm md:text-base">
                            <option value="date_desc">Latest First</option>
                            <option value="date_asc">Oldest First</option>
                            <option value="name_asc">Name A-Z</option>
                            <option value="name_desc">Name Z-A</option>
                            <option value="status">By Status</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Applications Table -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm md:text-base" id="applicationsTable">
                    <thead class="sticky top-0 z-10">
                        <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <th
                                class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                #
                            </th>
                            <th
                                class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                Student Information
                            </th>
                            <th
                                class="hidden sm:table-cell px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                Department
                            </th>
                            <th
                                class="hidden md:table-cell px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                Application Date
                            </th>
                            <th
                                class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                Status
                            </th>
                            <th
                                class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                Priority Score
                            </th>
                            <th
                                class="px-3 md:px-6 py-3 md:py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                Actions
                            </th>
                        </tr>
                    </thead>
                </table>
                <div class="overflow-y-auto" style="max-height: 400px;">
                    <table class="min-w-full text-sm md:text-base">
                        <tbody class="divide-y divide-gray-200" id="applicationsTableBody">
                            @foreach ($applications as $index => $application)
                                <tr class="hover:bg-gray-50 transition-colors duration-150 application-row"
                                    data-status="{{ $application->status }}"
                                    data-name="{{ $application->student->name ?? 'N/A' }}"
                                    data-date="{{ $application->application_date->format('Y-m-d') }}"
                                    data-email="{{ $application->student->email ?? '' }}"
                                    data-department="{{ $application->department }}">
                                    <td
                                        class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-3 md:px-6 py-3 md:py-4">
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
                                                <!-- Mobile-only department and date -->
                                                <div class="sm:hidden mt-1 space-y-1">
                                                    <div class="text-xs text-gray-600">
                                                        📚 {{ $application->department }}
                                                    </div>
                                                    <div class="text-xs text-gray-600">
                                                        📅 {{ $application->application_date->format('M d, Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="hidden sm:table-cell px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $application->department }}
                                    </td>
                                    <td
                                        class="hidden md:table-cell px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            {{ $application->application_date->format('M d, Y') }}
                                        </div>
                                    </td>
                                    <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'pending' => [
                                                    'bg' => 'bg-yellow-100',
                                                    'text' => 'text-yellow-800',
                                                    'icon' => '⏳',
                                                ],
                                                'approved' => [
                                                    'bg' => 'bg-green-100',
                                                    'text' => 'text-green-800',
                                                    'icon' => '✅',
                                                ],
                                                'verified' => [
                                                    'bg' => 'bg-emerald-100',
                                                    'text' => 'text-emerald-800',
                                                    'icon' => '🔒',
                                                ],
                                                'rejected' => [
                                                    'bg' => 'bg-red-100',
                                                    'text' => 'text-red-800',
                                                    'icon' => '❌',
                                                ],
                                                'waitlisted' => [
                                                    'bg' => 'bg-blue-100',
                                                    'text' => 'text-blue-800',
                                                    'icon' => '📋',
                                                ],
                                                'allocated' => [
                                                    'bg' => 'bg-purple-100',
                                                    'text' => 'text-purple-800',
                                                    'icon' => '🏠',
                                                ],
                                            ];
                                            $status = $application->status;
                                            $color = $statusColors[$status] ?? $statusColors['pending'];
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2 md:px-3 py-1 rounded-full text-xs font-semibold {{ $color['bg'] }} {{ $color['text'] }}">
                                            <span class="mr-1">{{ $color['icon'] }}</span>
                                            <span class="hidden sm:inline">{{ ucfirst($status) }}</span>
                                            <span class="sm:hidden">{{ substr(ucfirst($status), 0, 3) }}</span>
                                        </span>
                                    </td>
                                    <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap">
                                        <div class="flex flex-col items-start space-y-1">
                                            <div class="flex items-center space-x-2">
                                                <span class="text-sm font-semibold text-gray-900">
                                                    {{ number_format($application->getPriorityScorePercentage(), 1) }}%
                                                </span>
                                                @php
                                                    $priorityLevel = $application->getPriorityLevel();
                                                    $priorityColors = [
                                                        'High' => 'bg-red-100 text-red-800',
                                                        'Medium' => 'bg-yellow-100 text-yellow-800',
                                                        'Low' => 'bg-green-100 text-green-800',
                                                    ];
                                                    $color =
                                                        $priorityColors[$priorityLevel] ?? 'bg-gray-100 text-gray-800';
                                                @endphp
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $color }}">
                                                    {{ $priorityLevel }}
                                                </span>
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                @php
                                                    $breakdown = $application->getScoreBreakdown();
                                                    $topFactors = array_slice($breakdown, 0, 2);
                                                @endphp
                                                @foreach ($topFactors as $factor => $score)
                                                    @if ($score > 0)
                                                        <span
                                                            class="inline-block bg-gray-100 text-gray-600 px-1 py-0.5 rounded text-xs mr-1">
                                                            {{ ucfirst(str_replace('_', ' ', $factor)) }}:
                                                            {{ $score }}
                                                        </span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('admin.applications.view', $application->application_id) }}"
                                            class="inline-flex items-center px-2 md:px-3 py-2 bg-indigo-600 text-white text-xs md:text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200">
                                            <svg class="w-3 h-3 md:w-4 md:h-4 md:mr-1" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            <span class="hidden md:inline ml-1">Review</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($applications->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No applications found</h3>
                    <p class="mt-2 text-gray-500">There are currently no seat applications to display.</p>
                </div>
            @endif
        </div>

        <!-- Results Summary -->
        <div class="mt-6 flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Total applications: <span class="font-medium">{{ $applications->count() }}</span>
            </div>
            <div class="text-sm text-gray-500">
                Scroll down to view more applications
            </div>
        </div>
    </div>

    <script>
        function searchApplications() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const table = document.getElementById('applicationsTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            let visibleCount = 0;

            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const name = row.getAttribute('data-name').toLowerCase();
                const email = row.getAttribute('data-email').toLowerCase();
                const department = row.getAttribute('data-department').toLowerCase();

                const matchesSearch = searchTerm === '' ||
                    name.includes(searchTerm) ||
                    email.includes(searchTerm) ||
                    department.includes(searchTerm);

                const statusFilter = document.getElementById('statusFilter').value;
                const status = row.getAttribute('data-status');
                const matchesStatus = statusFilter === '' || status === statusFilter;

                if (matchesSearch && matchesStatus) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }

            // Update the total count display
            const totalApplications = {{ $applications->count() }};
            const resultsSummary = document.querySelector('.text-sm.text-gray-700');
            if (resultsSummary) {
                resultsSummary.innerHTML =
                    `Showing <span class="font-medium">${visibleCount}</span> of <span class="font-medium">${totalApplications}</span> applications`;
            }
        }

        function filterApplications() {
            searchApplications(); // Use the combined search function
        }

        function clearFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('statusFilter').value = '';
            searchApplications();
        }

        function sortApplications() {
            const sortBy = document.getElementById('sortBy').value;
            const table = document.getElementById('applicationsTable');
            const tbody = table.getElementsByTagName('tbody')[0];
            const rows = Array.from(tbody.getElementsByTagName('tr'));

            rows.sort((a, b) => {
                let aValue, bValue;

                switch (sortBy) {
                    case 'date_desc':
                        aValue = new Date(a.getAttribute('data-date'));
                        bValue = new Date(b.getAttribute('data-date'));
                        return bValue - aValue;
                    case 'date_asc':
                        aValue = new Date(a.getAttribute('data-date'));
                        bValue = new Date(b.getAttribute('data-date'));
                        return aValue - bValue;
                    case 'name_asc':
                        aValue = a.getAttribute('data-name').toLowerCase();
                        bValue = b.getAttribute('data-name').toLowerCase();
                        return aValue.localeCompare(bValue);
                    case 'name_desc':
                        aValue = a.getAttribute('data-name').toLowerCase();
                        bValue = b.getAttribute('data-name').toLowerCase();
                        return bValue.localeCompare(aValue);
                    case 'status':
                        aValue = a.getAttribute('data-status');
                        bValue = b.getAttribute('data-status');
                        return aValue.localeCompare(bValue);
                    default:
                        return 0;
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
    </script>
@endsection
