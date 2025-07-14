let originalFormData;
let hasChanges = false;

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editNoticeForm');
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');
    const titleCount = document.getElementById('titleCount');
    const descCount = document.getElementById('descCount');
    const submitBtn = document.getElementById('submitBtn');

    originalFormData = new FormData(form);

    // Character counting
    function updateCharCount() {
        titleCount.textContent = titleInput.value.length;
        descCount.textContent = descriptionInput.value.length;
    }

    titleInput.addEventListener('input', updateCharCount);
    descriptionInput.addEventListener('input', updateCharCount);

    // Initial count
    updateCharCount();

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
            Updating...
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

    // Form change detection
    form.addEventListener('input', function() {
        const currentFormData = new FormData(form);
        hasChanges = false;

        for (let [key, value] of currentFormData.entries()) {
            if (originalFormData.get(key) !== value) {
                hasChanges = true;
                break;
            }
        }

        // Update submit button state
        if (hasChanges) {
            submitBtn.classList.remove('opacity-50');
            submitBtn.disabled = false;
        } else {
            submitBtn.classList.add('opacity-50');
            submitBtn.disabled = true;
        }
    });
});

// Unsaved Changes Modal functions
function showUnsavedChangesModal(redirectUrl) {
    const modal = document.getElementById('unsavedChangesModal');
    const modalContent = document.getElementById('unsavedContent');
    const leavePageLink = document.getElementById('leavePageLink');

    leavePageLink.href = redirectUrl; // Set the redirect URL for the "Leave page" button
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modalContent.classList.add('modal-enter');
    }, 10);
}

function closeUnsavedChangesModal() {
    const modal = document.getElementById('unsavedChangesModal');
    const modalContent = document.getElementById('unsavedContent');
    
    modalContent.classList.remove('modal-enter');
    modalContent.classList.add('modal-exit');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modalContent.classList.remove('modal-exit');
    }, 300);
}

// Handle Cancel button click
function handleCancel() {
    if (hasChanges) {
        showUnsavedChangesModal('{{ route('admin.notices') }}');
    } else {
        window.location.href = '{{ route('admin.notices') }}';
    }
}

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

// Reset form
function resetForm() {
    if (confirm('Are you sure you want to reset the form? All changes will be lost.')) {
        document.getElementById('editNoticeForm').reset();
        document.getElementById('titleCount').textContent = '0';
        document.getElementById('descCount').textContent = '0';
        showToast('Form has been reset', 'info');
    }
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