@include('layouts.admin_layout_helper')
@extends($layout)

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Priority-Based Applications</h1>
                        <p class="mt-2 text-gray-600">View and manage applications based on priority scoring system</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.applications.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 focus:ring-offset-2 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Applications
                        </a>
                    </div>
                </div>
            </div>

            <!-- Priority Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium opacity-90">High Priority</p>
                            <p class="text-2xl font-bold">
                                {{ $applications->filter(function ($app) {return $app->getPriorityLevel() === 'High';})->count() }}
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium opacity-90">Medium Priority</p>
                            <p class="text-2xl font-bold">
                                {{ $applications->filter(function ($app) {return $app->getPriorityLevel() === 'Medium';})->count() }}
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium opacity-90">Low Priority</p>
                            <p class="text-2xl font-bold">
                                {{ $applications->filter(function ($app) {return $app->getPriorityLevel() === 'Low';})->count() }}
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium opacity-90">Avg Score</p>
                            <p class="text-2xl font-bold">{{ number_format($applications->avg('score'), 1) }}%</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Priority Filtering Section -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-6 p-6">
                <h3 class="text-lg font-semibold text-purple-800 mb-4">Priority-Based Filtering</h3>
                <form method="GET" action="{{ request()->url() }}" class="space-y-4">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="priority_filters[]" value="phd"
                                {{ in_array('phd', request('priority_filters', [])) ? 'checked' : '' }}
                                class="rounded border-purple-300 text-purple-600 focus:ring-purple-500">
                            <span class="text-sm text-purple-700">PhD Students</span>
                        </label>

                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="priority_filters[]" value="high_cgpa"
                                {{ in_array('high_cgpa', request('priority_filters', [])) ? 'checked' : '' }}
                                class="rounded border-purple-300 text-purple-600 focus:ring-purple-500">
                            <span class="text-sm text-purple-700">High CGPA (≥3.5)</span>
                        </label>

                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="priority_filters[]" value="distance"
                                {{ in_array('distance', request('priority_filters', [])) ? 'checked' : '' }}
                                class="rounded border-purple-300 text-purple-600 focus:ring-purple-500">
                            <span class="text-sm text-purple-700">Far Distance (≥50km)</span>
                        </label>

                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="priority_filters[]" value="guardian_deceased"
                                {{ in_array('guardian_deceased', request('priority_filters', [])) ? 'checked' : '' }}
                                class="rounded border-purple-300 text-purple-600 focus:ring-purple-500">
                            <span class="text-sm text-purple-700">Guardian Deceased</span>
                        </label>

                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="priority_filters[]" value="extracurricular"
                                {{ in_array('extracurricular', request('priority_filters', [])) ? 'checked' : '' }}
                                class="rounded border-purple-300 text-purple-600 focus:ring-purple-500">
                            <span class="text-sm text-purple-700">Many Activities (≥3)</span>
                        </label>

                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="priority_filters[]" value="senior_student"
                                {{ in_array('senior_student', request('priority_filters', [])) ? 'checked' : '' }}
                                class="rounded border-purple-300 text-purple-600 focus:ring-purple-500">
                            <span class="text-sm text-purple-700">Senior Students (≥2y)</span>
                        </label>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search by name, email, or department..."
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">

                        <select name="status"
                            class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved
                            </option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected
                            </option>
                            <option value="waitlisted" {{ request('status') == 'waitlisted' ? 'selected' : '' }}>
                                Waitlisted</option>
                            <option value="allocated" {{ request('status') == 'allocated' ? 'selected' : '' }}>Allocated
                            </option>
                        </select>

                        <button type="submit"
                            class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors duration-200">
                            Apply Filters
                        </button>

                        <a href="{{ request()->url() }}"
                            class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200">
                            Clear All
                        </a>
                    </div>
                </form>
            </div>

            <!-- Applications Table -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm md:text-base">
                        <thead class="sticky top-0 z-10">
                            <tr class="bg-gradient-to-r from-purple-50 to-indigo-50">
                                <th
                                    class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                    #
                                </th>
                                <th
                                    class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b-2 border-gray-200">
                                    Student
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
                    <div class="overflow-y-auto" style="max-height: 600px;">
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
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
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
                                            <div class="flex flex-col items-start space-y-2">
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-lg font-bold text-gray-900">
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
                                                            $priorityColors[$priorityLevel] ??
                                                            'bg-gray-100 text-gray-800';
                                                    @endphp
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $color }}">
                                                        {{ $priorityLevel }}
                                                    </span>
                                                </div>

                                                <!-- Detailed Score Breakdown -->
                                                <div class="w-full">
                                                    @php
                                                        $breakdown = $application->getScoreBreakdown();
                                                        $totalScore = array_sum($breakdown);
                                                    @endphp
                                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                                        <div class="bg-gradient-to-r from-purple-500 to-indigo-500 h-2 rounded-full"
                                                            style="width: {{ ($totalScore / 100) * 100 }}%"></div>
                                                    </div>
                                                    <div class="mt-2 space-y-1">
                                                        @foreach ($breakdown as $factor => $score)
                                                            @if ($score > 0)
                                                                <div class="flex justify-between text-xs">
                                                                    <span
                                                                        class="text-gray-600">{{ ucfirst(str_replace('_', ' ', $factor)) }}</span>
                                                                    <span
                                                                        class="font-medium text-gray-900">{{ $score }}
                                                                        pts</span>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-center">
                                            <div class="flex flex-col space-y-2">
                                                <a href="{{ route('admin.applications.view', $application->application_id) }}"
                                                    class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white text-xs font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    View Details
                                                </a>

                                                <a href="{{ route('admin.applications.download_pdf', $application->application_id) }}"
                                                    class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-xs font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                    Download PDF
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($applications->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No applications found</h3>
                        <p class="mt-1 text-sm text-gray-500">Try adjusting your filters or search criteria.</p>
                    </div>
                @endif
            </div>

            <!-- Results Summary -->
            <div class="mt-6 flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Total applications: <span class="font-medium">{{ $applications->count() }}</span>
                </div>
                <div class="text-sm text-gray-500">
                    Applications sorted by priority score (highest first)
                </div>
            </div>
        </div>
    </div>

    <script>
        // Search and filter functionality
        function searchApplications() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('.application-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const name = row.getAttribute('data-name').toLowerCase();
                const email = row.getAttribute('data-email').toLowerCase();
                const department = row.getAttribute('data-department').toLowerCase();
                const date = row.getAttribute('data-date');
                const status = row.getAttribute('data-status');

                const matchesSearch = name.includes(searchTerm) ||
                    email.includes(searchTerm) ||
                    department.includes(searchTerm) ||
                    date.includes(searchTerm) ||
                    status.includes(searchTerm);

                if (matchesSearch) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Update the total count display
            const totalApplications = {{ $applications->count() }};
            const resultsSummary = document.querySelector('.text-sm.text-gray-700');
            if (resultsSummary) {
                resultsSummary.innerHTML =
                    `Showing <span class="font-medium">${visibleCount}</span> of <span class="font-medium">${totalApplications}</span> applications`;
            }
        }

        // Add event listener for search input
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', searchApplications);
            }
        });
    </script>
@endsection
