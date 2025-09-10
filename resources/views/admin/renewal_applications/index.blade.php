@include('layouts.admin_layout_helper')
@extends($layout)

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-6">
                <a href="{{ route('admin.dashboard') }}"
                    class="hover:text-gray-700 transition-colors duration-200 font-medium">Dashboard</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('admin.applications.index') }}"
                    class="hover:text-gray-700 transition-colors duration-200 font-medium">Seat Applications</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-800 font-semibold">Renewal Applications</span>
            </nav>

            <!-- Header Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 p-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Seat Renewal Applications</h1>
                        <p class="text-gray-600">Manage student seat renewal applications</p>
                    </div>
                    <div class="flex space-x-3">
                        <!-- PDF Download Dropdown -->
                        <div class="relative">
                            <form method="GET" action="{{ route('admin.renewal_applications.pdf.download') }}"
                                class="inline-block">
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <input type="hidden" name="status" value="{{ request('status', 'all') }}">

                                <div class="flex items-center space-x-2">
                                    <div class="relative">
                                        <select name="status" id="pdf-status-filter"
                                            class="appearance-none bg-white border border-gray-300 rounded-md px-3 py-2 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                            <option value="all"
                                                {{ request('status', 'all') == 'all' ? 'selected' : '' }}>
                                                All Applications
                                            </option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                                Pending Only
                                            </option>
                                            <option value="approved"
                                                {{ request('status') == 'approved' ? 'selected' : '' }}>
                                                Approved Only
                                            </option>
                                            <option value="rejected"
                                                {{ request('status') == 'rejected' ? 'selected' : '' }}>
                                                Rejected Only
                                            </option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        Download PDF
                                    </button>
                                </div>
                            </form>
                        </div>

                        <button onclick="sendRenewalReminders()"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                            Send Renewal Reminders
                        </button>
                        <a href="{{ route('admin.applications.index') }}"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Back to Applications
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-yellow-100 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Pending Applications</p>
                            <p class="text-2xl font-semibold text-gray-900">
                                {{ $renewalApplications->where('status', 'pending')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Approved Applications</p>
                            <p class="text-2xl font-semibold text-gray-900">
                                {{ $renewalApplications->where('status', 'approved')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-red-100 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Rejected Applications</p>
                            <p class="text-2xl font-semibold text-gray-900">
                                {{ $renewalApplications->where('status', 'rejected')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
                <form method="GET" action="{{ route('admin.renewal_applications.index') }}" class="space-y-4">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <!-- Search Bar -->
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search
                                Students</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="search" name="search" value="{{ request('search') }}"
                                    placeholder="Search by student name or university ID..."
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <!-- Status Filter -->
                        <div class="lg:w-64">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Filter by
                                Status</label>
                            <select id="status" name="status"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="all"
                                    {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>
                                    All Applications ({{ $statusCounts['all'] }})
                                </option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                    Pending ({{ $statusCounts['pending'] }})
                                </option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                                    Approved ({{ $statusCounts['approved'] }})
                                </option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                                    Rejected ({{ $statusCounts['rejected'] }})
                                </option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-end space-x-3">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Search
                            </button>
                            <a href="{{ route('admin.renewal_applications.index') }}"
                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Clear
                            </a>
                        </div>
                    </div>

                    <!-- Quick Filter Buttons -->
                    <div class="flex flex-wrap gap-2">
                        <span class="text-sm font-medium text-gray-700 mr-2">Quick Filters:</span>
                        <a href="{{ route('admin.renewal_applications.index', ['status' => 'pending']) }}"
                            data-status="pending"
                            class="quick-filter-btn inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ request('status') == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800 hover:bg-yellow-50' }}">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Pending ({{ $statusCounts['pending'] }})
                        </a>
                        <a href="{{ route('admin.renewal_applications.index', ['status' => 'approved']) }}"
                            data-status="approved"
                            class="quick-filter-btn inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ request('status') == 'approved' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800 hover:bg-green-50' }}">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Approved ({{ $statusCounts['approved'] }})
                        </a>
                        <a href="{{ route('admin.renewal_applications.index', ['status' => 'rejected']) }}"
                            data-status="rejected"
                            class="quick-filter-btn inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ request('status') == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800 hover:bg-red-50' }}">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Rejected ({{ $statusCounts['rejected'] }})
                        </a>
                        <a href="{{ route('admin.renewal_applications.index') }}" data-status="all"
                            class="quick-filter-btn inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ !request('status') || request('status') == 'all' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800 hover:bg-blue-50' }}">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            All ({{ $statusCounts['all'] }})
                        </a>
                    </div>
                </form>
            </div>

            @if ($renewalApplications->count() > 0)
                <!-- Applications Table -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Application</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Student</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Seat</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Academic Info</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Submitted</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($renewalApplications as $application)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">#{{ $application->renewal_id }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $application->submission_date->format('M d, Y') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full object-cover border-2 border-gray-200"
                                                        src="{{ $application->student->profile_image_url }}"
                                                        alt="{{ $application->student->name }}'s Profile Picture"
                                                        onerror="this.src='{{ asset('images/default-avatar.svg') }}'">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $application->student->name }}</div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $application->student->university_id }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $application->allotment->seat->floor }}F,
                                                {{ $application->allotment->seat->block }}</div>
                                            <div class="text-sm text-gray-500">Room
                                                {{ $application->allotment->seat->room_number }}, Bed
                                                {{ $application->allotment->seat->bed_number }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $application->current_semesters }}
                                                semesters</div>
                                            <div class="text-sm text-gray-500">CGPA:
                                                {{ $application->last_semester_cgpa }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($application->status === 'pending')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @elseif($application->status === 'approved')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Approved
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Rejected
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $application->submission_date->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex flex-col space-y-1">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('admin.renewal_applications.show', $application) }}"
                                                        class="text-blue-600 hover:text-blue-900">View</a>
                                                    <a href="{{ route('admin.renewal_applications.download_pdf', $application) }}"
                                                        class="text-red-600 hover:text-red-900">PDF</a>
                                                </div>
                                                @if ($application->status === 'pending')
                                                    <div class="flex space-x-2">
                                                        <button
                                                            onclick="approveApplication({{ $application->renewal_id }})"
                                                            class="text-green-600 hover:text-green-900">Approve</button>
                                                        <button
                                                            onclick="rejectApplication({{ $application->renewal_id }})"
                                                            class="text-red-600 hover:text-red-900">Reject</button>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <!-- No Applications -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Renewal Applications</h3>
                    <p class="text-gray-600">There are no seat renewal applications to review at this time.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Approval Modal -->
    <div id="approvalModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Approve Renewal Application</h3>
                </div>
                <form id="approvalForm" method="POST">
                    @csrf
                    <div class="px-6 py-4">
                        <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">Admin Notes
                            (Optional)</label>
                        <textarea id="admin_notes" name="admin_notes" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Add any notes about this approval..."></textarea>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Approve Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Rejection Modal -->
    <div id="rejectionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Reject Renewal Application</h3>
                </div>
                <form id="rejectionForm" method="POST">
                    @csrf
                    <div class="px-6 py-4">
                        <label for="rejection_notes" class="block text-sm font-medium text-gray-700 mb-2">Reason for
                            Rejection <span class="text-red-500">*</span></label>
                        <textarea id="rejection_notes" name="admin_notes" rows="3" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                            placeholder="Please provide a reason for rejection..."></textarea>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Reject Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function approveApplication(renewalId) {
            document.getElementById('approvalForm').action = `/admin/renewal-applications/${renewalId}/approve`;
            document.getElementById('approvalModal').classList.remove('hidden');
        }

        function rejectApplication(renewalId) {
            document.getElementById('rejectionForm').action = `/admin/renewal-applications/${renewalId}/reject`;
            document.getElementById('rejectionModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('approvalModal').classList.add('hidden');
            document.getElementById('rejectionModal').classList.add('hidden');
        }

        function sendRenewalReminders() {
            if (confirm('Are you sure you want to send renewal reminders to all eligible students?')) {
                fetch('/admin/send-renewal-reminders', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while sending reminders.');
                    });
            }
        }

        // Enhanced search and filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit form when status filter changes
            const statusSelect = document.getElementById('status');
            if (statusSelect) {
                statusSelect.addEventListener('change', function() {
                    this.form.submit();
                });
            }

            // Search input with debouncing
            const searchInput = document.getElementById('search');
            if (searchInput) {
                let searchTimeout;
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        // Only auto-submit if there are at least 3 characters or the field is empty
                        if (this.value.length >= 3 || this.value.length === 0) {
                            this.form.submit();
                        }
                    }, 500); // 500ms delay
                });

                // Submit on Enter key
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        this.form.submit();
                    }
                });
            }

            // Highlight search terms in results
            const searchTerm = '{{ request('search') }}';
            if (searchTerm) {
                highlightSearchTerms(searchTerm);
            }

            // Show loading state during form submission
            const form = document.querySelector('form[method="GET"]');
            if (form) {
                form.addEventListener('submit', function() {
                    const submitButton = this.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.innerHTML =
                            '<svg class="w-4 h-4 inline mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Searching...';
                        submitButton.disabled = true;
                    }
                });
            }
        });

        function highlightSearchTerms(searchTerm) {
            const searchRegex = new RegExp(`(${searchTerm})`, 'gi');
            const studentNames = document.querySelectorAll('td .text-sm.font-medium.text-gray-900');

            studentNames.forEach(element => {
                if (element.textContent.toLowerCase().includes(searchTerm.toLowerCase())) {
                    element.innerHTML = element.textContent.replace(searchRegex,
                        '<mark class="bg-yellow-200 px-1 rounded">$1</mark>');
                }
            });
        }

        // Quick filter button active state management
        function updateQuickFilterStates() {
            const currentStatus = '{{ request('status') }}';
            const quickFilterButtons = document.querySelectorAll('.quick-filter-btn');

            quickFilterButtons.forEach(button => {
                button.classList.remove('bg-blue-100', 'text-blue-800');
                button.classList.add('bg-gray-100', 'text-gray-800');
            });

            if (currentStatus) {
                const activeButton = document.querySelector(`[data-status="${currentStatus}"]`);
                if (activeButton) {
                    activeButton.classList.remove('bg-gray-100', 'text-gray-800');
                    activeButton.classList.add('bg-blue-100', 'text-blue-800');
                }
            } else {
                const allButton = document.querySelector('[data-status="all"]');
                if (allButton) {
                    allButton.classList.remove('bg-gray-100', 'text-gray-800');
                    allButton.classList.add('bg-blue-100', 'text-blue-800');
                }
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', updateQuickFilterStates);
    </script>
@endsection
