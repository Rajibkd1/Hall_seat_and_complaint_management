@include('layouts.admin_layout_helper')
@extends($layout)

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="bg-gray-800 rounded-t-lg px-8 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-semibold text-white mb-1">Seat Assignment</h1>
                        <p class="text-gray-300 text-sm">Assign approved student to available seat</p>
                    </div>
                    <a href="{{ route('admin.seats.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 border border-gray-500 text-white font-medium rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Back to Seats
                    </a>
                </div>
            </div>
        </div>

        <!-- Seat Information Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Seat Information
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="text-sm font-medium text-gray-600">Room Number</div>
                        <div class="text-xl font-bold text-gray-900">{{ $seat->room_number }}</div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="text-sm font-medium text-gray-600">Bed Number</div>
                        <div class="text-xl font-bold text-gray-900">{{ $seat->bed_number }}</div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="text-sm font-medium text-gray-600">Floor</div>
                        <div class="text-xl font-bold text-gray-900">{{ $seat->floor }}</div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="text-sm font-medium text-gray-600">Block</div>
                        <div class="text-xl font-bold text-gray-900">{{ $seat->block }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Selection Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    Select Student from Approved Applications
                </h3>
            </div>
            <div class="p-6">
                @if($availableStudents->count() > 0)
                    <!-- Search Input -->
                    <div class="mb-6">
                        <div class="relative">
                            <input type="text" id="studentSearch" placeholder="Search students by name, email, or application details..." 
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all duration-200 bg-white">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Assignment Form -->
                    <form id="seatAssignmentForm" action="{{ route('admin.seats.assign') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="seat_id" value="{{ $seat->seat_id }}">
                        <input type="hidden" name="application_id" id="selectedApplicationId" required>

                        <!-- Student List -->
                        <div id="studentListContainer" class="max-h-96 overflow-y-auto border border-gray-300 rounded-lg bg-white">
                            @foreach($availableStudents as $index => $application)
                                <div class="student-item cursor-pointer p-4 border-b border-gray-200 hover:bg-gray-50 transition-colors duration-200 last:border-b-0"
                                     data-application-id="{{ $application->application_id }}"
                                     data-search-text="{{ strtolower($application->student->name ?? $application->student_name) }} {{ strtolower($application->student->email ?? '') }} {{ $application->application_id }}">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4 flex-1">
                                            <!-- Profile Picture -->
                                            <div class="flex-shrink-0">
                                                @if ($application->student && $application->student->profile_image)
                                                    <img src="{{ asset('storage/' . $application->student->profile_image) }}"
                                                        alt="Profile Image"
                                                        class="w-12 h-12 rounded-full object-cover border-2 border-gray-200">
                                                @else
                                                    <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 text-sm font-medium border-2 border-gray-200">
                                                        {{ substr($application->student->name ?? $application->student_name, 0, 1) }}
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            <!-- Student Information -->
                                            <div class="flex-1 min-w-0">
                                                <div class="font-semibold text-gray-900 mb-1">{{ $application->student->name ?? $application->student_name }}</div>
                                                <div class="text-sm text-gray-600 mb-1">{{ $application->student->email ?? 'N/A' }}</div>
                                                <div class="text-xs text-gray-500">Application ID: {{ $application->application_id }}</div>
                                                <div class="text-xs text-gray-500">Department: {{ $application->department }}</div>
                                            </div>
                                        </div>
                                        
                                        <!-- Academic Information -->
                                        <div class="text-right ml-4">
                                            <div class="text-sm font-medium text-gray-700">CGPA: {{ $application->cgpa }}</div>
                                            <div class="text-xs text-gray-500">{{ $application->academic_year }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Selected Student Display -->
                        <div id="selectedStudentDisplay" class="p-4 bg-gray-50 border border-gray-300 rounded-lg hidden">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center text-white text-sm">✓</div>
                                <div>
                                    <div class="font-semibold text-gray-900" id="selectedStudentName"></div>
                                    <div class="text-sm text-gray-600" id="selectedStudentDetails"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-4 pt-4 border-t border-gray-200">
                            <button type="submit" id="assignSeatBtn" disabled 
                                class="flex-1 bg-gray-400 text-white py-3 px-6 rounded-lg transition-all duration-200 font-medium flex items-center justify-center gap-2 cursor-not-allowed">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Select a Student First
                            </button>
                            <a href="{{ route('admin.seats.index') }}" 
                                class="flex-1 bg-gray-500 text-white py-3 px-6 rounded-lg hover:bg-gray-600 transition-all duration-200 font-medium flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancel
                            </a>
                        </div>
                    </form>
                @else
                    <!-- No Students Available -->
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <div class="text-xl font-semibold text-gray-700 mb-2">No Approved Applications Available</div>
                        <div class="text-gray-500 mb-6">There are currently no approved applications available for seat assignment.</div>
                        <a href="{{ route('admin.seats.index') }}" 
                            class="inline-flex items-center px-6 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors duration-200">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Seats
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Seat Assigned Successfully!</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500" id="successMessage">
                    The seat has been successfully assigned to the student. An email notification has been sent.
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="closeModal" class="px-4 py-2 bg-gray-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

@if($availableStudents->count() > 0)
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('studentSearch');
    const studentItems = document.querySelectorAll('.student-item');
    const selectedApplicationId = document.getElementById('selectedApplicationId');
    const selectedStudentDisplay = document.getElementById('selectedStudentDisplay');
    const selectedStudentName = document.getElementById('selectedStudentName');
    const selectedStudentDetails = document.getElementById('selectedStudentDetails');
    const assignSeatBtn = document.getElementById('assignSeatBtn');
    const seatAssignmentForm = document.getElementById('seatAssignmentForm');
    const successModal = document.getElementById('successModal');
    const closeModal = document.getElementById('closeModal');
    const successMessage = document.getElementById('successMessage');

    let selectedStudent = null;

    // Search functionality
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        studentItems.forEach(item => {
            const searchText = item.dataset.searchText;
            if (searchText.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Student selection
    studentItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove previous selection
            const previousSelected = document.querySelector('.student-item.selected');
            if (previousSelected) {
                previousSelected.classList.remove('selected', 'bg-gray-100', 'border-gray-400');
                previousSelected.classList.add('hover:bg-gray-50');
            }

            // Add selection to current item
            this.classList.add('selected', 'bg-gray-100', 'border-gray-400');
            this.classList.remove('hover:bg-gray-50');

            // Get student data
            const applicationId = this.dataset.applicationId;
            const studentName = this.querySelector('.font-semibold').textContent;
            const studentEmail = this.querySelector('.text-sm.text-gray-600').textContent;

            // Update form
            selectedApplicationId.value = applicationId;

            // Show selected student
            selectedStudentName.textContent = studentName;
            selectedStudentDetails.textContent = `${studentEmail} • Application ID: ${applicationId}`;
            selectedStudentDisplay.classList.remove('hidden');

            // Enable assign button
            assignSeatBtn.disabled = false;
            assignSeatBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
            assignSeatBtn.classList.add('bg-gray-800', 'hover:bg-gray-900');
            assignSeatBtn.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Assign Seat to ${studentName}
            `;
        });
    });

    // Form submission
    seatAssignmentForm.addEventListener('submit', function(e) {
        e.preventDefault();

        if (!selectedApplicationId.value) {
            alert('Please select a student first.');
            return;
        }

        // Show loading state
        const originalText = assignSeatBtn.innerHTML;
        assignSeatBtn.innerHTML = '<div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div> Assigning...';
        assignSeatBtn.disabled = true;

        // Submit form
        fetch(this.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                seat_id: {{ $seat->seat_id }},
                application_id: selectedApplicationId.value
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success modal
                successMessage.textContent = data.message + ' An email notification has been sent to the student.';
                successModal.classList.remove('hidden');
            } else {
                alert(data.message);
                assignSeatBtn.innerHTML = originalText;
                assignSeatBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while assigning the seat.');
            assignSeatBtn.innerHTML = originalText;
            assignSeatBtn.disabled = false;
        });
    });

    // Close modal and redirect
    closeModal.addEventListener('click', function() {
        successModal.classList.add('hidden');
        window.location.href = '{{ route("admin.seats.index") }}';
    });

    // Close modal when clicking outside
    successModal.addEventListener('click', function(e) {
        if (e.target === successModal) {
            successModal.classList.add('hidden');
            window.location.href = '{{ route("admin.seats.index") }}';
        }
    });
});
</script>
@endif

<style>
.student-item.selected {
    border: 2px solid #6b7280;
    background-color: #f9fafb;
}
</style>
@endsection
