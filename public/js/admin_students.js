document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('studentTable');
    const tbody = table.querySelector('tbody');
    const emptyState = document.getElementById('emptyState');
    const rows = Array.from(tbody.querySelectorAll('.student-row'));
    
    // Search functionality
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        let visibleRows = 0;
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const isVisible = text.includes(searchTerm);
            
            row.style.display = isVisible ? '' : 'none';
            if (isVisible) visibleRows++;
            
            // Remove previous highlights
            row.querySelectorAll('.search-highlight').forEach(el => {
                el.outerHTML = el.innerHTML;
            });
            
            // Add highlight if search term exists
            if (searchTerm && isVisible) {
                highlightText(row, searchTerm);
            }
        });
        
        // Show/hide empty state
        if (visibleRows === 0 && searchTerm) {
            emptyState.classList.remove('hidden');
            tbody.style.display = 'none';
        } else {
            emptyState.classList.add('hidden');
            tbody.style.display = '';
        }
    });
    
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

// Table sorting functionality
let sortDirection = {};

function sortTable(columnIndex) {
    const table = document.getElementById('studentTable');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('.student-row'));
    
    // Toggle sort direction
    sortDirection[columnIndex] = sortDirection[columnIndex] === 'asc' ? 'desc' : 'asc';
    
    rows.sort((a, b) => {
        let aValue = a.cells[columnIndex].textContent.trim();
        let bValue = b.cells[columnIndex].textContent.trim();
        
        // Handle numeric sorting for serial numbers
        if (columnIndex === 0) {
            aValue = parseInt(aValue);
            bValue = parseInt(bValue);
        }
        
        if (sortDirection[columnIndex] === 'asc') {
            return aValue > bValue ? 1 : -1;
        } else {
            return aValue < bValue ? 1 : -1;
        }
    });
    
    // Re-append sorted rows
    rows.forEach(row => tbody.appendChild(row));
    
    // Update visual indicators
    updateSortIndicators(columnIndex);
}

function updateSortIndicators(activeColumn) {
    const headers = document.querySelectorAll('th[onclick]');
    headers.forEach((header, index) => {
        const svg = header.querySelector('svg');
        if (index === activeColumn) {
            svg.classList.remove('text-gray-400');
            svg.classList.add(sortDirection[activeColumn] === 'asc' ? 'text-blue-600' : 'text-blue-600');
        } else {
            svg.classList.remove('text-blue-600');
            svg.classList.add('text-gray-400');
        }
    });
}