document.addEventListener('DOMContentLoaded', function() {
    // Mobile-optimized touch interactions
    const isMobile = window.innerWidth <= 640;
    
    // Add loading animation to action buttons
    const actionButtons = document.querySelectorAll('.action-btn');
    actionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!this.classList.contains('loading')) {
                this.classList.add('loading');
                const originalContent = this.innerHTML;
                
                if (isMobile) {
                    this.innerHTML = '<i class="fas fa-spinner fa-spin text-lg mb-1"></i><p class="font-semibold text-xs">Loading...</p>';
                } else {
                    this.innerHTML = '<i class="fas fa-spinner fa-spin text-2xl mb-2"></i><p class="font-semibold">Loading...</p>';
                }
                
                // Reset after 2 seconds if it's not a form submission
                if (this.tagName !== 'BUTTON') {
                    setTimeout(() => {
                        this.innerHTML = originalContent;
                        this.classList.remove('loading');
                    }, 2000);
                }
            }
        });
    });

    // Mobile-optimized hover effects for stat cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach(card => {
        if (!isMobile) {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        } else {
            // Touch feedback for mobile
            card.addEventListener('touchstart', function() {
                this.style.transform = 'scale(0.98)';
            });
            
            card.addEventListener('touchend', function() {
                this.style.transform = 'scale(1)';
            });
        }
    });

    // Mobile-optimized click animation for complaint items
    const complaintItems = document.querySelectorAll('.complaint-item');
    complaintItems.forEach(item => {
        item.addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    });

    // Mobile-optimized notification for new notices
    const noticeCount = {{ $stats['recent_notices']->count() }};
    if (noticeCount > 0) {
        setTimeout(() => {
            const notification = document.createElement('div');
            notification.className = `fixed ${isMobile ? 'top-2 left-2 right-2' : 'top-4 right-4'} bg-purple-600 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg shadow-lg z-50 animate-bounce`;
            notification.innerHTML = `
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-bell mr-2"></i>
                        <span class="text-sm sm:text-base">You have ${noticeCount} new notice${noticeCount > 1 ? 's' : ''}!</span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-3 text-white hover:text-gray-200 p-1">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            document.body.appendChild(notification);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }, 2000);
    }

    // Handle orientation change on mobile
    window.addEventListener('orientationchange', function() {
        setTimeout(() => {
            window.location.reload();
        }, 500);
    });
});