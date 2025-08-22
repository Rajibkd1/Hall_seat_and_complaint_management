@include('layouts.admin_layout_helper')
@extends($layout)

@section('title', 'Seat Management')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-gray-50 to-slate-100">
        <!-- Animated Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-slate-200/30 to-gray-300/20 rounded-full blur-3xl animate-float">
            </div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-gray-200/30 to-slate-300/20 rounded-full blur-3xl animate-float"
                style="animation-delay: -2s;"></div>
        </div>

        <!-- Compact Header Section -->
        <div class="relative bg-white/95 backdrop-blur-sm border-b border-gray-200/50 py-3 px-4 shadow-sm">
            <div class="container mx-auto">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="space-y-1">
                        <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                            Seat Management
                        </h1>
                        <p class="text-gray-600 text-xs sm:text-sm font-medium">Elegant hall seat visualization and
                            management</p>
                    </div>
                    <div class="hidden lg:block">
                        <div class="bg-white/90 backdrop-blur-sm rounded-xl p-3 border border-gray-200/50 shadow-lg">
                            <div class="flex items-center space-x-4 text-xs">
                                <div class="text-center group">
                                    <div class="text-sm font-bold text-slate-900 mb-0.5 group-hover:scale-105 transition-transform duration-300"
                                        id="totalSeatsHeader">{{ $totalSeats }}</div>
                                    <div class="text-slate-600 font-medium uppercase tracking-wide text-xs">Total</div>
                                </div>
                                <div class="w-px h-6 bg-gradient-to-b from-transparent via-gray-300 to-transparent"></div>
                                <div class="text-center group">
                                    <div class="text-sm font-bold text-slate-900 mb-0.5 group-hover:scale-105 transition-transform duration-300"
                                        id="occupiedHeader">{{ $occupiedSeats }}</div>
                                    <div class="text-slate-600 font-medium uppercase tracking-wide text-xs">Occupied</div>
                                </div>
                                <div class="w-px h-6 bg-gradient-to-b from-transparent via-gray-300 to-transparent"></div>
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
                class="relative bg-white/90 backdrop-blur-sm rounded-2xl sm:rounded-3xl shadow-2xl border border-gray-200/50 p-4 sm:p-8 mb-6 sm:mb-8 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-50/50 to-gray-50/50"></div>
                <div class="relative flex flex-col sm:flex-row sm:flex-wrap items-stretch sm:items-center gap-4 sm:gap-8">
                    <!-- Floor Selection -->
                    <div class="flex items-center gap-3 sm:gap-4 group">
                        <div
                            class="w-10 h-10 sm:w-14 sm:h-14 bg-gradient-to-br from-slate-100 to-gray-200 rounded-xl sm:rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-5 h-5 sm:w-7 sm:h-7 text-slate-700" fill="none" stroke="currentColor"
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
                                class="form-select w-full border-2 border-slate-200 rounded-xl sm:rounded-2xl px-3 py-2 sm:px-6 sm:py-3 bg-white/80 backdrop-blur-sm focus:border-slate-400 focus:ring-0 transition-all duration-300 font-semibold text-slate-800 shadow-lg text-sm sm:text-base">
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
                            class="w-10 h-10 sm:w-14 sm:h-14 bg-gradient-to-br from-slate-100 to-gray-200 rounded-xl sm:rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-5 h-5 sm:w-7 sm:h-7 text-slate-700" fill="none" stroke="currentColor"
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
                                class="form-select w-full border-2 border-slate-200 rounded-xl sm:rounded-2xl px-3 py-2 sm:px-6 sm:py-3 bg-white/80 backdrop-blur-sm focus:border-slate-400 focus:ring-0 transition-all duration-300 font-semibold text-slate-800 shadow-lg text-sm sm:text-base">
                                <option value="Front">Front Block</option>
                                <option value="Back">Back Block</option>
                            </select>
                        </div>
                    </div>

                    <!-- Enhanced Load Button -->
                    <button id="loadRooms"
                        class="bg-gradient-to-r from-slate-800 to-slate-900 hover:from-slate-900 hover:to-black text-white px-6 py-3 sm:px-8 sm:py-4 rounded-xl sm:rounded-2xl font-bold transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105 flex items-center justify-center gap-2 sm:gap-3 group w-full sm:w-auto">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 group-hover:rotate-180 transition-transform duration-500"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        <span class="text-sm sm:text-lg">Load Rooms</span>
                    </button>

                    <!-- Allocated Students Button -->
                    <a href="{{ route('admin.applications.allocated') }}"
                        class="bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white px-6 py-3 sm:px-8 sm:py-4 rounded-xl sm:rounded-2xl font-bold transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105 flex items-center justify-center gap-2 sm:gap-3 group w-full sm:w-auto">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 group-hover:scale-110 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <span class="text-sm sm:text-lg">Allocated Students</span>
                    </a>
                </div>
            </div>

            <!-- Enhanced Legend -->
            <div
                class="relative bg-white/90 backdrop-blur-sm rounded-2xl sm:rounded-3xl shadow-xl border border-gray-200/50 p-4 sm:p-8 mb-6 sm:mb-8 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-50/30 to-gray-50/30"></div>
                <div class="relative">
                    <h3 class="text-lg sm:text-2xl font-black text-slate-900 mb-4 sm:mb-6 flex items-center gap-2 sm:gap-3">
                        <div
                            class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-slate-600 to-slate-800 rounded-xl sm:rounded-2xl flex items-center justify-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="bg-gradient-to-r from-slate-800 to-slate-900 bg-clip-text text-transparent">Status
                            Legend</span>
                    </h3>
                    <div class="flex flex-wrap gap-3 sm:gap-6">
                        <div
                            class="flex items-center gap-2 sm:gap-4 bg-white/80 backdrop-blur-sm px-3 py-2 sm:px-6 sm:py-4 rounded-xl sm:rounded-2xl border border-gray-200/50 shadow-lg hover:shadow-xl transition-all duration-300 group">
                            <div
                                class="w-6 h-6 sm:w-8 sm:h-8 bg-slate-900 rounded-lg sm:rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <span
                                class="text-xs sm:text-sm font-bold text-slate-800 uppercase tracking-wider">Occupied</span>
                        </div>
                        <div
                            class="flex items-center gap-2 sm:gap-4 bg-white/80 backdrop-blur-sm px-3 py-2 sm:px-6 sm:py-4 rounded-xl sm:rounded-2xl border border-gray-200/50 shadow-lg hover:shadow-xl transition-all duration-300 group">
                            <div
                                class="w-6 h-6 sm:w-8 sm:h-8 bg-white border-2 border-slate-400 rounded-lg sm:rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <span
                                class="text-xs sm:text-sm font-bold text-slate-800 uppercase tracking-wider">Available</span>
                        </div>
                        <div
                            class="flex items-center gap-2 sm:gap-4 bg-white/80 backdrop-blur-sm px-3 py-2 sm:px-6 sm:py-4 rounded-xl sm:rounded-2xl border border-gray-200/50 shadow-lg hover:shadow-xl transition-all duration-300 group">
                            <div
                                class="w-6 h-6 sm:w-8 sm:h-8 bg-slate-600 rounded-lg sm:rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <span
                                class="text-xs sm:text-sm font-bold text-slate-800 uppercase tracking-wider">Maintenance</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Summary -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div
                    class="bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wide">Occupied</p>
                            <p class="text-xl sm:text-3xl font-bold text-gray-900 mt-1 sm:mt-2" id="occupiedCount">
                                {{ $occupiedSeats }}</p>
                            <p class="text-xs text-gray-400 mt-0.5 sm:mt-1">Active seats</p>
                        </div>
                        <div
                            class="w-8 h-8 sm:w-12 sm:h-12 bg-gray-900 rounded-lg sm:rounded-xl flex items-center justify-center">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wide">Available</p>
                            <p class="text-xl sm:text-3xl font-bold text-gray-900 mt-1 sm:mt-2" id="availableCount">
                                {{ $availableSeats }}</p>
                            <p class="text-xs text-gray-400 mt-0.5 sm:mt-1">Open seats</p>
                        </div>
                        <div
                            class="w-8 h-8 sm:w-12 sm:h-12 bg-gray-700 rounded-lg sm:rounded-xl flex items-center justify-center">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wide">Maintenance</p>
                            <p class="text-xl sm:text-3xl font-bold text-gray-900 mt-1 sm:mt-2" id="maintenanceCount">
                                {{ $maintenanceSeats }}</p>
                            <p class="text-xs text-gray-400 mt-0.5 sm:mt-1">Under repair</p>
                        </div>
                        <div
                            class="w-8 h-8 sm:w-12 sm:h-12 bg-gray-500 rounded-lg sm:rounded-xl flex items-center justify-center">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wide">Total Rooms</p>
                            <p class="text-xl sm:text-3xl font-bold text-gray-900 mt-1 sm:mt-2" id="totalRooms">
                                {{ $totalRooms }}</p>
                            <p class="text-xs text-gray-400 mt-0.5 sm:mt-1">All rooms</p>
                        </div>
                        <div
                            class="w-8 h-8 sm:w-12 sm:h-12 bg-gray-600 rounded-lg sm:rounded-xl flex items-center justify-center">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Room Grid -->
            <div id="roomGrid" class="bg-white rounded-lg shadow-sm p-4 sm:p-8 border border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-3">
                    <h2 id="gridTitle"
                        class="text-lg sm:text-2xl font-bold text-gray-800 flex items-center gap-2 sm:gap-3">
                        <div
                            class="w-6 h-6 sm:w-8 sm:h-8 bg-gray-100 rounded-lg flex items-center justify-center text-gray-600 text-xs sm:text-sm font-bold">
                            1</div>
                        Floor 1 - Front Block
                    </h2>
                    <div class="hidden sm:flex items-center gap-2 text-sm text-gray-600 bg-gray-50 px-3 py-2 rounded-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        Click on a room to view seats
                    </div>
                </div>
                <div id="roomContainer"
                    class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-6">
                    <!-- Rooms will be loaded here -->
                </div>
            </div>

            <!-- Seat Grid (shown when room is selected) -->
            <div id="seatGrid"
                class="bg-white rounded-lg shadow-sm p-4 sm:p-8 mt-6 sm:mt-8 border border-gray-200 hidden">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-3 sm:gap-4">
                    <h2 id="seatGridTitle"
                        class="text-lg sm:text-2xl font-bold text-gray-800 flex items-center gap-2 sm:gap-3">
                        <div
                            class="w-6 h-6 sm:w-8 sm:h-8 bg-gray-100 rounded-lg flex items-center justify-center text-gray-600 text-xs sm:text-sm font-bold">
                            R</div>
                        Room Seats
                    </h2>
                    <button id="backToRooms"
                        class="flex items-center gap-2 px-3 py-2 sm:px-4 sm:py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-all duration-200 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Rooms
                    </button>
                </div>
                <div class="mb-3 sm:mb-4 p-3 sm:p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <p class="text-xs sm:text-sm text-blue-800 flex items-center gap-2">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Click on available seats to assign students, or occupied seats to view details
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
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        Seat Details
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

    <!-- Assignment Modal -->
    <div id="assignmentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center text-green-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        Assign Seat
                    </h3>
                    <button id="closeAssignmentModal"
                        class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="assignmentContent" class="space-y-4">
                    <!-- Assignment form will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('css/seat_management.css') }}">
    <script>
        // Set the base URL for API calls based on current route
        window.seatManagementConfig = {
            baseUrl: '/admin',
            userRole: 'admin'
        };
    </script>
    <script src="{{ asset('js/seat_management.js') }}"></script>
@endsection
