@include('layouts.admin_layout_helper')
@extends($layout)

@section('content')
    <div class="min-h-screen bg-gray-50 p-6">
        <div class="max-w-7xl mx-auto">

            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8 overflow-hidden">
                <div class="bg-gray-800 px-8 py-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-white mb-2">Allocated Students</h1>
                            <p class="text-gray-300">View and manage students who have been allocated seats</p>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.applications.allocated.pdf.generate') }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View PDF
                            </a>
                            <a href="{{ route('admin.applications.allocated.pdf.download') }}" 
                               class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Download PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Allocated</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $allocatedStudents->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Occupied Rooms</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $allocatedStudents->pluck('seat.room_number')->unique()->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Blocks Used</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $allocatedStudents->pluck('seat.block')->unique()->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-orange-100">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 8a2 2 0 100-4 2 2 0 000 4zm6 0a2 2 0 100-4 2 2 0 000 4zm-6 4a2 2 0 100-4 2 2 0 000 4zm6 0a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Floors Used</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $allocatedStudents->pluck('seat.floor')->unique()->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8 p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Students</label>
                        <input type="text" id="search" placeholder="Search by name, university ID, or room..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="block-filter" class="block text-sm font-medium text-gray-700 mb-2">Filter by Block</label>
                        <select id="block-filter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Blocks</option>
                            @foreach($allocatedStudents->pluck('seat.block')->unique()->sort() as $block)
                                <option value="{{ $block }}">{{ $block }} Block</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="floor-filter" class="block text-sm font-medium text-gray-700 mb-2">Filter by Floor</label>
                        <select id="floor-filter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Floors</option>
                            @foreach($allocatedStudents->pluck('seat.floor')->unique()->sort() as $floor)
                                <option value="{{ $floor }}">Floor {{ $floor }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Allocated Students Table -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Allocated Students List</h3>
                </div>
                
                @if($allocatedStudents->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="allocated-table">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Info</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seat Details</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Allocation Info</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($allocatedStudents as $allotment)
                                    <tr class="hover:bg-gray-50 allocated-row" 
                                        data-student-name="{{ strtolower($allotment->student->name ?? '') }}"
                                        data-university-id="{{ strtolower($allotment->student->university_id ?? '') }}"
                                        data-room="{{ strtolower($allotment->seat->room_number ?? '') }}"
                                        data-block="{{ strtolower($allotment->seat->block ?? '') }}"
                                        data-floor="{{ $allotment->seat->floor ?? '' }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    @if($allotment->student && $allotment->student->profile_image)
                                                        <img class="h-10 w-10 rounded-full object-cover" 
                                                             src="{{ asset('storage/' . $allotment->student->profile_image) }}" 
                                                             alt="Profile">
                                                    @else
                                                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                            <span class="text-sm font-medium text-gray-700">
                                                                {{ substr($allotment->student->name ?? 'N', 0, 1) }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $allotment->student->name ?? 'N/A' }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        ID: {{ $allotment->student->university_id ?? 'N/A' }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $allotment->application->department ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <div class="font-medium">Room {{ $allotment->seat->room_number ?? 'N/A' }}</div>
                                                <div class="text-gray-500">Bed {{ $allotment->seat->bed_number ?? 'N/A' }}</div>
                                                <div class="text-gray-500">{{ $allotment->seat->block ?? 'N/A' }} Block, Floor {{ $allotment->seat->floor ?? 'N/A' }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <div class="font-medium">Allocated by:</div>
                                                <div class="text-gray-500">{{ $allotment->admin->name ?? 'N/A' }}</div>
                                                <div class="text-gray-500">{{ $allotment->admin->role ?? 'Admin' }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <div class="font-medium">Start: {{ \Carbon\Carbon::parse($allotment->start_date)->format('M j, Y') }}</div>
                                                @if($allotment->end_date)
                                                    <div class="text-gray-500">End: {{ \Carbon\Carbon::parse($allotment->end_date)->format('M j, Y') }}</div>
                                                @else
                                                    <div class="text-green-600">Ongoing</div>
                                                @endif
                                                <div class="text-gray-500">
                                                    {{ \Carbon\Carbon::parse($allotment->start_date)->diffForHumans() }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.applications.allocated.show', $allotment->allotment_id) }}" 
                                               class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Allocated Students</h3>
                        <p class="text-gray-500">No students have been allocated seats yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const blockFilter = document.getElementById('block-filter');
            const floorFilter = document.getElementById('floor-filter');
            const rows = document.querySelectorAll('.allocated-row');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedBlock = blockFilter.value.toLowerCase();
                const selectedFloor = floorFilter.value;

                rows.forEach(row => {
                    const studentName = row.dataset.studentName;
                    const universityId = row.dataset.universityId;
                    const room = row.dataset.room;
                    const block = row.dataset.block;
                    const floor = row.dataset.floor;

                    const matchesSearch = !searchTerm || 
                        studentName.includes(searchTerm) || 
                        universityId.includes(searchTerm) || 
                        room.includes(searchTerm);
                    
                    const matchesBlock = !selectedBlock || block === selectedBlock;
                    const matchesFloor = !selectedFloor || floor === selectedFloor;

                    if (matchesSearch && matchesBlock && matchesFloor) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterTable);
            blockFilter.addEventListener('change', filterTable);
            floorFilter.addEventListener('change', filterTable);
        });
    </script>
@endsection
