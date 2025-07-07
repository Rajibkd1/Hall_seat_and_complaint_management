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