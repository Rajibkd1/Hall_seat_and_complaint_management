@extends('layouts.app')

@section('content')

    <body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Navigation Tabs -->
            <div class="flex justify-center mb-8">
                <div class="bg-white/90 backdrop-blur-lg rounded-2xl p-2 shadow-lg">
                    <div class="flex space-x-2">
                        <a href="{{ route('student.complaint_list') }}"
                            class="px-6 py-3 bg-blue-600 text-white rounded-xl font-semibold transition-all duration-300">
                            All Complaints
                        </a>
                        <a href="{{ route('student.track_complaint') }}"
                            class="px-6 py-3 text-gray-600 hover:bg-gray-100 rounded-xl font-semibold transition-all duration-300">
                            Track Complaint
                        </a>
                        <a href="{{ route('student.create_complaint') }}"
                            class="px-6 py-3 text-gray-600 hover:bg-gray-100 rounded-xl font-semibold transition-all duration-300">
                            Create New
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
                <div class="bg-white/90 backdrop-blur-lg rounded-2xl p-4 md:p-6 shadow-xl animate-slide-up"
                    style="animation-delay: 0.1s;">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs md:text-sm font-medium text-gray-600">Total Complaints</p>
                            <p class="text-2xl md:text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                        </div>
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur-lg rounded-2xl p-4 md:p-6 shadow-xl animate-slide-up"
                    style="animation-delay: 0.2s;">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs md:text-sm font-medium text-gray-600">Pending</p>
                            <p class="text-2xl md:text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
                        </div>
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur-lg rounded-2xl p-4 md:p-6 shadow-xl animate-slide-up"
                    style="animation-delay: 0.3s;">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs md:text-sm font-medium text-gray-600">In Progress</p>
                            <p class="text-2xl md:text-3xl font-bold text-blue-600">{{ $stats['in_progress'] }}</p>
                        </div>
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur-lg rounded-2xl p-4 md:p-6 shadow-xl animate-slide-up"
                    style="animation-delay: 0.4s;">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs md:text-sm font-medium text-gray-600">Resolved</p>
                            <p class="text-2xl md:text-3xl font-bold text-green-600">{{ $stats['resolved'] }}</p>
                        </div>
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Bar -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Complaint History</h2>
                <select id="statusFilter"
                    class="px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="resolved">Resolved</option>
                </select>
            </div>

            <!-- Complaints List -->
            <div class="space-y-6">
                @forelse($complaints as $complaint)
                    <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 animate-slide-up complaint-card"
                        style="animation-delay: {{ $loop->index * 0.1 }}s;" data-status="{{ $complaint->status }}">
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <!-- Complaint Header -->
                                    <div class="flex items-center space-x-4 mb-4">
                                        <div
                                            class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 capitalize">
                                                {{ str_replace('_', ' ', $complaint->category) }}</h3>
                                            <p class="text-sm text-gray-500">
                                                Submitted {{ $complaint->submission_date->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            @if ($complaint->emergency_flag)
                                                <span
                                                    class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                                        </path>
                                                    </svg>
                                                    Emergency
                                                </span>
                                            @endif
                                            <span
                                                class="px-3 py-1 
                                            @if ($complaint->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($complaint->status === 'in_progress') bg-blue-100 text-blue-800
                                            @elseif($complaint->status === 'resolved') bg-green-100 text-green-800 @endif
                                            rounded-full text-xs font-medium capitalize">
                                                {{ str_replace('_', ' ', $complaint->status) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Complaint Description -->
                                    <div class="mb-4">
                                        <p class="text-gray-700 leading-relaxed">
                                            {{ Str::limit($complaint->description, 200) }}
                                        </p>
                                    </div>

                                    <!-- Complaint Image -->
                                    @if ($complaint->image_url)
                                        <div class="mb-4">
                                            <img src="{{ $complaint->image_url }}" alt="Complaint Image"
                                                class="w-32 h-32 object-cover rounded-lg shadow-md cursor-pointer hover:shadow-lg transition-shadow duration-300"
                                                onclick="openImageModal('{{ $complaint->image_url }}')">
                                        </div>
                                    @endif

                                    <!-- Complaint ID -->
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm text-gray-500">
                                            Complaint ID: <span
                                                class="font-mono font-medium text-blue-600">#CM-{{ date('Y') }}-{{ str_pad($complaint->complaint_id, 3, '0', STR_PAD_LEFT) }}</span>
                                        </p>
                                        <div class="flex items-center space-x-2">
                                            @if ($complaint->status === 'pending')
                                                <button onclick="deleteComplaint({{ $complaint->complaint_id }})"
                                                    class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200 text-sm font-medium">
                                                    Delete
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-xl p-12 text-center">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Complaints Found</h3>
                        <p class="text-gray-600 mb-6">You haven't submitted any complaints yet.</p>
                        <a href="{{ route('student.create_complaint') }}"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 font-semibold">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Submit Your First Complaint
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($complaints->hasPages())
                <div class="mt-8 flex justify-center">
                    {{ $complaints->links() }}
                </div>
            @endif
        </main>

        <!-- Image Modal -->
        <div id="imageModal"
            class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
            <div class="relative max-w-4xl max-h-full">
                <img id="modalImage" src="" alt="Complaint Image"
                    class="max-w-full max-h-full object-contain rounded-lg">
                <button onclick="closeImageModal()"
                    class="absolute top-4 right-4 w-10 h-10 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center text-white hover:bg-white/30 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </body>

    @push('head-scripts')
        <link rel="stylesheet" href="{{ asset('css/complaint_list.css') }}">
    @endpush

    @push('scripts')
        <script>
            // Filter functionality
            document.getElementById('statusFilter').addEventListener('change', function() {
                const selectedStatus = this.value;
                const complaintCards = document.querySelectorAll('.complaint-card');

                complaintCards.forEach(card => {
                    if (selectedStatus === '' || card.dataset.status === selectedStatus) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });

            // Image modal functions
            function openImageModal(imageUrl) {
                document.getElementById('modalImage').src = imageUrl;
                document.getElementById('imageModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeImageModal() {
                document.getElementById('imageModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            // Delete complaint
            function deleteComplaint(complaintId) {
                if (confirm('Are you sure you want to delete this complaint? This action cannot be undone.')) {
                    // Create a form and submit it (better approach for DELETE requests)
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/complaint/${complaintId}`;

                    // Add CSRF token
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    form.appendChild(csrfToken);

                    // Add method spoofing for DELETE
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    form.appendChild(methodField);

                    document.body.appendChild(form);
                    form.submit();
                }
            }


            // Close modal when clicking outside
            document.getElementById('imageModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeImageModal();
                }
            });
        </script>
    @endpush
@endsection
