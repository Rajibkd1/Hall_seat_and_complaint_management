@extends('layouts.app')

@section('content')
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Navigation Tabs -->
        <div class="flex justify-center mb-8">
            <div class="bg-white/90 backdrop-blur-lg rounded-2xl p-2 shadow-lg">
                <div class="flex space-x-2">
                    <a href="{{ route('student.complaint_list') }}" 
                       class="px-6 py-3 text-gray-600 hover:bg-gray-100 rounded-xl font-semibold transition-all duration-300">
                        All Complaints
                    </a>
                    <a href="{{ route('student.track_complaint') }}" 
                       class="px-6 py-3 bg-green-600 text-white rounded-xl font-semibold transition-all duration-300">
                        Track Complaint
                    </a>
                    <a href="{{ route('student.create_complaint') }}" 
                       class="px-6 py-3 text-gray-600 hover:bg-gray-100 rounded-xl font-semibold transition-all duration-300">
                        Create New
                    </a>
                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl p-8 mb-8 animate-slide-up">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Search by Tracking ID</h2>
                <p class="text-gray-600">Enter your complaint tracking ID to get detailed status information</p>
            </div>
            
            <div class="max-w-md mx-auto">
                <div class="relative">
                    <input type="text" id="trackingInput" 
                           class="w-full px-6 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-green-500 focus:outline-none transition-all duration-300 text-center text-lg font-mono"
                           placeholder="CM-2025-001">
                    <button onclick="searchComplaint()" 
                            class="absolute right-2 top-2 px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-300 font-semibold">
                        Search
                    </button>
                </div>
            </div>
        </div>

        <!-- Search Result -->
        <div id="searchResult" class="hidden bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl p-8 mb-8">
            <div id="complaintDetails"></div>
        </div>

        <!-- Recent Complaints -->
        <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-xl p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Recent Complaints</h2>
            
            <div class="space-y-4">
                @forelse($complaints->take(5) as $complaint)
                    <div class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 capitalize">{{ str_replace('_', ' ', $complaint->category) }}</h3>
                                    <p class="text-sm text-gray-500">{{ $complaint->submission_date->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="px-3 py-1 
                                    @if($complaint->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($complaint->status === 'in_progress') bg-blue-100 text-blue-800
                                    @elseif($complaint->status === 'resolved') bg-green-100 text-green-800
                                    @endif
                                    rounded-full text-xs font-medium capitalize">
                                    {{ str_replace('_', ' ', $complaint->status) }}
                                </span>
                                <span class="font-mono text-sm text-blue-600 font-medium">
                                    #CM-{{ date('Y') }}-{{ str_pad($complaint->complaint_id, 3, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="mt-4">
                            <div class="flex justify-between text-xs text-gray-500 mb-2">
                                <span>Submitted</span>
                                <span>In_Progress</span>
                                <span>Resolved</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-green-500 to-blue-500 h-2 rounded-full transition-all duration-300" 
                                     style="width: {{ $complaint->status === 'pending' ? '33%' : ($complaint->status === 'in_progress' ? '66%' : '100%') }}"></div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Complaints Found</h3>
                        <p class="text-gray-600 mb-6">You haven't submitted any complaints yet.</p>
                        <a href="{{ route('student.create_complaint') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-blue-600 text-white rounded-full hover:from-green-700 hover:to-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 font-semibold">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Submit Your First Complaint
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
</body>

@push('head-scripts')
    <link rel="stylesheet" href="{{ asset('css/track_complaint.css') }}">
@endpush

@push('scripts')
    <script>
        function searchComplaint() {
            const trackingId = document.getElementById('trackingInput').value.trim();
            
            if (!trackingId) {
                alert('Please enter a tracking ID');
                return;
            }

            fetch('{{ route("student.search_complaint") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    tracking_id: trackingId
                })
            })
            .then(response => response.json())
            .then(data => {
                const resultDiv = document.getElementById('searchResult');
                const detailsDiv = document.getElementById('complaintDetails');
                
                if (data.success) {
                    const complaint = data.complaint;
                    const statusColor = complaint.status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                      complaint.status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 
                                      'bg-green-100 text-green-800';
                    
                    const progressWidth = complaint.status === 'pending' ? '33%' : 
                                        complaint.status === 'in_progress' ? '66%' : '100%';
                    
                    detailsDiv.innerHTML = `
                        <div class="border-l-4 border-green-500 pl-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-bold text-gray-900">Complaint Found!</h3>
                                <span class="px-3 py-1 ${statusColor} rounded-full text-sm font-medium capitalize">
                                    ${complaint.status.replace('_', ' ')}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Tracking ID</p>
                                    <p class="font-mono font-bold text-blue-600">${data.tracking_id}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Category</p>
                                    <p class="font-semibold capitalize">${complaint.category.replace('_', ' ')}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Submitted Date</p>
                                    <p class="font-semibold">${new Date(complaint.submission_date).toLocaleDateString()}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Emergency</p>
                                    <p class="font-semibold">${complaint.emergency_flag ? 'Yes' : 'No'}</p>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <p class="text-sm text-gray-600 mb-2">Description</p>
                                <p class="text-gray-800 leading-relaxed">${complaint.description}</p>
                            </div>
                            
                            ${complaint.admin_comment ? `
                            <div class="mt-6">
                                <p class="text-sm text-gray-600 mb-2">Admin Response</p>
                                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-md">
                                    <p class="text-gray-800 leading-relaxed">${complaint.admin_comment}</p>
                                </div>
                            </div>
                            ` : ''}

                            <div class="mt-6">
                                <p class="text-sm text-gray-600 mb-2">Progress</p>
                                <div class="flex justify-between text-xs text-gray-500 mb-2">
                                    <span>Submitted</span>
                                    <span>In_Progress</span>
                                    <span>Resolved</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-green-500 to-blue-500 h-3 rounded-full transition-all duration-500" 
                                         style="width: ${progressWidth}"></div>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    resultDiv.classList.remove('hidden');
                    resultDiv.scrollIntoView({ behavior: 'smooth' });
                } else {
                    detailsDiv.innerHTML = `
                        <div class="border-l-4 border-red-500 pl-6">
                            <h3 class="text-xl font-bold text-red-900 mb-2">Complaint Not Found</h3>
                            <p class="text-red-700">${data.message}</p>
                            <p class="text-sm text-gray-600 mt-2">Please check your tracking ID and try again.</p>
                        </div>
                    `;
                    
                    resultDiv.classList.remove('hidden');
                    resultDiv.scrollIntoView({ behavior: 'smooth' });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error searching complaint. Please try again.');
            });
        }

        // Allow Enter key to search
        document.getElementById('trackingInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchComplaint();
            }
        });
    </script>
@endpush
@endsection
