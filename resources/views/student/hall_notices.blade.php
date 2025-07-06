@extends('layouts.app')

@section('content')
<div class="min-h-screen font-inter relative overflow-x-hidden bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100">
    <!-- Header -->
    <header class="bg-white/80 backdrop-blur-lg shadow-lg border-b border-gray-200/50 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center justify-center py-6 space-y-4">
                <!-- Title -->
                <div class="text-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Hall Notice Board</h1>
                    <p class="text-gray-600 text-sm md:text-base">Stay updated with the latest announcements and events</p>
                </div>
                
                <!-- Enhanced Search Section -->
                <div class="w-full max-w-2xl">
                    <div class="relative group">
                        <input type="text" 
                               id="searchInput" 
                               placeholder="Search notices, events, announcements..." 
                               class="w-full px-6 py-4 bg-white/90 backdrop-blur-md border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 shadow-lg hover:shadow-xl text-base md:text-lg">
                        
                        <!-- Search Icon -->
                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 transition-all duration-300">
                            <svg class="w-6 h-6 text-gray-400 group-focus-within:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
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
            <button class="filter-tag active px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 border border-blue-500 rounded-full text-white text-sm font-semibold hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105" data-filter="all">
                <span class="mr-2">📋</span>All Notices
            </button>
            <button class="filter-tag px-6 py-3 bg-white/80 backdrop-blur-md border border-gray-200 rounded-full text-gray-700 text-sm font-semibold hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105" data-filter="announcement">
                <span class="mr-2">📢</span>Announcements
            </button>
            <button class="filter-tag px-6 py-3 bg-white/80 backdrop-blur-md border border-gray-200 rounded-full text-gray-700 text-sm font-semibold hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105" data-filter="event">
                <span class="mr-2">🎉</span>Events
            </button>
            <button class="filter-tag px-6 py-3 bg-white/80 backdrop-blur-md border border-gray-200 rounded-full text-gray-700 text-sm font-semibold hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105" data-filter="deadline">
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
            @foreach($notices->sortByDesc('date_posted') as $index => $notice)
                <div class="notice-card bg-white/90 backdrop-blur-lg rounded-2xl p-6 border border-gray-200/50 cursor-pointer transition-all duration-300 hover:shadow-2xl shadow-lg animate-notice-appear relative group" 
                     style="animation-delay: {{ $index * 0.1 }}s" 
                     data-notice-id="{{ $notice->notice_id }}"
                     data-notice-type="{{ $notice->notice_type }}"
                     data-notice-title="{{ strtolower($notice->title) }}"
                     data-notice-description="{{ strtolower($notice->description) }}">
                    
                    <div class="priority-badge">
                        <div class="w-10 h-10 notice-priority-{{ $notice->notice_type === 'deadline' ? 'high' : ($notice->notice_type === 'event' ? 'medium' : 'low') }} rounded-full flex items-center justify-center text-white text-lg font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                            {{ $notice->notice_type === 'deadline' ? '⏰' : ($notice->notice_type === 'event' ? '🎉' : '📢') }}
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">{{ $notice->title }}</h3>
                        <p class="text-gray-600 text-sm line-clamp-3 leading-relaxed">{{ Str::limit($notice->description, 150) }}</p>
                    </div>
                    
                    <div class="flex items-center justify-between text-gray-500 text-sm">
                        <div class="flex items-center space-x-3">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $notice->date_posted->format('M d, Y') }}
                            </span>
                            <span class="px-3 py-1 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 rounded-full text-xs font-semibold">
                                {{ ucfirst($notice->notice_type) }}
                            </span>
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($notice->attachment)
                                <span class="text-green-600" title="Has attachment">📎</span>
                            @endif
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Load More Button -->
        @if($notices->hasMorePages())
            <div class="text-center mt-12">
                <button id="loadMoreBtn" class="px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-full hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 font-semibold text-lg">
                    <span class="mr-2">⬇️</span>Load More Notices
                </button>
            </div>
        @endif
    </main>

    <!-- Notice Modal -->
    <div id="noticeModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white/95 backdrop-blur-lg rounded-3xl max-w-3xl w-full max-h-[90vh] overflow-y-auto border border-gray-200 shadow-2xl animate-bounce-in">
            <div class="p-8">
                <div class="flex justify-between items-start mb-6">
                    <div class="flex-1 pr-4">
                        <h2 id="modalTitle" class="text-3xl font-bold text-gray-800 mb-3"></h2>
                        <div class="flex flex-wrap items-center gap-4 text-gray-600 text-sm">
                            <span id="modalDate" class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </span>
                            <span id="modalCategory" class="px-3 py-1 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 rounded-full font-semibold"></span>
                        </div>
                    </div>
                    <button id="closeModal" class="w-12 h-12 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <div id="modalContent" class="text-gray-700 text-lg leading-relaxed mb-8 whitespace-pre-wrap"></div>
                
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pt-6 border-t border-gray-200 gap-4">
                    <div class="flex flex-wrap items-center gap-4 text-gray-500 text-sm">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span id="modalAuthor"></span>
                        </span>
                        <span id="modalValidUntil" class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="flex space-x-3">
                        <button class="px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg transition-all duration-300 font-semibold hover:scale-105">
                            <span class="mr-1">📤</span>Share
                        </button>
                        <button id="downloadBtn" class="px-4 py-2 bg-green-50 hover:bg-green-100 text-green-700 rounded-lg transition-all duration-300 font-semibold hover:scale-105" style="display: none;">
                            <span class="mr-1">📥</span>Download
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    class HallNoticeBoard {
        constructor() {
            this.currentPage = 1;
            this.currentFilter = 'all';
            this.allNotices = [];
            this.initializeElements();
            this.bindEvents();
            this.storeOriginalNotices();
        }

        initializeElements() {
            this.noticesContainer = document.getElementById('noticesContainer');
            this.searchInput = document.getElementById('searchInput');
            this.filterTags = document.querySelectorAll('.filter-tag');
            this.loadMoreBtn = document.getElementById('loadMoreBtn');
            this.noticeModal = document.getElementById('noticeModal');
            this.closeModal = document.getElementById('closeModal');
            this.noResults = document.getElementById('noResults');
            this.searchResults = document.getElementById('searchResults');
            this.resultsCount = document.getElementById('resultsCount');
        }

        storeOriginalNotices() {
            this.allNotices = Array.from(document.querySelectorAll('.notice-card')).map(card => ({
                element: card,
                id: card.dataset.noticeId,
                type: card.dataset.noticeType,
                title: card.dataset.noticeTitle,
                description: card.dataset.noticeDescription
            }));
        }

        bindEvents() {
            let searchTimeout;
            this.searchInput.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.performSearch(e.target.value);
                }, 300);
            });

            this.filterTags.forEach(tag => {
                tag.addEventListener('click', (e) => {
                    this.setActiveFilter(e.target);
                    this.filterNotices(e.target.dataset.filter);
                });
            });

            if (this.loadMoreBtn) {
                this.loadMoreBtn.addEventListener('click', () => {
                    this.loadMoreNotices();
                });
            }

            this.closeModal.addEventListener('click', () => {
                this.closeNoticeModal();
            });

            this.noticeModal.addEventListener('click', (e) => {
                if (e.target === this.noticeModal) {
                    this.closeNoticeModal();
                }
            });

            // ESC key to close modal
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !this.noticeModal.classList.contains('hidden')) {
                    this.closeNoticeModal();
                }
            });

            this.bindNoticeCardEvents();
        }

        bindNoticeCardEvents() {
            document.querySelectorAll('.notice-card').forEach(card => {
                card.addEventListener('click', (e) => {
                    e.preventDefault();
                    const noticeId = card.dataset.noticeId;
                    this.openNoticeModal(noticeId);
                });
            });
        }

        performSearch(query) {
            const searchLoader = document.getElementById('searchLoader');
            const searchIcon = this.searchInput.nextElementSibling.querySelector('svg');
            
            searchLoader.classList.remove('hidden');
            searchIcon.style.display = 'none';
            
            setTimeout(() => {
                const filteredNotices = this.filterNoticesBySearch(query);
                this.displayFilteredNotices(filteredNotices);
                this.updateSearchResults(filteredNotices.length, query);
                
                searchLoader.classList.add('hidden');
                searchIcon.style.display = 'block';
            }, 300);
        }

        filterNoticesBySearch(query) {
            if (!query.trim()) {
                return this.allNotices.filter(notice => 
                    this.currentFilter === 'all' || notice.type === this.currentFilter
                );
            }

            const searchTerm = query.toLowerCase();
            return this.allNotices.filter(notice => {
                const matchesSearch = notice.title.includes(searchTerm) || 
                                    notice.description.includes(searchTerm);
                const matchesFilter = this.currentFilter === 'all' || notice.type === this.currentFilter;
                return matchesSearch && matchesFilter;
            });
        }

        displayFilteredNotices(notices) {
            this.noticesContainer.innerHTML = '';
            
            if (notices.length === 0) {
                this.noResults.classList.remove('hidden');
                return;
            }

            this.noResults.classList.add('hidden');
            notices.forEach((notice, index) => {
                const clonedCard = notice.element.cloneNode(true);
                clonedCard.style.animationDelay = `${index * 0.1}s`;
                this.noticesContainer.appendChild(clonedCard);
            });

            this.bindNoticeCardEvents();
        }

        updateSearchResults(count, query) {
            if (query.trim()) {
                this.resultsCount.textContent = count;
                this.searchResults.classList.remove('hidden');
            } else {
                this.searchResults.classList.add('hidden');
            }
        }

        filterNotices(type) {
            this.currentFilter = type;
            const query = this.searchInput.value;
            const filteredNotices = this.filterNoticesBySearch(query);
            this.displayFilteredNotices(filteredNotices);
            this.updateSearchResults(filteredNotices.length, query);
        }

        async loadMoreNotices() {
            this.currentPage++;
            try {
                const searchQuery = this.searchInput.value;
                const response = await fetch(`{{ route('student.hall-notice') }}?page=${this.currentPage}&type=${this.currentFilter}&search=${encodeURIComponent(searchQuery)}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const data = await response.json();
                this.appendNotices(data.notices);
                this.updateLoadMoreButton(data.has_more);
                this.bindNoticeCardEvents();
            } catch (error) {
                console.error('Load more failed:', error);
            }
        }

        async openNoticeModal(noticeId) {
            try {
                const response = await fetch(`{{ route('student.hall-notice', '') }}/${noticeId}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const notice = await response.json();
                this.populateModal(notice);
                this.showModal();
            } catch (error) {
                console.error('Failed to load notice details:', error);
                this.showFallbackModal(noticeId);
            }
        }

        populateModal(notice) {
            document.getElementById('modalTitle').textContent = notice.title;
            document.getElementById('modalDate').innerHTML = `
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                ${new Date(notice.date_posted).toLocaleDateString('en-US', { 
                    year: 'numeric', 
                    month: 'short', 
                    day: 'numeric' 
                })}
            `;
            document.getElementById('modalCategory').textContent = notice.notice_type.charAt(0).toUpperCase() + notice.notice_type.slice(1);
            document.getElementById('modalContent').textContent = notice.description;
            document.getElementById('modalAuthor').textContent = notice.admin ? notice.admin.name : 'Hall Administration';
            
            if (notice.valid_until) {
                document.getElementById('modalValidUntil').innerHTML = `
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Valid until: ${new Date(notice.valid_until).toLocaleDateString()}
                `;
            } else {
                document.getElementById('modalValidUntil').innerHTML = '';
            }

            const downloadBtn = document.getElementById('downloadBtn');
            if (notice.attachment) {
                downloadBtn.style.display = 'block';
                downloadBtn.onclick = () => window.open(notice.attachment, '_blank');
            } else {
                downloadBtn.style.display = 'none';
            }
        }

        showFallbackModal(noticeId) {
            const card = document.querySelector(`[data-notice-id="${noticeId}"]`);
            if (card) {
                const title = card.querySelector('h3').textContent;
                const description = card.querySelector('p').textContent;
                const dateElement = card.querySelector('span');
                const date = dateElement ? dateElement.textContent : 'Unknown date';
                
                document.getElementById('modalTitle').textContent = title;
                document.getElementById('modalDate').innerHTML = `
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    ${date}
                `;
                document.getElementById('modalContent').textContent = description;
                document.getElementById('modalAuthor').textContent = 'Hall Administration';
                document.getElementById('modalValidUntil').innerHTML = '';
                document.getElementById('downloadBtn').style.display = 'none';
                
                this.showModal();
            }
        }

        showModal() {
            this.noticeModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        closeNoticeModal() {
            this.noticeModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        appendNotices(notices) {
            notices.forEach((notice, index) => {
                this.noticesContainer.appendChild(this.createNoticeCard(notice, index));
            });
        }

        createNoticeCard(notice, index) {
            const card = document.createElement('div');
            card.className = 'notice-card bg-white/90 backdrop-blur-lg rounded-2xl p-6 border border-gray-200/50 cursor-pointer transition-all duration-300 hover:shadow-2xl shadow-lg animate-notice-appear relative group';
            card.style.animationDelay = `${index * 0.1}s`;
            card.dataset.noticeId = notice.notice_id;
            card.dataset.noticeType = notice.notice_type;
            card.dataset.noticeTitle = notice.title.toLowerCase();
            card.dataset.noticeDescription = notice.description.toLowerCase();

            const priorityClass = notice.notice_type === 'deadline' ? 'notice-priority-high' : 
                                 notice.notice_type === 'event' ? 'notice-priority-medium' : 'notice-priority-low';
            const priorityIcon = notice.notice_type === 'deadline' ? '⏰' : 
                                notice.notice_type === 'event' ? '🎉' : '📢';

            card.innerHTML = `
                <div class="priority-badge">
                    <div class="w-10 h-10 ${priorityClass} rounded-full flex items-center justify-center text-white text-lg font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                        ${priorityIcon}
                    </div>
                </div>
                
                <div class="mb-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">${notice.title}</h3>
                    <p class="text-gray-600 text-sm line-clamp-3 leading-relaxed">${notice.description.substring(0, 150)}${notice.description.length > 150 ? '...' : ''}</p>
                </div>
                
                <div class="flex items-center justify-between text-gray-500 text-sm">
                    <div class="flex items-center space-x-3">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            ${new Date(notice.date_posted).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' })}
                        </span>
                        <span class="px-3 py-1 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 rounded-full text-xs font-semibold">${notice.notice_type.charAt(0).toUpperCase() + notice.notice_type.slice(1)}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        ${notice.attachment ? '<span class="text-green-600" title="Has attachment">📎</span>' : ''}
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            `;

            return card;
        }

        updateLoadMoreButton(hasMore) {
            if (this.loadMoreBtn) {
                this.loadMoreBtn.style.display = hasMore ? 'block' : 'none';
            }
        }

        setActiveFilter(activeTag) {
            this.filterTags.forEach(tag => {
                tag.classList.remove('active', 'bg-gradient-to-r', 'from-blue-500', 'to-blue-600', 'text-white', 'border-blue-500');
                tag.classList.add('bg-white/80', 'border-gray-200', 'text-gray-700');
            });
            activeTag.classList.add('active', 'bg-gradient-to-r', 'from-blue-500', 'to-blue-600', 'text-white', 'border-blue-500');
            activeTag.classList.remove('bg-white/80', 'border-gray-200', 'text-gray-700');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        new HallNoticeBoard();
    });
</script>

<style>
    .notice-priority-high {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        animation: pulse 2s infinite;
    }
    
    .notice-priority-medium {
        background: linear-gradient(135deg, #feca57, #ff9ff3);
    }
    
    .notice-priority-low {
        background: linear-gradient(135deg, #48dbfb, #0abde3);
    }
    
    .notice-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    .priority-badge {
        position: absolute;
        top: -12px;
        right: -12px;
        z-index: 10;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Enhanced animations */
    @keyframes slideDown {
        0% { transform: translateY(-40px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }

    @keyframes slideUp {
        0% { transform: translateY(40px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }

    @keyframes bounceIn {
        0% { transform: scale(0.3); opacity: 0; }
        50% { transform: scale(1.05); }
        70% { transform: scale(0.9); }
        100% { transform: scale(1); opacity: 1; }
    }

    @keyframes noticeAppear {
        0% { transform: translateX(-100%); opacity: 0; }
        100% { transform: translateX(0); opacity: 1; }
    }

    .animate-slide-down { animation: slideDown 0.6s ease-out; }
    .animate-slide-up { animation: slideUp 0.8s ease-out; }
    .animate-bounce-in { animation: bounceIn 0.6s ease-out; }
    .animate-notice-appear { animation: noticeAppear 0.5s ease-out; }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .notice-card {
            margin-bottom: 1rem;
        }
        
        .filter-tag {
            font-size: 0.75rem;
            padding: 0.5rem 1rem;
        }
        
        #searchInput {
            font-size: 1rem;
            padding: 1rem 1.5rem;
        }
    }

    /* Smooth scrolling for better UX */
    html {
        scroll-behavior: smooth;
    }

    /* Focus states for accessibility */
    .notice-card:focus {
        outline: 2px solid #3b82f6;
        outline-offset: 2px;
    }

    .filter-tag:focus {
        outline: 2px solid #3b82f6;
        outline-offset: 2px;
    }
</style>
@endsection
