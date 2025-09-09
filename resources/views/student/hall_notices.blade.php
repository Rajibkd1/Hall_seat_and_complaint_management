@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_create_notice.css') }}">
@endpush

@section('content')
    <div
        class="min-h-screen font-inter relative overflow-x-hidden bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100">
        <!-- Header -->
        <header class="bg-white/80 backdrop-blur-lg shadow-lg border-b border-gray-200/50 sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center justify-center py-6 space-y-4">
                    <!-- Title -->
                    <div class="text-center">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Hall Notice Board</h1>
                        <p class="text-gray-600 text-sm md:text-base">Stay updated with the latest announcements and events
                        </p>
                    </div>

                    <!-- Enhanced Search Section -->
                    <div class="w-full max-w-2xl">
                        <div class="relative group">
                            <input type="text" id="searchInput" placeholder="Search notices, events, announcements..."
                                class="w-full px-6 py-4 bg-white/90 backdrop-blur-md border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 shadow-lg hover:shadow-xl text-base md:text-lg">

                            <!-- Search Icon -->
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 transition-all duration-300">
                                <svg class="w-6 h-6 text-gray-400 group-focus-within:text-blue-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>

                            <!-- Search Loading Indicator -->
                            <div id="searchLoader" class="absolute right-4 top-1/2 transform -translate-y-1/2 hidden">
                                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-500"></div>
                            </div>

                            <!-- Search Results Count -->
                            <div id="searchResults" class="absolute left-6 -bottom-8 text-sm text-gray-500 hidden">
                                <span id="resultsCount">0</span> results found
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Filter Tags -->
            <div class="flex flex-wrap justify-center gap-3 mb-8 animate-slide-up">
                <button
                    class="filter-tag active px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 border border-blue-500 rounded-full text-white text-sm font-semibold hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
                    data-filter="all">
                    <span class="mr-2">📋</span>All Notices
                </button>
                <button
                    class="filter-tag px-6 py-3 bg-white/80 backdrop-blur-md border border-gray-200 rounded-full text-gray-700 text-sm font-semibold hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105"
                    data-filter="announcement">
                    <span class="mr-2">📢</span>Announcements
                </button>
                <button
                    class="filter-tag px-6 py-3 bg-white/80 backdrop-blur-md border border-gray-200 rounded-full text-gray-700 text-sm font-semibold hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105"
                    data-filter="event">
                    <span class="mr-2">🎉</span>Events
                </button>
                <button
                    class="filter-tag px-6 py-3 bg-white/80 backdrop-blur-md border border-gray-200 rounded-full text-gray-700 text-sm font-semibold hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105"
                    data-filter="deadline">
                    <span class="mr-2">⏰</span>Deadlines
                </button>
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="text-center py-12 hidden">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No notices found</h3>
                <p class="text-gray-500">Try adjusting your search or filter criteria</p>
            </div>

            <!-- Notices Grid -->
            <div id="noticesContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($notices->sortByDesc('date_posted') as $index => $notice)
                    <div class="notice-card bg-white/90 backdrop-blur-lg rounded-2xl p-6 border border-gray-200/50 cursor-pointer transition-all duration-300 hover:shadow-2xl shadow-lg animate-notice-appear relative group"
                        style="animation-delay: {{ $index * 0.1 }}s" data-notice-id="{{ $notice->notice_id }}"
                        data-notice-type="{{ $notice->notice_type }}" data-notice-title="{{ strtolower($notice->title) }}"
                        data-notice-description="{{ strtolower($notice->description) }}">

                        <div class="priority-badge">
                            <div
                                class="w-10 h-10 notice-priority-{{ $notice->notice_type === 'deadline' ? 'high' : ($notice->notice_type === 'event' ? 'medium' : 'low') }} rounded-full flex items-center justify-center text-white text-lg font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                {{ $notice->notice_type === 'deadline' ? '⏰' : ($notice->notice_type === 'event' ? '🎉' : '📢') }}
                            </div>
                        </div>

                        <div class="mb-4">
                            <h3
                                class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">
                                {{ $notice->title }}</h3>
                            <div class="text-gray-600 text-sm line-clamp-3 leading-relaxed rich-text-preview">
                                {!! Str::limit(strip_tags($notice->description), 150) !!}</div>
                        </div>

                        <div class="flex items-center justify-between text-gray-500 text-sm">
                            <div class="flex items-center space-x-3">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $notice->date_posted->format('M d, Y') }}
                                </span>
                                <span
                                    class="px-3 py-1 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 rounded-full text-xs font-semibold">
                                    {{ ucfirst($notice->notice_type) }}
                                </span>
                            </div>
                            <div class="flex items-center space-x-2">
                                @if ($notice->attachment)
                                    <span class="text-green-600" title="Has attachment">📎</span>
                                @endif
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Load More Button -->
            @if ($notices->hasMorePages())
                <div class="text-center mt-12">
                    <button id="loadMoreBtn"
                        class="px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-full hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 font-semibold text-lg">
                        <span class="mr-2">⬇️</span>Load More Notices
                    </button>
                </div>
            @endif
        </main>

        <!-- Notice Modal -->
        <div id="noticeModal"
            class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
            <div
                class="bg-white/95 backdrop-blur-lg rounded-3xl max-w-3xl w-full max-h-[90vh] overflow-y-auto border border-gray-200 shadow-2xl animate-bounce-in">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex-1 pr-4">
                            <h2 id="modalTitle" class="text-3xl font-bold text-gray-800 mb-3"></h2>
                            <div class="flex flex-wrap items-center gap-4 text-gray-600 text-sm">
                                <span id="modalDate" class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </span>
                                <span id="modalCategory"
                                    class="px-3 py-1 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 rounded-full font-semibold"></span>
                            </div>
                        </div>
                        <button id="closeModal"
                            class="w-12 h-12 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div id="modalContent" class="text-gray-700 text-lg leading-relaxed mb-8 rich-text-content"></div>

                    <div
                        class="flex flex-col sm:flex-row items-start sm:items-center justify-between pt-6 border-t border-gray-200 gap-4">
                        <div class="flex flex-wrap items-center gap-4 text-gray-500 text-sm">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span id="modalAuthor"></span>
                            </span>
                            <span id="modalValidUntil" class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="flex space-x-3">
                            <button
                                class="px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg transition-all duration-300 font-semibold hover:scale-105">
                                <span class="mr-1">📤</span>Share
                            </button>
                            <button id="downloadBtn"
                                class="px-4 py-2 bg-green-50 hover:bg-green-100 text-green-700 rounded-lg transition-all duration-300 font-semibold hover:scale-105"
                                style="display: none;">
                                <span class="mr-1">📥</span>Download
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('css/hall_notices.css') }}">
    <script src="{{ asset('js/hall_notices.js') }}"></script>
@endsection
