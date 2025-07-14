@extends('layouts.admin_app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Application Details</h1>

    @if($application)
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <p class="text-gray-700"><strong class="font-semibold">Application ID:</strong> {{ $application->application_id }}</p>
                <p class="text-gray-700"><strong class="font-semibold">Student Name:</strong> {{ $application->student->name ?? 'N/A' }}</p>
                <p class="text-gray-700"><strong class="font-semibold">Application Date:</strong> {{ $application->application_date->format('Y-m-d H:i') }}</p>
                <p class="text-gray-700"><strong class="font-semibold">Status:</strong> 
                    <span class="relative inline-block px-3 py-1 font-semibold text-{{ $application->status === 'approved' ? 'green' : ($application->status === 'pending' ? 'orange' : 'red') }}-900 leading-tight">
                        <span aria-hidden="true" class="absolute inset-0 bg-{{ $application->status === 'approved' ? 'green' : ($application->status === 'pending' ? 'orange' : 'red') }}-200 opacity-50 rounded-full"></span>
                        <span class="relative">{{ ucfirst($application->status) }}</span>
                    </span>
                </p>
            </div>
            <div>
                <p class="text-gray-700"><strong class="font-semibold">Reason:</strong></p>
                <p class="text-gray-700">{{ $application->reason }}</p>
            </div>
        </div>

        <h3 class="text-xl font-semibold text-gray-800 mb-3">Update Status</h3>
        <form action="{{ route('admin.applications.update_status', $application->application_id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">New Status:</label>
                <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Status
            </button>
        </form>
    </div>
    @else
    <div class="bg-white shadow-md rounded-lg p-6">
        <p class="text-red-600">Application not found.</p>
    </div>
    @endif

    <a href="{{ route('admin.applications') }}" class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mt-4">
        Back to Application List
    </a>
</div>
@endsection