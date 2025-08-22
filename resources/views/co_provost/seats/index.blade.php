@extends('layouts.co_provost_app')

@section('title', 'Seat Management - View Only')

@section('content')
    <script>
        window.seatManagementConfig = {
            baseUrl: '/co-provost'
        };
    </script>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-gray-50 to-slate-100 pt-20">
        <!-- Animated Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-emerald-200/30 to-teal-300/20 rounded-full blur-3xl animate-float">
            </div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-teal-200/30 to-emerald-300/20 rounded-full blur-3xl animate-float"
                style="animation-delay: -2s;"></div>
        </div>

        <!-- Compact Header Section -->
        <div class="relative bg-white/95 backdrop-blur-sm border-b border-emerald-200/50 py-3 px-4 shadow-sm">
            <div class="container mx-auto">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="space-y-1">
                        <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                            <i class="fas fa-bed mr-2 text-emerald-600"></i>
                            Seat Management
                            <span class="text-sm bg-emerald-100 text-emerald-700 px-2 py-1 rounded-full ml-2">View
                                Only</span>
                        </h1>
                        <p class="text-gray-600 text-xs sm:text-sm font-medium">Co-Provost hall seat visualization
                            (read-only access)</p>
                    </div>
                    <div class="hidden lg:block">
                        <div class="bg-white/90 backdrop-blur-sm rounded-xl p-3 border border-emerald-200/50 shadow-lg">
                            <div class="flex items-center space-x-4 text-xs">
                                <div class="text-center group">
                                    <div class="text-sm font-bold text-slate-900 mb-0.5 group-hover:scale-105 transition-transform duration-300"
                                        id="totalSeatsHeader">{{ $totalSeats }}</div>
                                    <div class="text-slate-600 font-medium uppercase tracking-wide text-xs">Total</div>
                                </div>
                                <div class="w-px h-6 bg-gradient-to-b from-transparent via-emerald-300 to-transparent">
                                </div>
                                <div class="text-center group">
                                    <div class="text-sm font-bold text-slate-900 mb-0.5 group-hover:scale-105 transition-transform duration-300"
                                        id="occupiedHeader">{{ $occupiedSeats }}</div>
                                    <div class="text-slate-600 font-medium uppercase tracking-wide text-xs">Occupied</div>
                                </div>
                                <div class="w-px h-6 bg-gradient-to-b from-transparent via-emerald-300 to-transparent">
                                </div>
                                <div class="text-center group">
                                    <div class="text-sm font-bold text-slate-900 mb-0.5 group-hover:scale-105 transition-transform duration-300"
                                        id="availableHeader">{{ $availableSeats }}</div>
                                    <div class="text-slate-600 font-medium uppercase tracking-wide text-xs">Available</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-4 sm:py-8 relative">
            <!-- Enhanced Control Panel -->
            <div
                class="relative bg-white/90 backdrop-blur-sm rounded-2xl sm:rounded-3xl shadow-2xl border border-emerald-200/50 p-4 sm:p-8 mb-6 sm:mb-8 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-50/50 to-teal-50/50"></div>
                <div class="relative flex flex-col sm:flex-row sm:flex-wrap items-stretch sm:items-center gap-4 sm:gap-8">
                    <!-- Floor Selection -->
                    <div class="flex items-center gap-3 sm:gap-4 group">
                        <div
                            class="w-10 h-10 sm:w-14 sm:h-14 bg-gradient-to-br from-emerald-100 to-teal-200 rounded-xl sm:rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-5 h-5 sm:w-7 sm:h-7 text-emerald-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <label for="floor"
                                class="block text-xs sm:text-sm font-bold text-slate-700 mb-1 sm:mb-2 uppercase tracking-wider">Floor</label>
                            <select id="floor"
                                class="form-select w-full border-2 border-emerald-200 rounded-xl sm:rounded-2xl px-3 py-2 sm:px-6 sm:py-3 bg-white/80 backdrop-blur-sm focus:border-emerald-400 focus:ring-0 transition-all duration-300 font-semibold text-slate-800 shadow-lg text-sm sm:text-base">
                                <option value="1">Floor 1</option>
                                <option value="2">Floor 2</option>
                                <option value="3">Floor 3</option>
                                <option value="4">Floor 4</option>
                            </select>
                        </div>
                    </div>

                    <!-- Block Selection -->
                    <div class="flex items-center gap-3 sm:gap-4 group">
                        <div
                            class="w-10 h-10 sm:w-14 sm:h-14 bg-gradient-to-br from-emerald-100 to-teal-200 rounded-xl sm:rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-5 h-5 sm:w-7 sm:h-7 text-emerald-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <label for="block"
                                class="block text-xs sm:text-sm font-bold text-slate-700 mb-1 sm:mb-2 uppercase tracking-wider">Block</label>
                            <select id="block"
                                class="form-select w-full border-2 border-emerald-200 rounded-xl sm:rounded-2xl px-3 py-2 sm:px-6 sm:py-3 bg-white/80 backdrop-blur-sm focus:border-emerald-400 focus:ring-0 transition-all duration-300 font-semibold text-slate-800 shadow-lg text-sm sm:text-base">
                                <option value="Front">Front Block</option>
                                <option value="Back">Back Block</option>
                            </select>
                        </div>
                    </div>

                    <!-- Enhanced Load Button -->
                    <button id="loadRooms"
                        class="bg-gradient-to-r from-emerald-800 to-teal-900 hover:from-emerald-900 hover:to-teal-800 text-white px-6 py-3 sm:px-8 sm:py-4 rounded-xl sm:rounded-2xl font-bold transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105 flex items-center justify-center gap-2 sm:gap-3 group w-full sm:w-auto">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 group-hover:rotate-180 transition-transform duration-500"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        <span class="text-sm sm:text-lg">Load Rooms</span>
                    </button>
                </div>
            </div>

            <!-- Room Grid -->
            <div id="roomGrid" class="bg-white rounded-lg shadow-sm p-4 sm:p-8 border border-emerald-200">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-3">
                    <h2 id="gridTitle" class="text-lg sm:text-2xl font-bold text-gray-800 flex items-center gap-2 sm:gap-3">
                        <div
                            class="w-6 h-6 sm:w-8 sm:h-8 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600 text-xs sm:text-sm font-bold">
                            1</div>
                        Floor 1 - Front Block
                    </h2>
                    <div class="hidden sm:flex items-center gap-2 text-sm text-gray-600 bg-emerald-50 px-3 py-2 rounded-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Click on a room to view seats (view only)
                    </div>
                </div>
                <div id="roomContainer"
                    class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-6">
                    <!-- Rooms will be loaded here -->
                </div>
            </div>

            <!-- Seat Grid (shown when room is selected) -->
            <div id="seatGrid"
                class="bg-white rounded-lg shadow-sm p-4 sm:p-8 mt-6 sm:mt-8 border border-emerald-200 hidden">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-3 sm:gap-4">
                    <h2 id="seatGridTitle"
                        class="text-lg sm:text-2xl font-bold text-gray-800 flex items-center gap-2 sm:gap-3">
                        <div
                            class="w-6 h-6 sm:w-8 sm:h-8 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600 text-xs sm:text-sm font-bold">
                            R</div>
                        Room Seats
                    </h2>
                    <button id="backToRooms"
                        class="flex items-center gap-2 px-3 py-2 sm:px-4 sm:py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all duration-200 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Rooms
                    </button>
                </div>
                <div class="mb-3 sm:mb-4 p-3 sm:p-4 bg-emerald-50 rounded-lg border border-emerald-200">
                    <p class="text-xs sm:text-sm text-emerald-800 flex items-center gap-2">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <strong>View Only Mode:</strong> Click on seats to view details. Seat allocation is restricted to
                        Provost level.
                    </p>
                </div>
                <div id="seatContainer"
                    class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-8 gap-2 sm:gap-4">
                    <!-- Seats will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Seat Details Modal -->
    <div id="seatModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        Seat Details
                        <span class="text-xs bg-emerald-100 text-emerald-700 px-2 py-1 rounded-full">View Only</span>
                    </h3>
                    <button id="closeModal"
                        class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="modalContent" class="space-y-4">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Assignment Modal (required by shared JS but hidden for co-provost) -->
    <div id="assignmentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50" style="display: none !important;">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
                <div id="assignmentContent"></div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('css/seat_management.css') }}">
    <script src="{{ asset('js/seat_management.js') }}"></script>
@endsection
