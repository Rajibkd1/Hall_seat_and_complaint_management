document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createNoticeForm');
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');
    const titleCount = document.getElementById('titleCount');
    const descCount = document.getElementById('descCount');
    const submitBtn = document.getElementById('submitBtn');
    
    // Progress indicators
    const titleProgress = document.getElementById('titleProgress');
    const descProgress = document.getElementById('descProgress');
    const overallProgress = document.getElementById('overallProgress');
    const progressBar = document.getElementById('progressBar');
    
    // Character counting and progress tracking
    function updateProgress() {
        const title = titleInput.value.trim();
        const description = descriptionInput.value.trim();
        
        titleCount.textContent = titleInput.value.length;
        descCount.textContent = descriptionInput.value.length;
        
        // Update progress indicators
        titleProgress.className = title ? 'w-4 h-4 rounded-full bg-green-500' : 'w-4 h-4 rounded-full bg-gray-200';
        descProgress.className = description ? 'w-4 h-4 rounded-full bg-green-500' : 'w-4 h-4 rounded-full bg-gray-200';
        
        // Calculate overall progress
        let completedFields = 2; // date and status are pre-filled
        if (title) completedFields++;
        if (description) completedFields++;
        
        const percentage = (completedFields / 4) * 100;
        overallProgress.textContent = `${percentage}%`;
        progressBar.style.width = `${percentage}%`;
        
        // Enable/disable submit button
        submitBtn.disabled = !title || !description;
        if (submitBtn.disabled) {
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        } else {
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    }
    
    titleInput.addEventListener('input', updateProgress);
    descriptionInput.addEventListener('input', updateProgress);
    
    // Initial progress update
    updateProgress();
    
    // Auto-resize textarea
    descriptionInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });
    
    // Form validation
    form.addEventListener('submit', function(e) {
        const title = titleInput.value.trim();
        const description = descriptionInput.value.trim();
        
        if (!title || !description) {
            e.preventDefault();
            showToast('Please fill in all required fields', 'error');
            return;
        }
        
        // Add loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Creating...
        `;
    });
    
    // Input focus effects
    const inputs = document.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.classList.add('input-focus');
        });
        
        input.addEventListener('blur', function() {
            this.classList.remove('input-focus');
        });
    });
    
    // Auto-save to localStorage
    function saveToLocalStorage() {
        const formData = {
            title: titleInput.value,
            description: descriptionInput.value,
            date_posted: document.getElementById('date_posted').value,
            status: document.getElementById('status').value
        };
        localStorage.setItem('notice_draft', JSON.stringify(formData));
    }
    
    // Load from localStorage
    function loadFromLocalStorage() {
        const saved = localStorage.getItem('notice_draft');
        if (saved) {
            const data = JSON.parse(saved);
            titleInput.value = data.title || '';
            descriptionInput.value = data.description || '';
            document.getElementById('date_posted').value = data.date_posted || '';
            document.getElementById('status').value = data.status || 'active';
            updateProgress();
        }
    }
    
    // Auto-save on input
    form.addEventListener('input', saveToLocalStorage);
    
    // Load draft on page load
    loadFromLocalStorage();
});

// Preview functionality
function previewNotice() {
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;
    const datePosted = document.getElementById('date_posted').value;
    const status = document.getElementById('status').value;
    
    if (!title || !description) {
        showToast('Please fill in the title and description first', 'warning');
        return;
    }
    
    document.getElementById('previewTitle').textContent = title;
    document.getElementById('previewDate').textContent = new Date(datePosted).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    document.getElementById('previewDescription').textContent = description;
    
    const statusBadge = status === 'active' 
        ? '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800"><div class="w-2 h-2 bg-green-500 rounded-full mr-1"></div>Active</span>'
        : '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800"><div class="w-2 h-2 bg-gray-500 rounded-full mr-1"></div>Inactive</span>';
    
    document.getElementById('previewStatus').innerHTML = statusBadge;
    
    const modal = document.getElementById('previewModal');
    const content = document.getElementById('previewContent');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        content.classList.add('modal-enter');
    }, 10);
}

function closePreview() {
    const modal = document.getElementById('previewModal');
    const content = document.getElementById('previewContent');
    
    content.classList.remove('modal-enter');
    content.classList.add('modal-exit');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        content.classList.remove('modal-exit');
    }, 300);
}

// Clear form
function clearForm() {
    if (confirm('Are you sure you want to clear the form? All data will be lost.')) {
        document.getElementById('createNoticeForm').reset();
        document.getElementById('date_posted').value = new Date().toISOString().split('T')[0];
        document.getElementById('titleCount').textContent = '0';
        document.getElementById('descCount').textContent = '0';
        localStorage.removeItem('notice_draft');
        showToast('Form has been cleared', 'info');
        
        // Reset progress
        document.getElementById('titleProgress').className = 'w-4 h-4 rounded-full bg-gray-200';
        document.getElementById('descProgress').className = 'w-4 h-4 rounded-full bg-gray-200';
        document.getElementById('overallProgress').textContent = '50%';
        document.getElementById('progressBar').style.width = '50%';
    }
}

// Save as draft
function saveAsDraft() {
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;
    
    if (!title && !description) {
        showToast('Nothing to save as draft', 'warning');
        return;
    }
    
    // Save to localStorage
    const formData = {
        title: title,
        description: description,
        date_posted: document.getElementById('date_posted').value,
        status: 'inactive' // Save drafts as inactive
    };
    localStorage.setItem('notice_draft', JSON.stringify(formData));
    
    showToast('Draft saved successfully', 'success');
}

// Toast notification function
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    const bgColor = type === 'error' ? 'bg-red-500' : type === 'warning' ? 'bg-yellow-500' : type === 'info' ? 'bg-blue-500' : 'bg-green-500';
    
    toast.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);
    
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}

// Close modal when clicking outside
document.getElementById('previewModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePreview();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePreview();
    }
});