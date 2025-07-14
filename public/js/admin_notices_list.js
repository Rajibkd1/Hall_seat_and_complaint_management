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

document.addEventListener('DOMContentLoaded', function() {
    // Check for success message and display toast
    @if(session('success'))
        showToast('{{ session('success') }}', 'success');
    @endif
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const sortBy = document.getElementById('sortBy');
    const table = document.getElementById('noticesTable');
    const tbody = table.querySelector('tbody');
    const emptyState = document.getElementById('emptyState');
    const rows = Array.from(tbody.querySelectorAll('.notice-row'));
    
    // Search functionality
    searchInput.addEventListener('input', function() {
        filterAndSort();
    });
    
    // Status filter functionality
    statusFilter.addEventListener('change', function() {
        filterAndSort();
    });
    
    // Sort functionality
    sortBy.addEventListener('change', function() {
        filterAndSort();
    });
    
    function filterAndSort() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const statusValue = statusFilter.value.toLowerCase();
        const sortValue = sortBy.value;
        
        let filteredRows = rows.filter(row => {
            const text = row.textContent.toLowerCase();
            const status = row.dataset.status.toLowerCase();
            
            const matchesSearch = !searchTerm || text.includes(searchTerm);
            const matchesStatus = !statusValue || status === statusValue;
            
            return matchesSearch && matchesStatus;
        });
        
        // Sort rows
        filteredRows.sort((a, b) => {
            let aValue, bValue;
            
            switch(sortValue) {
                case 'date':
                    aValue = new Date(a.dataset.date);
                    bValue = new Date(b.dataset.date);
                    return bValue - aValue; // Newest first
                case 'title':
                    aValue = a.dataset.title.toLowerCase();
                    bValue = b.dataset.title.toLowerCase();
                    break;
                case 'status':
                    aValue = a.dataset.status;
                    bValue = b.dataset.status;
                    break;
                default:
                    return 0;
            }
            
            return aValue.localeCompare(bValue);
        });
        
        // Hide all rows first
        rows.forEach(row => row.style.display = 'none');
        
        // Show filtered and sorted rows
        filteredRows.forEach(row => {
            row.style.display = '';
            tbody.appendChild(row); // Re-append to maintain order
        });
        
        // Highlight search terms
        if (searchTerm) {
            filteredRows.forEach(row => highlightText(row, searchTerm));
        } else {
            // Remove highlights
            rows.forEach(row => {
                row.querySelectorAll('.search-highlight').forEach(el => {
                    el.outerHTML = el.innerHTML;
                });
            });
        }
        
        // Show/hide empty state
        if (filteredRows.length === 0) {
            emptyState.classList.remove('hidden');
            tbody.style.display = 'none';
        } else {
            emptyState.classList.add('hidden');
            tbody.style.display = '';
        }
        
        // Update serial numbers
        filteredRows.forEach((row, index) => {
            const serialCell = row.querySelector('td:first-child .text-blue-600');
            if (serialCell) {
                serialCell.textContent = index + 1;
            }
        });
    }
    
    // Highlight search terms
    function highlightText(element, searchTerm) {
        const walker = document.createTreeWalker(
            element,
            NodeFilter.SHOW_TEXT,
            null,
            false
        );
        
        const textNodes = [];
        let node;
        
        while (node = walker.nextNode()) {
            textNodes.push(node);
        }
        
        textNodes.forEach(textNode => {
            const text = textNode.textContent;
            const regex = new RegExp(`(${searchTerm})`, 'gi');
            
            if (regex.test(text)) {
                const highlightedText = text.replace(regex, '<span class="search-highlight">$1</span>');
                const wrapper = document.createElement('span');
                wrapper.innerHTML = highlightedText;
                textNode.parentNode.replaceChild(wrapper, textNode);
            }
        });
    }
    
    // Add fade-in animation to rows
    rows.forEach((row, index) => {
        row.style.animationDelay = `${index * 0.05}s`;
        row.classList.add('fade-in');
    });
});

// Delete confirmation modal functions
function confirmDelete(noticeId, noticeTitle) {
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('modalContent');
    const titleSpan = document.getElementById('noticeTitle');
    const deleteForm = document.getElementById('deleteForm');
    
    titleSpan.textContent = noticeTitle;
    deleteForm.action = `/admin/notices/${noticeId}`;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    // Animate modal entrance
    setTimeout(() => {
        modalContent.classList.add('modal-enter');
    }, 10);
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('modalContent');
    
    modalContent.classList.remove('modal-enter');
    modalContent.classList.add('modal-exit');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modalContent.classList.remove('modal-exit');
    }, 300);
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});