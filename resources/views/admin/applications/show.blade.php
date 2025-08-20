@extends('layouts.admin_app')

@section('content')
    <div class="min-h-screen bg-gray-50 p-6">
        <div class="max-w-7xl mx-auto">

            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                <div class="bg-gray-800 rounded-t-lg px-8 py-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-semibold text-white mb-1">Seat Application Review</h1>
                            <p class="text-gray-300 text-sm">Application details and status management</p>
                        </div>
                        <a href="{{ route('admin.applications.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-700 border border-gray-600 text-white font-medium rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors duration-200">
                            <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Back to Applications
                        </a>
                    </div>
                </div>
            </div>

            @if ($application)
                <!-- Student Profile Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6 overflow-hidden">
                    <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                        <div class="flex flex-col md:flex-row items-start md:items-center">
                            <div class="relative mb-4 md:mb-0 md:mr-6">
                                @if ($application->student && $application->student->profile_image)
                                    <img src="{{ asset('storage/' . $application->student->profile_image) }}"
                                        alt="Profile Image"
                                        class="w-20 h-20 rounded-lg object-cover border-2 border-gray-300">
                                @else
                                    <div
                                        class="w-20 h-20 rounded-lg bg-gray-600 flex items-center justify-center text-white text-xl font-semibold border-2 border-gray-300">
                                        {{ substr($application->student->name ?? 'N/A', 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h2 class="text-xl font-semibold text-gray-900 mb-2">
                                    {{ $application->student->name ?? 'Student Name N/A' }}</h2>
                                <div class="flex flex-wrap items-center gap-4 text-gray-600 text-sm">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                        {{ $application->student->email ?? 'No email provided' }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        ID: {{ $application->university_id }}
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium
                                    {{ $application->status === 'approved'
                                        ? 'bg-green-100 text-green-800'
                                        : ($application->status === 'pending'
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : ($application->status === 'rejected'
                                                ? 'bg-red-100 text-red-800'
                                                : ($application->status === 'waitlisted'
                                                    ? 'bg-blue-100 text-blue-800'
                                                    : 'bg-gray-100 text-gray-800'))) }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Information Cards Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Academic Details Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                </svg>
                                Academic & Program Details
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Student Name</span>
                                    <span class="text-sm text-gray-900">{{ $application->student_name }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Department</span>
                                    <span class="text-sm text-gray-900">{{ $application->department }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Academic Year</span>
                                    <span class="text-sm text-gray-900">{{ $application->academic_year }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Program</span>
                                    <span class="text-sm text-gray-900">{{ ucfirst($application->program) }}</span>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Year</span>
                                        <span class="text-sm text-gray-900">{{ $application->semester_year }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Term</span>
                                        <span class="text-sm text-gray-900">{{ $application->semester_term }}</span>
                                    </div>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">CGPA</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $application->cgpa }}</span>
                                </div>
                                <div class="flex justify-between py-2">
                                    <span class="text-sm font-medium text-gray-600">Application Date</span>
                                    <span
                                        class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($application->application_date)->format('F j, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                                Personal & Guardian Information
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Guardian Name</span>
                                    <span class="text-sm text-gray-900">{{ $application->guardian_name }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Guardian Mobile</span>
                                    <span class="text-sm text-gray-900">{{ $application->guardian_mobile }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Relationship</span>
                                    <span class="text-sm text-gray-900">{{ $application->guardian_relationship }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Physical Condition</span>
                                    <span
                                        class="text-sm text-gray-900">{{ ucfirst($application->physical_condition) }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Family Status</span>
                                    <span
                                        class="text-sm text-gray-900">{{ str_replace('-', ' ', ucfirst($application->family_status)) }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Permanent Address</span>
                                    <span
                                        class="text-sm text-gray-900">{{ $application->permanent_address ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between py-2">
                                    <span class="text-sm font-medium text-gray-600">Current Address</span>
                                    <span
                                        class="text-sm text-gray-900">{{ $application->current_address ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documents Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd" />
                            </svg>
                            Uploaded Documents
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                            @php
                                $documents = [
                                    'university_id_doc' => 'University ID Document',
                                    'marksheet_doc' => 'Marksheet',
                                    'birth_certificate_doc' => 'Birth Certificate',
                                    'financial_certificate_doc' => 'Financial Certificate',
                                    'death_certificate_doc' => 'Death Certificate',
                                    'medical_certificate_doc' => 'Medical Certificate',
                                    'activity_certificate_doc' => 'Activity Certificate',
                                    'signature_doc' => 'Signature',
                                ];
                            @endphp

                            @foreach ($documents as $field => $label)
                                @if (!empty($application->{$field}))
                                    <div
                                        class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:shadow-md transition-shadow duration-200">
                                        <h4 class="font-medium text-gray-800 mb-2 text-center">{{ $label }}</h4>
                                        <a href="{{ asset('storage/' . $application->{$field}) }}" target="_blank"
                                            class="block">
                                            @if (Str::endsWith($application->{$field}, ['.jpg', '.jpeg', '.png', '.gif', '.webp']))
                                                <img src="{{ asset('storage/' . $application->{$field}) }}"
                                                    alt="{{ $label }}"
                                                    class="w-full h-24 object-cover rounded border border-gray-300 mb-2">
                                            @elseif(Str::endsWith($application->{$field}, ['.pdf']))
                                                <div
                                                    class="w-full h-24 flex items-center justify-center bg-gray-100 rounded border border-gray-300 mb-2">
                                                    <svg class="w-8 h-8 text-gray-600" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            @else
                                                <div
                                                    class="w-full h-24 flex items-center justify-center bg-gray-100 rounded border border-gray-300 mb-2">
                                                    <svg class="w-8 h-8 text-gray-600" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="text-center">
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                    View Document
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Action Forms Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Status Update Form -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Update Application Status
                            </h3>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('admin.applications.update_status', $application->application_id) }}"
                                method="POST" class="space-y-4">
                                @csrf
                                @method('PATCH')

                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Select New
                                        Status</label>
                                    <select name="status" id="status"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        <option value="pending"
                                            {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved"
                                            {{ $application->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected"
                                            {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        <option value="waitlisted"
                                            {{ $application->status === 'waitlisted' ? 'selected' : '' }}>Waitlisted
                                        </option>
                                    </select>
                                </div>

                                <div>
                                    <label for="email_message"
                                        class="block text-sm font-medium text-gray-700 mb-1">Message to Student
                                        (Optional)</label>
                                    <textarea name="email_message" id="email_message" rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                        placeholder="Enter a message to explain the status change..."></textarea>
                                    <p class="mt-1 text-xs text-gray-500">This message will be sent via email if
                                        notification is enabled</p>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="send_email" value="1"
                                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Send Email Notification</span>
                                    </label>
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                        Update Status
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Custom Email Form -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                Send Custom Email
                            </h3>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('admin.applications.send_email', $application->application_id) }}"
                                method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Email
                                        Subject</label>
                                    <input type="text" name="subject" id="subject"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        placeholder="Enter email subject..." required>
                                </div>
                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Email
                                        Message</label>
                                    <textarea name="message" id="message" rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                        placeholder="Enter your message..." required></textarea>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                        Send Email
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
                    <p class="text-xl text-gray-700 font-semibold">Application not found.</p>
                    <a href="{{ route('admin.applications.index') }}"
                        class="inline-block mt-6 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-150">
                        Back to Applications List
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Success Modal -->
    @if (session('show_status_update_modal'))
        <div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Status Updated Successfully!</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500">
                            {{ session('success') }}
                        </p>
                        @if (session('email_sent'))
                            <p class="text-sm text-green-600 mt-2">
                                <svg class="inline h-4 w-4 mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Email notification sent successfully.
                            </p>
                        @elseif(session('email_sent') === false)
                            <p class="text-sm text-gray-600 mt-2">
                                <svg class="inline h-4 w-4 mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728">
                                    </path>
                                </svg>
                                No email notification sent (as requested).
                            </p>
                        @endif
                    </div>
                    <div class="items-center px-4 py-3">
                        <button id="closeModal"
                            class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                            OK
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('successModal');
                const closeModalBtn = document.getElementById('closeModal');

                // Show modal on page load if session variable is set
                if (modal) {
                    modal.style.display = 'block';

                    // Close modal functionality
                    if (closeModalBtn) {
                        closeModalBtn.addEventListener('click', function() {
                            modal.style.display = 'none';
                        });
                    }

                    // Close modal when clicking outside
                    modal.addEventListener('click', function(e) {
                        if (e.target === this) {
                            this.style.display = 'none';
                        }
                    });
                }

                // Close modal with Escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && modal && modal.style.display === 'block') {
                        modal.style.display = 'none';
                    }
                });
            });
        </script>
    @endif

@endsection
