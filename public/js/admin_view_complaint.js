document.addEventListener('DOMContentLoaded', function() {
    const statusForm = document.getElementById('statusForm');
    const statusSelect = document.getElementById('status');
    const commentTextarea = document.getElementById('admin_comment');
    
    // Add form validation
    statusForm.addEventListener('submit', function(e) {
        const submitButton = this.querySelector('button[type="submit"]');
        
        // Add loading state
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Updating...
        `;
        
        // Reset button after 3 seconds (in case of error)
        setTimeout(() => {
            submitButton.disabled = false;
            submitButton.innerHTML = `
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                </svg>
                Update Status
            `;
        }, 3000);
    });
    
    // Auto-resize textarea
    commentTextarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });
    
    // Status change animation
    statusSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const statusIndicator = document.querySelector('.status-indicator');
        
        if (statusIndicator) {
            statusIndicator.style.transform = 'scale(1.05)';
            setTimeout(() => {
                statusIndicator.style.transform = 'scale(1)';
            }, 200);
        }
    });
    
    // Add click-to-copy functionality for complaint ID
    const complaintId = document.querySelector('[data-complaint-id]');
    if (complaintId) {
        complaintId.addEventListener('click', function() {
            const textToCopy = this.textContent;
            
            if (navigator.clipboard) {
                navigator.clipboard.writeText(textToCopy).then(() => {
                    showToast('Complaint ID copied to clipboard!');
                });
            }
        });
    }
    
    // Toast notification function
    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        // Slide in
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);
        
        // Slide out and remove
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }
    
    // Add hover effects to quick action buttons
    const quickActions = document.querySelectorAll('.bg-gray-50');
    quickActions.forEach(action => {
        action.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(4px)';
        });
        
        action.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
});
