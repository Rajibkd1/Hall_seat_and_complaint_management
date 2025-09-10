@include('layouts.admin_layout_helper')
@extends($layout)

@section('title', 'Student Details')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_students.css') }}">
@endpush

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
                <div class="px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 mb-1">Student Details</h1>
                                <p class="text-gray-600">Complete profile information for {{ $student->name }}</p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ url()->previous() }}"
                                class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-200 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back
                            </a>
                            @if (auth()->guard('admin')->user()->role === 'Provost')
                                <form method="POST" action="{{ route('provost.activate.account', $student->student_id) }}"
                                    class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-200 flex items-center gap-2"
                                        onclick="return confirm('Are you sure you want to activate this account?')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Activate Account
                                    </button>
                                </form>
                            @elseif(auth()->guard('admin')->user()->role === 'Co-Provost')
                                <form method="POST"
                                    action="{{ route('co-provost.activate.account', $student->student_id) }}"
                                    class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-200 flex items-center gap-2"
                                        onclick="return confirm('Are you sure you want to activate this account?')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Activate Account
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.activate.account', $student->student_id) }}"
                                    class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-200 flex items-center gap-2"
                                        onclick="return confirm('Are you sure you want to activate this account?')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Activate Account
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Details -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            @if ($student->profile_image)
                                <img class="h-20 w-20 rounded-full object-cover border-4 border-gray-200"
                                    src="{{ $student->profile_image_url }}" alt="{{ $student->name }}">
                            @else
                                <div
                                    class="h-20 w-20 rounded-full bg-gray-300 flex items-center justify-center border-4 border-gray-200">
                                    <svg class="h-10 w-10 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h2 class="text-3xl font-bold text-gray-900">{{ $student->name }}</h2>
                            <p class="text-lg text-gray-600">{{ $student->email }}</p>
                            <div class="flex items-center mt-3">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Profile Completed
                                </span>
                                <span class="ml-4 text-sm text-gray-500">
                                    Completed on:
                                    @if ($student->profile_completed_at && is_object($student->profile_completed_at))
                                        {{ $student->profile_completed_at->format('M d, Y H:i') }}
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <!-- Student Information Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Basic Information -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                                Basic Information
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-500 uppercase tracking-wide">University
                                        ID</label>
                                    <p class="text-lg text-gray-900 font-medium">{{ $student->university_id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 uppercase tracking-wide">Phone
                                        Number</label>
                                    <p class="text-lg text-gray-900">{{ $student->phone }}</p>
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-500 uppercase tracking-wide">Department</label>
                                    <p class="text-lg text-gray-900">{{ $student->department }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 uppercase tracking-wide">Session
                                        Year</label>
                                    <p class="text-lg text-gray-900">{{ $student->session_year }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                                Address Information
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 uppercase tracking-wide">Current
                                        Address</label>
                                    <p class="text-lg text-gray-900">{{ $student->current_address ?? 'Not provided' }}</p>
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-500 uppercase tracking-wide">Permanent
                                        Address</label>
                                    <p class="text-lg text-gray-900">{{ $student->permanent_address ?? 'Not provided' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Guardian Information -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                                Guardian Information
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 uppercase tracking-wide">Father's
                                        Name</label>
                                    <p class="text-lg text-gray-900">{{ $student->father_name ?? 'Not provided' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 uppercase tracking-wide">Mother's
                                        Name</label>
                                    <p class="text-lg text-gray-900">{{ $student->mother_name ?? 'Not provided' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 uppercase tracking-wide">Guardian
                                        Contact</label>
                                    <p class="text-lg text-gray-900">{{ $student->guardian_contact ?? 'Not provided' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ID Card Images -->
                    <div class="mt-12">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2 mb-6">
                            ID Card Images
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Front ID Card -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 uppercase tracking-wide mb-4">Front
                                    Side</label>
                                @if ($student->id_card_front)
                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <img src="{{ asset('storage/' . $student->id_card_front) }}" alt="ID Card Front"
                                            class="w-full h-64 object-contain bg-gray-50 cursor-pointer hover:bg-gray-100 transition-colors"
                                            onclick="openImageModal('{{ asset('storage/' . $student->id_card_front) }}', 'ID Card Front')">
                                    </div>
                                @else
                                    <div
                                        class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center bg-gray-50">
                                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p class="text-lg text-gray-500">No front image uploaded</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Back ID Card -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 uppercase tracking-wide mb-4">Back
                                    Side</label>
                                @if ($student->id_card_back)
                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <img src="{{ asset('storage/' . $student->id_card_back) }}" alt="ID Card Back"
                                            class="w-full h-64 object-contain bg-gray-50 cursor-pointer hover:bg-gray-100 transition-colors"
                                            onclick="openImageModal('{{ asset('storage/' . $student->id_card_back) }}', 'ID Card Back')">
                                    </div>
                                @else
                                    <div
                                        class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center bg-gray-50">
                                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p class="text-lg text-gray-500">No back image uploaded</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 hidden">
        <div class="relative max-w-4xl max-h-full p-4">
            <button onclick="closeImageModal()" class="absolute top-2 right-2 text-white hover:text-gray-300 z-10">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
            <img id="modalImage" class="max-w-full max-h-full object-contain" alt="ID Card">
            <p id="modalTitle" class="text-white text-center mt-4 text-lg font-medium"></p>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Image modal functions
        function openImageModal(imageSrc, title) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
@endpush
