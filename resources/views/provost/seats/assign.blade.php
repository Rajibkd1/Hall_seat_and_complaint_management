@extends('layouts.provost_app')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-t-lg px-8 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-semibold text-white mb-1">Seat Assignment</h1>
                        <p class="text-blue-100 text-sm">Assign approved student to available seat</p>
                    </div>
                    <a href="{{ route('provost.seats.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-500 border border-blue-400 text-white font-medium rounded-md hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-colors duration-200">
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
                    <div class="w-6 h-6 bg-blue-500 rounded-lg flex items-center justify-center text-white text-xs">🏠</div>
                    Seat Information
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <div class="text-sm font-medium text-blue-800">Room Number</div>
                        <div class="text-xl font-bold text-blue-900">{{ $seat->room_number }}</div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                        <div class="text-sm font-medium text-green-800">Bed Number</div>
                        <div class="text-xl font-bold text-green-900">{{ $seat->bed_number }}</div>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                        <div class="text-sm font-medium text-purple-800">Floor</div>
                        <div class="text-xl font-bold text-purple-900">{{ $seat->floor }}</div>
                    </div>
                    <div class="bg-orange-50 p-4 rounded-lg border border-orange-200">
                        <div class="text-sm font-medium text-orange-800">Block</div>
                        <div class="text-xl font-bold text-orange-900">{{ $seat->block }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Selection Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <div class="w-6 h-6 bg-green-500 rounded-lg flex items-center justify-center text-white text-xs">👥</div>
                    Select Student from Approved Applications
                </h3>
            </div>
            <div class="p-6">
                @if($availableStudents->count() > 0)
                    <!-- Search Input -->
                    <div class="mb-6">
                        <div class="relative">
                            <input type="text" id="studentSearch" placeholder="Search students by name, email, or application details..." 
                                class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Assignment Form -->
                    <form id="seatAssignmentForm" action="{{ route('provost.seats.assign') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="seat_id" value="{{ $seat->seat_id }}">
                        <input type="hidden" name="application_id" id="selectedApplicationId" required>

                        <!-- Student List -->
                        <div id="studentListContainer" class="max-h-96 overflow-y-auto border-2 border-gray-200 rounded-xl bg-gray-50">
                            @foreach($availableStudents as $index => $application)
                                <div class="student-item cursor-pointer p-4 border-b border-gray-200 hover:bg-blue-50 transition-all duration-200 animate-fade-in bg-white"
                                     style="animation-delay: {{ $index * 0.05 }}s"
                                     data-application-id="{{ $application->application_id }}"
                                     data-search-text="{{ strtolower($application->student->name ?? $application->student_name) }} {{ strtolower($application->student->email ?? '') }} {{ $application->application_id }}">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <div class="font-semibold text-gray-900 mb-1">{{ $application->student->name ?? $application->student_name }}</div>
                                            <div class="text-sm text-gray-600 mb-1">{{ $application->student->email ?? 'N/A' }}</div>
                                            <div class="text-xs text-gray-500">Application ID: {{ $application->application_id }}</div>
                                            <div class="text-xs text-gray-500">Department: {{ $application->department }}</div>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <div class="text-right">
                                                <div class="text-sm font-medium text-gray-700">CGPA: {{ $application->cgpa }}</div>
                                                <div class="text-xs text-gray-500">{{ $application->academic_year }}</div>
                                            </div>
                                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-sm font-medium">
                                                {{ substr($application->student->name ?? $application->student_name, 0, 1) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Selected Student Display -->
                        <div id="selectedStudentDisplay" class="p-4 bg-green-50 border border-green-200 rounded-xl hidden">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm">✓</div>
                                <div>
                                    <div class="font-semibold text-green-900" id="selectedStudentName"></div>
                                    <div class="text-sm text-green-600" id="selectedStudentDetails"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-4 pt-4 border-t border-gray-200">
                            <button type="submit" id="assignSeatBtn" disabled 
                                class="flex-1 bg-gradient-to-r from-gray-400 to-gray-500 text-white py-3 px-6 rounded-xl transition-all duration-200 font-medium shadow-lg flex items-center justify-center gap-2 cursor-not-allowed">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Select a Student First
                            </button>
                            <a href="{{ route('provost.seats.index') }}" 
                                class="flex-1 bg-gradient-to-r from-gray-400 to-gray-500 text-white py-3 px-6 rounded-xl hover:from-gray-500 hover:to-gray-600 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center gap-2">
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
                        <div class="text-6xl mb-4">📋</div>
                        <div class="text-xl font-semibold text-gray-700 mb-2">No Approved Applications Available</div>
                        <div class="text-gray-500 mb-6">There are currently no approved applications available for seat assignment.</div>
                        <a href="{{ route('provost.seats.index') }}" 
                            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
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
                previousSelected.classList.remove('selected', 'bg-green-100', 'border-green-300');
                previousSelected.classList.add('hover:bg-blue-50');
            }

            // Add selection to current item
            this.classList.add('selected', 'bg-green-100', 'border-green-300');
            this.classList.remove('hover:bg-blue-50');

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
            assignSeatBtn.classList.remove('bg-gradient-to-r', 'from-gray-400', 'to-gray-500', 'cursor-not-allowed');
            assignSeatBtn.classList.add('bg-gradient-to-r', 'from-green-500', 'to-green-600', 'hover:from-green-600', 'hover:to-green-700', 'transform', 'hover:scale-105');
            assignSeatBtn.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Assign Seat to ${studentName}
            `;

            // Add success animation
            this.classList.add('animate-pulse');
            setTimeout(() => {
                this.classList.remove('animate-pulse');
            }, 1000);
        });

        // Add hover effects
        item.addEventListener('mouseenter', function() {
            if (!this.classList.contains('selected')) {
                this.classList.add('transform', 'scale-105', 'shadow-md');
            }
        });

        item.addEventListener('mouseleave', function() {
            if (!this.classList.contains('selected')) {
                this.classList.remove('transform', 'scale-105', 'shadow-md');
            }
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
                // Show success message
                showNotification(data.message, 'success');
                // Redirect after a short delay
                setTimeout(() => {
                    window.location.href = '{{ route("provost.seats.index") }}';
                }, 1500);
            } else {
                showNotification(data.message, 'error');
                assignSeatBtn.innerHTML = originalText;
                assignSeatBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('An error occurred while assigning the seat.', 'error');
            assignSeatBtn.innerHTML = originalText;
            assignSeatBtn.disabled = false;
        });
    });

    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.notification');
        existingNotifications.forEach(notification => notification.remove());

        const notification = document.createElement('div');
        notification.className = `notification fixed top-4 right-4 z-50 px-6 py-4 rounded-xl text-white font-medium shadow-2xl transform transition-all duration-300 max-w-sm`;

        let icon = '';
        let bgClass = '';

        switch (type) {
            case 'success':
                icon = '✅';
                bgClass = 'bg-gradient-to-r from-green-500 to-emerald-600';
                break;
            case 'error':
                icon = '❌';
                bgClass = 'bg-gradient-to-r from-red-500 to-red-600';
                break;
            case 'info':
                icon = 'ℹ️';
                bgClass = 'bg-gradient-to-r from-blue-500 to-indigo-600';
                break;
            default:
                icon = '📢';
                bgClass = 'bg-gradient-to-r from-gray-500 to-gray-600';
        }

        notification.className += ` ${bgClass}`;
        notification.innerHTML = `
            <div class="flex items-center gap-3">
                <span class="text-xl">${icon}</span>
                <span>${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-white hover:text-gray-200 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;

        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 10);

        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 5000);
    }
});
</script>
@endif

<style>
.animate-fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.student-item.selected {
    border: 2px solid #10b981;
    background-color: #d1fae5;
}
</style>
@endsection
