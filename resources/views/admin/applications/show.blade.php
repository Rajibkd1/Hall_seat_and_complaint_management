@extends('layouts.admin_app')

@section('content')
<div class="min-h-screen bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg p-8">

        <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-200">
            <h1 class="text-4xl font-extrabold text-gray-900">Application Details</h1>
            <a href="{{ route('admin.applications.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Applications
            </a>
        </div>

        @if($application)
        <div class="flex flex-col md:flex-row items-start md:items-center bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6 mb-8 shadow-sm">
            @if($application->student && $application->student->profile_image)
            <img src="{{ asset('storage/' . $application->student->profile_image) }}" alt="Profile Image" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md mr-6 mb-4 md:mb-0">
            @else
            <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 text-5xl font-semibold mr-6 mb-4 md:mb-0">
                {{ substr($application->student->name ?? 'N/A', 0, 1) }}
            </div>
            @endif
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-1">{{ $application->student->name ?? 'Student Name N/A' }}</h2>
                <p class="text-md text-gray-600">
                    <span class="font-medium">Email:</span> {{ $application->student->email ?? 'No email provided' }}
                </p>
                <div class="mt-3">
                    <span class="px-4 py-2 rounded-full text-sm font-semibold 
                            {{ $application->status === 'approved' ? 'bg-green-100 text-green-800' : 
                               ($application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                               ($application->status === 'rejected' ? 'bg-red-100 text-red-800' : 
                               ($application->status === 'waitlisted' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'))) }}">
                        Status: {{ ucfirst($application->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-200">
                <h3 class="text-2xl font-bold text-gray-800 mb-5 border-b pb-3 border-gray-200">Academic & Program Details</h3>
                <div class="space-y-4">
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">Student Name:</strong> {{ $application->student_name }}</p>
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">University ID:</strong> {{ $application->university_id }}</p>
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">Department:</strong> {{ $application->department }}</p>
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">Academic Year:</strong> {{ $application->academic_year }}</p>
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">Program:</strong> {{ ucfirst($application->program) }}</p>
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">Current Year (Semester Year):</strong> {{ $application->semester_year }}</p>
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">Term (Semester Term):</strong> {{ $application->semester_term }}</p>
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">CGPA:</strong> {{ $application->cgpa }}</p>
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">Application Date:</strong> {{ \Carbon\Carbon::parse($application->application_date)->format('F j, Y') }}</p>
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">Co-curricular Activities:</strong>
                        @if(!empty($application->activities))
                        {{ implode(', ', is_array($application->activities) ? $application->activities : json_decode($application->activities, true) ?? []) }}
                        @else
                        N/A
                        @endif
                    </p>
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">Other Information:</strong>
                        @if(!empty($application->other_info))
                        {{ implode(', ', is_array($application->other_info) ? $application->other_info : json_decode($application->other_info, true) ?? []) }}
                        @else
                        N/A
                        @endif
                    </p>
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-200">
                <h3 class="text-2xl font-bold text-gray-800 mb-5 border-b pb-3 border-gray-200">Personal & Guardian Information</h3>
                <div class="space-y-4">
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">Guardian Name:</strong> {{ $application->guardian_name }}</p>
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">Guardian Mobile:</strong> {{ $application->guardian_mobile }}</p>
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">Guardian Relationship:</strong> {{ $application->guardian_relationship }}</p>
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">Physical Condition:</strong> {{ ucfirst($application->physical_condition) }}</p>
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">Family Status:</strong> {{ str_replace('-', ' ', ucfirst($application->family_status)) }}</p>
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">Permanent Address:</strong> {{ $application->permanent_address ?? 'N/A' }}</p>
                    <p class="text-gray-700"><strong class="font-semibold text-gray-900">Current Address:</strong> {{ $application->current_address ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3 border-gray-200">Uploaded Documents</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @php
                $documents = [
                'university_id_doc' => 'University ID Document',
                'marksheet_doc' => 'Marksheet',
                'birth_certificate_doc' => 'Birth Certificate',
                'financial_certificate_doc' => 'Financial Certificate',
                'death_certificate_doc' => 'Death Certificate',
                'medical_certificate_doc' => 'Medical Certificate',
                'activity_certificate_doc' => 'Activity Certificate',
                'signature_doc' => 'Signature'
                ];
                @endphp

                @foreach($documents as $field => $label)
                @if(!empty($application->{$field}))
                <div class="bg-gray-50 p-5 rounded-lg shadow-sm border border-gray-200 flex flex-col items-center text-center">
                    <p class="font-semibold text-lg text-gray-800 mb-3">{{ $label }}</p>
                    <a href="{{ asset('storage/' . $application->{$field}) }}" target="_blank" class="block w-full text-indigo-600 hover:text-indigo-800 hover:underline transition ease-in-out duration-150 break-words">
                        @if(Str::endsWith($application->{$field}, ['.jpg', '.jpeg', '.png', '.gif', '.webp']))
                        <img src="{{ asset('storage/' . $application->{$field}) }}" alt="{{ $label }}" class="w-full h-32 object-contain rounded mb-3 border border-gray-300">
                        View Document
                        @elseif(Str::endsWith($application->{$field}, ['.pdf']))
                        <div class="w-full h-32 flex items-center justify-center bg-gray-200 rounded mb-3 text-sm text-gray-600">
                            PDF Document
                        </div>
                        View PDF
                        @else
                        <p class="text-sm text-gray-600">Unsupported file type. Click to <span class="font-medium">Download</span></p>
                        @endif
                    </a>
                </div>
                @endif
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 mt-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-5 border-b pb-3 border-gray-200">Update Application Status</h3>
            <form action="{{ route('admin.applications.update_status', $application->application_id) }}" method="POST" class="max-w-lg">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="status" class="block text-md font-medium text-gray-700 mb-2">Select New Status</label>
                    <select name="status" id="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm">
                        <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="waitlisted" {{ $application->status === 'waitlisted' ? 'selected' : '' }}>Waitlisted</option>
                    </select>
                </div>

                <button type="submit" class="w-full md:w-auto inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.309l7-2a1 1 0 000-1.938l-7 2.001 7-14z" />
                    </svg>
                    Update Status
                </button>
            </form>
        </div>

        @else
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <p class="text-xl text-gray-700 font-semibold">Application not found.</p>
            <a href="{{ route('admin.applications.index') }}" class="inline-block mt-6 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-150">
                Back to Applications List
            </a>
        </div>
        @endif
    </div>
</div>
@endsection