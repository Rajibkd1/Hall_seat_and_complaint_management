@include('layouts.admin_layout_helper')
@extends($layout)

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Header Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 p-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Renewal Application Details</h1>
                        <p class="text-gray-600">Application #{{ $renewalApplication->renewal_id }}</p>
                    </div>
                    <div class="flex space-x-3">
                        @if ($renewalApplication->status === 'pending')
                            <button onclick="approveApplication()"
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                Approve Application
                            </button>
                            <button onclick="rejectApplication()"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                Reject Application
                            </button>
                        @endif
                        <a href="{{ route('admin.renewal_applications.index') }}"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Application Status -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Application Status</h3>
                        <div class="flex items-center space-x-4">
                            @if ($renewalApplication->status === 'pending')
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Pending Review
                                </span>
                            @elseif($renewalApplication->status === 'approved')
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Approved
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Rejected
                                </span>
                            @endif
                            <span class="text-sm text-gray-500">
                                Submitted on {{ $renewalApplication->submission_date->format('F d, Y \a\t g:i A') }}
                            </span>
                        </div>
                    </div>

                    <!-- Student Information -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Student Information</h3>
                        <div class="flex flex-col md:flex-row gap-6">
                            <!-- Profile Picture -->
                            <div class="flex-shrink-0">
                                <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-gray-200 shadow-lg">
                                    <img src="{{ $renewalApplication->student->profile_image_url }}"
                                        alt="{{ $renewalApplication->student->name }}'s Profile Picture"
                                        class="w-full h-full object-cover"
                                        onerror="this.src='{{ asset('images/default-avatar.svg') }}'">
                                </div>
                            </div>

                            <!-- Student Details -->
                            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Name</p>
                                    <p class="font-semibold text-gray-900">{{ $renewalApplication->student->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">University ID</p>
                                    <p class="font-semibold text-gray-900">{{ $renewalApplication->student->university_id }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Email</p>
                                    <p class="font-semibold text-gray-900">{{ $renewalApplication->student->email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Phone</p>
                                    <p class="font-semibold text-gray-900">
                                        {{ $renewalApplication->student->phone ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Department</p>
                                    <p class="font-semibold text-gray-900">
                                        {{ $renewalApplication->student->department ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Session Year</p>
                                    <p class="font-semibold text-gray-900">
                                        {{ $renewalApplication->student->session_year ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Seat Information -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Current Seat Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Seat Location</p>
                                <p class="font-semibold text-gray-900">
                                    {{ $renewalApplication->allotment->seat->floor }} Floor,
                                    {{ $renewalApplication->allotment->seat->block }} Block
                                </p>
                                <p class="text-sm text-gray-500">Room
                                    {{ $renewalApplication->allotment->seat->room_number }}, Bed
                                    {{ $renewalApplication->allotment->seat->bed_number }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Allocation Period</p>
                                <p class="font-semibold text-gray-900">
                                    {{ \Carbon\Carbon::parse($renewalApplication->allotment->start_date)->format('M d, Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($renewalApplication->allotment->allocation_expiry_date)->format('M d, Y') }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    @if ($renewalApplication->allotment->remaining_days > 0)
                                        {{ $renewalApplication->allotment->remaining_days }} days remaining
                                    @else
                                        Expired
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Academic Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Current Semesters</p>
                                <p class="font-semibold text-gray-900">{{ $renewalApplication->current_semesters }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Last Semester CGPA</p>
                                <p class="font-semibold text-gray-900">{{ $renewalApplication->last_semester_cgpa }}</p>
                            </div>
                        </div>
                        @if ($renewalApplication->result_file_path)
                            <div class="mt-4">
                                <p class="text-sm text-gray-600 mb-2">Result File</p>
                                <a href="{{ Storage::url($renewalApplication->result_file_path) }}" target="_blank"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    View Result File
                                </a>
                            </div>
                        @endif
                    </div>

                    @if ($renewalApplication->additional_comments)
                        <!-- Additional Comments -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Additional Comments</h3>
                            <p class="text-gray-700">{{ $renewalApplication->additional_comments }}</p>
                        </div>
                    @endif

                    @if ($renewalApplication->status !== 'pending' && $renewalApplication->reviewed_at)
                        <!-- Review Information -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Review Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Reviewed By</p>
                                    <p class="font-semibold text-gray-900">
                                        {{ $renewalApplication->reviewer->name ?? 'Hall Administration' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Reviewed On</p>
                                    <p class="font-semibold text-gray-900">
                                        {{ $renewalApplication->reviewed_at->format('F d, Y \a\t g:i A') }}</p>
                                </div>
                            </div>
                            @if ($renewalApplication->admin_notes)
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 mb-2">Admin Notes</p>
                                    <p class="text-gray-700 bg-gray-50 p-3 rounded-md">
                                        {{ $renewalApplication->admin_notes }}</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    @if ($renewalApplication->status === 'pending')
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                            <div class="space-y-3">
                                <button onclick="approveApplication()"
                                    class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    Approve Application
                                </button>
                                <button onclick="rejectApplication()"
                                    class="w-full px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                    Reject Application
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Email Communication -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Email Communication</h3>
                        <div class="space-y-3">
                            <button onclick="openCustomEmailModal()"
                                class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Send Custom Email
                            </button>
                            <button onclick="openTemplateEmailModal()"
                                class="w-full px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Send Template Email
                            </button>
                        </div>
                    </div>

                    <!-- Application Timeline -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Timeline</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Application Submitted</p>
                                    <p class="text-sm text-gray-500">
                                        {{ $renewalApplication->submission_date->format('M d, Y \a\t g:i A') }}</p>
                                </div>
                            </div>

                            @if ($renewalApplication->status !== 'pending')
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-8 h-8 {{ $renewalApplication->status === 'approved' ? 'bg-green-100' : 'bg-red-100' }} rounded-full flex items-center justify-center">
                                            @if ($renewalApplication->status === 'approved')
                                                <svg class="w-4 h-4 text-green-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-red-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Application
                                            {{ ucfirst($renewalApplication->status) }}</p>
                                        <p class="text-sm text-gray-500">
                                            {{ $renewalApplication->reviewed_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approval Modal -->
    <div id="approvalModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Approve Renewal Application</h3>
                </div>
                <form action="{{ route('admin.renewal_applications.approve', $renewalApplication) }}" method="POST">
                    @csrf
                    <div class="px-6 py-4">
                        <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">Admin Notes
                            (Optional)</label>
                        <textarea id="admin_notes" name="admin_notes" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
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
                <form action="{{ route('admin.renewal_applications.reject', $renewalApplication) }}" method="POST">
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

    <!-- Custom Email Modal -->
    <div id="customEmailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Send Custom Email</h3>
                    <p class="text-sm text-gray-600">Send a custom email to {{ $renewalApplication->student->name }}</p>
                </div>
                <form action="{{ route('admin.renewal_applications.send_custom_email', $renewalApplication) }}"
                    method="POST">
                    @csrf
                    <div class="px-6 py-4 space-y-4">
                        <div>
                            <label for="email_subject" class="block text-sm font-medium text-gray-700 mb-2">Subject <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="email_subject" name="subject" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter email subject...">
                        </div>
                        <div>
                            <label for="email_message" class="block text-sm font-medium text-gray-700 mb-2">Message <span
                                    class="text-red-500">*</span></label>
                            <textarea id="email_message" name="message" rows="8" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter your message..."></textarea>
                        </div>
                        <div class="bg-blue-50 p-3 rounded-md">
                            <p class="text-sm text-blue-800">
                                <strong>Note:</strong> This email will be sent to {{ $renewalApplication->student->email }}
                                and will include the university logo and branding.
                            </p>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                        <button type="button" onclick="closeEmailModal()"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Send Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Template Email Modal -->
    <div id="templateEmailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Send Template Email</h3>
                    <p class="text-sm text-gray-600">Choose a predefined template to send to
                        {{ $renewalApplication->student->name }}</p>
                </div>
                <form action="{{ route('admin.renewal_applications.send_template_email', $renewalApplication) }}"
                    method="POST">
                    @csrf
                    <div class="px-6 py-4 space-y-4">
                        <div>
                            <label for="email_template" class="block text-sm font-medium text-gray-700 mb-2">Select
                                Template <span class="text-red-500">*</span></label>
                            <select id="email_template" name="template" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                onchange="updateTemplatePreview()">
                                <option value="">Choose a template...</option>
                                <option value="office_visit">Please come to the hall office</option>
                                <option value="incomplete_documents">Your documents are incomplete</option>
                                <option value="additional_info">Additional information required</option>
                                <option value="meeting_schedule">Schedule a meeting</option>
                                <option value="urgent_action">Urgent action required</option>
                                <option value="general_inquiry">General inquiry response</option>
                            </select>
                        </div>
                        <div>
                            <label for="template_subject"
                                class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <input type="text" id="template_subject" name="subject" readonly
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50">
                        </div>
                        <div>
                            <label for="template_message" class="block text-sm font-medium text-gray-700 mb-2">Message
                                Preview</label>
                            <textarea id="template_message" name="message" rows="8" readonly
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50"></textarea>
                        </div>
                        <div>
                            <label for="template_notes" class="block text-sm font-medium text-gray-700 mb-2">Additional
                                Notes (Optional)</label>
                            <textarea id="template_notes" name="additional_notes" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                placeholder="Add any additional notes to the template..."></textarea>
                        </div>
                        <div class="bg-purple-50 p-3 rounded-md">
                            <p class="text-sm text-purple-800">
                                <strong>Note:</strong> This email will be sent to {{ $renewalApplication->student->email }}
                                and will include the university logo and branding.
                            </p>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                        <button type="button" onclick="closeEmailModal()"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                            Send Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Email Sent Successfully</h3>
                </div>
                <div class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-gray-700" id="successMessage">Email has been sent successfully!</p>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end">
                    <button onclick="closeSuccessModal()"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Email Sending Failed</h3>
                </div>
                <div class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-gray-700" id="errorMessage">Failed to send email. Please try again.</p>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end">
                    <button onclick="closeErrorModal()"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Template data
        const emailTemplates = {
            office_visit: {
                subject: "Visit Required - Hall Office",
                message: `Dear {{ $renewalApplication->student->name }},

We need to discuss your seat renewal application in person. Please visit the hall office at your earliest convenience.

Application Details:
- Application ID: #{{ $renewalApplication->renewal_id }}
- Current Seat: {{ $renewalApplication->allotment->seat->floor }} Floor, Room {{ $renewalApplication->allotment->seat->room_number }}, Bed {{ $renewalApplication->allotment->seat->bed_number }}

Please bring your student ID and any relevant documents.

Office Hours: 9:00 AM - 5:00 PM (Sunday to Thursday)

Best regards,
Hall Administration
Noakhali Science and Technology University`
            },
            incomplete_documents: {
                subject: "Incomplete Documents - Renewal Application",
                message: `Dear {{ $renewalApplication->student->name }},

We have reviewed your seat renewal application and found that some documents are missing or incomplete.

Application Details:
- Application ID: #{{ $renewalApplication->renewal_id }}
- Current Seat: {{ $renewalApplication->allotment->seat->floor }} Floor, Room {{ $renewalApplication->allotment->seat->room_number }}, Bed {{ $renewalApplication->allotment->seat->bed_number }}

Required Actions:
1. Please upload a clear copy of your last semester result
2. Ensure all academic information is accurate
3. Complete any missing fields in your application

You can update your application through the student portal or visit the hall office for assistance.

Best regards,
Hall Administration
Noakhali Science and Technology University`
            },
            additional_info: {
                subject: "Additional Information Required - Renewal Application",
                message: `Dear {{ $renewalApplication->student->name }},

We need some additional information to process your seat renewal application.

Application Details:
- Application ID: #{{ $renewalApplication->renewal_id }}
- Current Seat: {{ $renewalApplication->allotment->seat->floor }} Floor, Room {{ $renewalApplication->allotment->seat->room_number }}, Bed {{ $renewalApplication->allotment->seat->bed_number }}

Please provide the following information:
1. Current semester details
2. Any changes in your academic status
3. Additional supporting documents if applicable

You can submit this information through the student portal or by visiting the hall office.

Best regards,
Hall Administration
Noakhali Science and Technology University`
            },
            meeting_schedule: {
                subject: "Meeting Request - Renewal Application",
                message: `Dear {{ $renewalApplication->student->name }},

We would like to schedule a meeting to discuss your seat renewal application.

Application Details:
- Application ID: #{{ $renewalApplication->renewal_id }}
- Current Seat: {{ $renewalApplication->allotment->seat->floor }} Floor, Room {{ $renewalApplication->allotment->seat->room_number }}, Bed {{ $renewalApplication->allotment->seat->bed_number }}

Please contact the hall office to schedule a convenient time for the meeting.

Office Hours: 9:00 AM - 5:00 PM (Sunday to Thursday)
Contact: [Hall Office Phone Number]

Best regards,
Hall Administration
Noakhali Science and Technology University`
            },
            urgent_action: {
                subject: "URGENT - Action Required - Renewal Application",
                message: `Dear {{ $renewalApplication->student->name }},

This is an urgent notice regarding your seat renewal application. Immediate action is required.

Application Details:
- Application ID: #{{ $renewalApplication->renewal_id }}
- Current Seat: {{ $renewalApplication->allotment->seat->floor }} Floor, Room {{ $renewalApplication->allotment->seat->room_number }}, Bed {{ $renewalApplication->allotment->seat->bed_number }}

Please contact the hall office immediately or visit in person as soon as possible.

Office Hours: 9:00 AM - 5:00 PM (Sunday to Thursday)
Emergency Contact: [Emergency Phone Number]

Best regards,
Hall Administration
Noakhali Science and Technology University`
            },
            general_inquiry: {
                subject: "Response to Your Inquiry - Renewal Application",
                message: `Dear {{ $renewalApplication->student->name }},

Thank you for your inquiry regarding your seat renewal application.

Application Details:
- Application ID: #{{ $renewalApplication->renewal_id }}
- Current Seat: {{ $renewalApplication->allotment->seat->floor }} Floor, Room {{ $renewalApplication->allotment->seat->room_number }}, Bed {{ $renewalApplication->allotment->seat->bed_number }}

We are currently reviewing your application and will provide an update soon. If you have any specific questions, please don't hesitate to contact us.

Best regards,
Hall Administration
Noakhali Science and Technology University`
            }
        };

        function approveApplication() {
            document.getElementById('approvalModal').classList.remove('hidden');
        }

        function rejectApplication() {
            document.getElementById('rejectionModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('approvalModal').classList.add('hidden');
            document.getElementById('rejectionModal').classList.add('hidden');
        }

        function openCustomEmailModal() {
            document.getElementById('customEmailModal').classList.remove('hidden');
        }

        function openTemplateEmailModal() {
            document.getElementById('templateEmailModal').classList.remove('hidden');
        }

        function closeEmailModal() {
            document.getElementById('customEmailModal').classList.add('hidden');
            document.getElementById('templateEmailModal').classList.add('hidden');
        }

        function updateTemplatePreview() {
            const templateSelect = document.getElementById('email_template');
            const subjectInput = document.getElementById('template_subject');
            const messageTextarea = document.getElementById('template_message');

            const selectedTemplate = templateSelect.value;

            if (selectedTemplate && emailTemplates[selectedTemplate]) {
                subjectInput.value = emailTemplates[selectedTemplate].subject;
                messageTextarea.value = emailTemplates[selectedTemplate].message;
            } else {
                subjectInput.value = '';
                messageTextarea.value = '';
            }
        }

        function closeSuccessModal() {
            document.getElementById('successModal').classList.add('hidden');
        }

        function closeErrorModal() {
            document.getElementById('errorModal').classList.add('hidden');
        }

        function showSuccessModal(message) {
            document.getElementById('successMessage').textContent = message;
            document.getElementById('successModal').classList.remove('hidden');
        }

        function showErrorModal(message) {
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('errorModal').classList.remove('hidden');
        }

        // Handle custom email form submission
        document.addEventListener('DOMContentLoaded', function() {
            const customEmailForm = document.querySelector('form[action*="send-custom-email"]');
            if (customEmailForm) {
                customEmailForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const submitButton = this.querySelector('button[type="submit"]');
                    const originalText = submitButton.textContent;

                    // Show loading state
                    submitButton.textContent = 'Sending...';
                    submitButton.disabled = true;

                    fetch(this.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                closeEmailModal();
                                showSuccessModal(data.message);
                            } else {
                                showErrorModal(data.message ||
                                    'Failed to send custom email. Please try again.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showErrorModal('Failed to send custom email. Please try again.');
                        })
                        .finally(() => {
                            submitButton.textContent = originalText;
                            submitButton.disabled = false;
                        });
                });
            }

            // Handle template email form submission
            const templateEmailForm = document.querySelector('form[action*="send-template-email"]');
            if (templateEmailForm) {
                templateEmailForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const submitButton = this.querySelector('button[type="submit"]');
                    const originalText = submitButton.textContent;

                    // Show loading state
                    submitButton.textContent = 'Sending...';
                    submitButton.disabled = true;

                    fetch(this.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                closeEmailModal();
                                showSuccessModal(data.message);
                            } else {
                                showErrorModal(data.message ||
                                    'Failed to send template email. Please try again.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showErrorModal('Failed to send template email. Please try again.');
                        })
                        .finally(() => {
                            submitButton.textContent = originalText;
                            submitButton.disabled = false;
                        });
                });
            }
        });
    </script>
@endsection
