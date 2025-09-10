@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 max-w-4xl">
            <!-- Header Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 p-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Seat Renewal Application</h1>
                        <p class="text-gray-600">Apply to renew your hall seat allocation</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Applicant</p>
                            <p class="font-semibold text-gray-900">{{ $student->name }}</p>
                            <p class="text-sm text-gray-600">{{ $student->university_id }}</p>
                        </div>
                        <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-gray-200 bg-gray-100">
                            @if ($student->profile_image)
                                <img src="{{ $student->profile_image_url }}" alt="Profile"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Seat Information -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
                <h3 class="text-lg font-semibold text-blue-900 mb-4">Current Seat Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-blue-700">Seat Location</p>
                        <p class="font-semibold text-blue-900">
                            {{ $allotment->seat->floor }} Floor, {{ $allotment->seat->block }} Block
                        </p>
                        <p class="text-sm text-blue-700">Room {{ $allotment->seat->room_number }}, Bed
                            {{ $allotment->seat->bed_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-700">Allocation Period</p>
                        <p class="font-semibold text-blue-900">
                            {{ \Carbon\Carbon::parse($allotment->start_date)->format('M d, Y') }} -
                            {{ \Carbon\Carbon::parse($allotment->allocation_expiry_date)->format('M d, Y') }}
                        </p>
                        <p class="text-sm text-blue-700">
                            @if ($allotment->remaining_days > 0)
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    {{ $allotment->remaining_days }} days remaining
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Expired
                                </span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Renewal Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                <form action="{{ route('student.seat_renewal.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-6">
                        <!-- Current Semesters -->
                        <div>
                            <label for="current_semesters" class="block text-sm font-medium text-gray-700 mb-2">
                                Current Number of Semesters <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="current_semesters" name="current_semesters"
                                value="{{ old('current_semesters') }}" min="1" max="20" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('current_semesters') border-red-500 @enderror">
                            @error('current_semesters')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Last Semester CGPA -->
                        <div>
                            <label for="last_semester_cgpa" class="block text-sm font-medium text-gray-700 mb-2">
                                Last Semester CGPA <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="last_semester_cgpa" name="last_semester_cgpa"
                                value="{{ old('last_semester_cgpa') }}" step="0.01" min="0" max="4.00"
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('last_semester_cgpa') border-red-500 @enderror">
                            @error('last_semester_cgpa')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Result File Upload -->
                        <div>
                            <label for="result_file" class="block text-sm font-medium text-gray-700 mb-2">
                                Upload Last Semester Result <span class="text-red-500">*</span>
                            </label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="result_file"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload a file</span>
                                            <input id="result_file" name="result_file" type="file"
                                                accept=".pdf,.jpg,.jpeg,.png" required class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF, JPG, PNG up to 2MB</p>
                                </div>
                            </div>
                            @error('result_file')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Additional Comments -->
                        <div>
                            <label for="additional_comments" class="block text-sm font-medium text-gray-700 mb-2">
                                Additional Comments (Optional)
                            </label>
                            <textarea id="additional_comments" name="additional_comments" rows="4" maxlength="1000"
                                placeholder="Any additional information you'd like to share..."
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('additional_comments') border-red-500 @enderror">{{ old('additional_comments') }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">Maximum 1000 characters</p>
                            @error('additional_comments')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('student.dashboard') }}"
                            class="px-6 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Submit Renewal Application
                        </button>
                    </div>
                </form>
            </div>

            <!-- Important Notes -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 mt-8">
                <h3 class="text-lg font-semibold text-yellow-900 mb-3">Important Notes</h3>
                <ul class="space-y-2 text-sm text-yellow-800">
                    <li>• Your renewal application will be reviewed by the hall administration</li>
                    <li>• Approval is subject to academic performance and hall rules compliance</li>
                    <li>• You will be notified via email about the application status</li>
                    <li>• If approved, your seat allocation will be extended for one year</li>
                    <li>• Please ensure all information provided is accurate and complete</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // File upload preview
        document.getElementById('result_file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const fileName = file.name;
                const fileSize = (file.size / 1024 / 1024).toFixed(2);
                console.log(`Selected file: ${fileName} (${fileSize} MB)`);
            }
        });
    </script>
@endsection
