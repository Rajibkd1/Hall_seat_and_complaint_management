document.addEventListener('DOMContentLoaded', function() {
    // Enhanced mobile detection
    const isMobile = window.innerWidth <= 639;
    const isTouch = 'ontouchstart' in window;
    
    // Enhanced loading animation for action buttons
    const actionButtons = document.querySelectorAll('.action-btn');
    actionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!this.classList.contains('loading')) {
                this.classList.add('loading');
                const originalContent = this.innerHTML;
                
                // Create loading state
                const loadingHTML = `
                    <div class="relative">
                        <div class="p-3 bg-white/20 rounded-lg mb-3 mx-auto w-fit">
                            <i class="fas fa-spinner fa-spin text-2xl"></i>
                        </div>
                        <p class="font-semibold text-sm">Loading...</p>
                    </div>
                `;
                
                this.innerHTML = loadingHTML;
                
                // Reset after delay if not a form submission
                if (this.tagName !== 'BUTTON') {
                    setTimeout(() => {
                        this.innerHTML = originalContent;
                        this.classList.remove('loading');
                    }, 1500);
                }
            }
        });
    });

    // Enhanced hover effects for stat cards (disabled on mobile)
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach(card => {
        if (!isMobile) {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
                this.style.boxShadow = '0 25px 50px -12px rgba(0, 0, 0, 0.15)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.boxShadow = '';
            });
        } else {
            // Enhanced touch feedback for mobile
            card.addEventListener('touchstart', function() {
                this.style.transform = 'scale(0.98)';
                this.style.transition = 'transform 0.1s ease';
            });
            
            card.addEventListener('touchend', function() {
                this.style.transform = 'scale(1)';
                setTimeout(() => {
                    this.style.transition = '';
                }, 100);
            });
        }
    });

    // Enhanced click animations for complaint items
    const complaintItems = document.querySelectorAll('.complaint-item');
    complaintItems.forEach(item => {
        item.addEventListener('click', function(e) {
            // Don't animate if clicking on delete button
            if (e.target.closest('button')) return;
            
            this.style.transform = 'scale(0.99)';
            this.style.transition = 'transform 0.1s ease';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
                setTimeout(() => {
                    this.style.transition = '';
                }, 100);
            }, 100);
        });
    });

    // Enhanced notification system
    const noticeCount = {{ $stats['recent_notices']->count() }};
    if (noticeCount > 0) {
        setTimeout(() => {
            const notification = document.createElement('div');
            notification.className = `fixed ${isMobile ? 'top-4 left-4 right-4' : 'top-6 right-6'} bg-gradient-to-r from-slate-800 to-slate-900 backdrop-blur-xl text-white px-6 py-4 rounded-xl shadow-2xl z-50 border border-slate-700/50 transform translate-y-0 opacity-100 transition-all duration-500`;
            notification.innerHTML = `
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-2 bg-indigo-500/20 rounded-lg mr-3">
                            <i class="fas fa-bell text-indigo-400"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-sm">New Notices Available!</p>
                            <p class="text-xs text-slate-300">You have ${noticeCount} new notice${noticeCount > 1 ? 's' : ''} to review</p>
                        </div>
                    </div>
                    <button onclick="this.parentElement.parentElement.style.transform='translateY(-100%)'; this.parentElement.parentElement.style.opacity='0'; setTimeout(() => this.parentElement.parentElement.remove(), 300)" class="ml-4 text-slate-400 hover:text-white p-2 transition-colors duration-200 rounded-lg hover:bg-white/10">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            // Initial state for animation
            notification.style.transform = 'translateY(-100%)';
            notification.style.opacity = '0';
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.style.transform = 'translateY(0)';
                notification.style.opacity = '1';
            }, 100);
            
            // Auto remove after 6 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.style.transform = 'translateY(-100%)';
                    notification.style.opacity = '0';
                    setTimeout(() => notification.remove(), 300);
                }
            }, 6000);
        }, 2000);
    }

    // Enhanced orientation change handling
    let orientationTimer;
    window.addEventListener('orientationchange', function() {
        clearTimeout(orientationTimer);
        orientationTimer = setTimeout(() => {
            // Recalculate layouts and animations
            const elements = document.querySelectorAll('.stat-card, .action-btn, .complaint-item, .notice-item');
            elements.forEach(el => {
                el.style.animation = 'none';
                el.offsetHeight; // Trigger reflow
                el.style.animation = null;
            });
        }, 500);
    });

    // Enhanced intersection observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe elements for scroll animations
    const animatedElements = document.querySelectorAll('.stat-card, .action-btn, .complaint-item, .notice-item');
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

    // Enhanced keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            document.body.classList.add('keyboard-navigation');
        }
    });

    document.addEventListener('mousedown', function() {
        document.body.classList.remove('keyboard-navigation');
    });

    // Performance optimization: Debounce resize events
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            // Recalculate any size-dependent features
            const isMobileNew = window.innerWidth <= 639;
            if (isMobileNew !== isMobile) {
                location.reload();
            }
        }, 250);
    });
});

