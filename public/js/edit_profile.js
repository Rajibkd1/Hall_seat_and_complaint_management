class EditProfileManager {
    constructor() {
        this.departments = [
            "Computer Science and Telecommunication Engineering (CSTE)",
            "Applied Chemistry and Chemical Engineering (ACCE)",
            "Information and Communication Engineering (ICE)",
            "Electrical and Electronics Engineering (EEE)",
            "Software Engineering (Institute of Information Technology)",
            "Applied Mathematics",
            "Statistics",
            "Oceanography",
            "Chemistry",
            "Physics",
            "Environmental Science and Disaster Management (ESDM)",
            "Fisheries and Marine Science (FIMS)",
            "Pharmacy",
            "Microbiology",
            "Biochemistry and Molecular Biology (BMB)",
            "Food Technology and Nutrition Science (FTNS)",
            "Biotechnology and Genetic Engineering (BGE)",
            "Agriculture",
            "Soil, Water & Environmental Sciences (SWES)",
            "Zoology",
            "English",
            "Economics",
            "Political Science",
            "Bangla",
            "Sociology",
            "Social Work",
            "Business Administration (DBA)",
            "Tourism and Hospitality Management (THM)",
            "Management Information Systems (MIS)",
            "Education",
            "Educational Administration",
            "Law",
            "Information Sciences and Library Management (ISLM)"
        ];
        
        this.initializeElements();
        this.bindEvents();
        this.setupImageUploads();
    }

    initializeElements() {
        // Form elements
        this.form = document.getElementById('editProfileForm');
        this.saveBtn = document.getElementById('saveBtn');
        
        // Input fields
        this.fields = {
            name: document.getElementById('name'),
            university_id: document.getElementById('university_id'),
            email: document.getElementById('email'),
            phone: document.getElementById('phone'),
            department: document.getElementById('department'),
            session_year: document.getElementById('session_year')
        };
        
        // Image elements
        this.profileImg = document.getElementById('profileImg');
        this.profileImgContainer = document.getElementById('profileImgContainer');
        this.profileOverlay = document.getElementById('profileOverlay');
        this.profileImageUpload = document.getElementById('profileImageUpload');
        
        // Department dropdown
        this.departmentDropdown = document.getElementById('department-dropdown');
        
        // ID card uploads
        this.idCardUploads = document.querySelectorAll('.id-card-upload');
    }

    bindEvents() {
        // Form submission
        if (this.form) {
            this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        }
        
        // Profile image events
        if (this.profileImgContainer) {
            this.profileImgContainer.addEventListener('click', () => {
                this.profileImageUpload.click();
            });
        }
        
        if (this.profileImageUpload) {
            this.profileImageUpload.addEventListener('change', (e) => this.handleProfileImageChange(e));
        }
        
        // Department dropdown events
        if (this.fields.department) {
            this.fields.department.addEventListener('input', () => this.filterDepartments());
            this.fields.department.addEventListener('focus', () => this.showDepartments());
            this.fields.department.addEventListener('blur', () => {
                setTimeout(() => this.hideDepartments(), 200);
            });
        }
        
        // Form validation
        Object.values(this.fields).forEach(field => {
            if (field && field.id !== 'email') {
                field.addEventListener('input', () => this.validateField(field));
                field.addEventListener('blur', () => this.validateField(field));
            }
        });

        // Prevent form submission on Enter key in department field
        if (this.fields.department) {
            this.fields.department.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const visibleItems = this.departmentDropdown.querySelectorAll('.department-item');
                    if (visibleItems.length > 0) {
                        visibleItems[0].click();
                    }
                }
            });
        }
    }

    setupImageUploads() {
        this.idCardUploads.forEach(upload => {
            const input = upload.querySelector('input[type="file"]');
            const type = upload.dataset.type;
            
            // Click to upload
            upload.addEventListener('click', () => {
                input.click();
            });
            
            // File change handler
            input.addEventListener('change', (e) => this.handleIdCardChange(e, type));
            
            // Drag and drop
            upload.addEventListener('dragover', (e) => {
                e.preventDefault();
                upload.classList.add('dragover');
            });
            
            upload.addEventListener('dragleave', () => {
                upload.classList.remove('dragover');
            });
            
            upload.addEventListener('drop', (e) => {
                e.preventDefault();
                upload.classList.remove('dragover');
                
                if (e.dataTransfer.files.length > 0) {
                    input.files = e.dataTransfer.files;
                    this.handleIdCardChange({ target: input }, type);
                }
            });
        });
    }

    async handleSubmit(e) {
        e.preventDefault();
        
        // Validate form
        if (!this.validateForm()) {
            this.showNotification('Validation Error', 'Please correct the errors before saving', 'error');
            return;
        }
        
        // Show loading state
        this.saveBtn.classList.add('loading');
        this.saveBtn.disabled = true;
        const originalHTML = this.saveBtn.innerHTML;
        this.saveBtn.innerHTML = '<svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Saving...';
        
        try {
            const formData = new FormData(this.form);
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                             document.querySelector('input[name="_token"]')?.value;
            
            const response = await fetch(this.form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    ...(csrfToken && { 'X-CSRF-TOKEN': csrfToken })
                }
            });
            
            const contentType = response.headers.get('content-type');
            
            if (response.ok) {
                if (contentType && contentType.includes('application/json')) {
                    const result = await response.json();
                    if (result.success) {
                        this.showNotification('Success', 'Profile updated successfully!', 'success');
                        // Redirect to profile page after a short delay
                        setTimeout(() => {
                            window.location.href = '/student/profile';
                        }, 1500);
                    } else {
                        this.handleValidationErrors(result.errors || {});
                        this.showNotification('Update Failed', result.message || 'Failed to update profile', 'error');
                    }
                } else {
                    // Handle HTML response (likely a redirect)
                    this.showNotification('Success', 'Profile updated successfully!', 'success');
                    setTimeout(() => {
                        window.location.href = '/student/profile';
                    }, 1500);
                }
            } else {
                if (contentType && contentType.includes('application/json')) {
                    const result = await response.json();
                    if (result.errors) {
                        this.handleValidationErrors(result.errors);
                        this.showNotification('Validation Error', 'Please correct the errors and try again', 'error');
                    } else {
                        this.showNotification('Update Failed', result.message || 'Failed to update profile', 'error');
                    }
                } else {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
            }
        } catch (error) {
            console.error('Profile update error:', error);
            this.showNotification('Network Error', 'Unable to save changes. Please check your connection and try again.', 'error');
        } finally {
            this.saveBtn.classList.remove('loading');
            this.saveBtn.disabled = false;
            this.saveBtn.innerHTML = originalHTML;
        }
    }

    handleValidationErrors(errors) {
        // Clear existing errors
        document.querySelectorAll('.error-message').forEach(el => el.remove());
        document.querySelectorAll('.border-red-500').forEach(el => {
            el.classList.remove('border-red-500');
        });

        // Display new errors
        Object.keys(errors).forEach(fieldName => {
            const field = this.fields[fieldName];
            if (field) {
                field.classList.add('border-red-500');
                const errorElement = document.createElement('span');
                errorElement.className = 'error-message text-red-600 text-sm mt-1 block';
                errorElement.textContent = errors[fieldName][0];
                field.parentNode.appendChild(errorElement);
            }
        });
    }

    handleProfileImageChange(e) {
        const file = e.target.files[0];
        if (file) {
            if (this.validateImageFile(file)) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.profileImg.src = e.target.result;
                    this.showNotification('Image Selected', 'Profile image updated. Save to apply changes.', 'info');
                };
                reader.readAsDataURL(file);
            }
        }
    }

    handleIdCardChange(e, type) {
        const file = e.target.files[0];
        const upload = document.querySelector(`.id-card-upload[data-type="${type}"]`);
        
        if (file && this.validateImageFile(file)) {
            const reader = new FileReader();
            reader.onload = (e) => {
                // Replace placeholder with image
                upload.innerHTML = `<img src="${e.target.result}" alt="ID Card ${type}" class="id-card-preview">`;
                this.showNotification('ID Card Updated', `${type} side of ID card selected. Save to apply changes.`, 'info');
            };
            reader.readAsDataURL(file);
        }
    }

    validateImageFile(file) {
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        const maxSize = 2 * 1024 * 1024; // 2MB
        
        if (!allowedTypes.includes(file.type)) {
            this.showNotification('Invalid File Type', 'Please select a valid image file (JPG, PNG, GIF)', 'error');
            return false;
        }
        
        if (file.size > maxSize) {
            this.showNotification('File Too Large', 'Image size must be less than 2MB', 'error');
            return false;
        }
        
        return true;
    }

    validateField(field) {
        const value = field.value.trim();
        let isValid = true;
        let errorMessage = '';
        
        // Remove existing error states
        field.classList.remove('border-red-500');
        const existingError = field.parentNode.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }
        
        // Validate based on field type
        switch (field.id) {
            case 'name':
                if (!value) {
                    isValid = false;
                    errorMessage = 'Name is required';
                } else if (value.length < 2) {
                    isValid = false;
                    errorMessage = 'Name must be at least 2 characters';
                }
                break;
                
            case 'university_id':
                if (!value) {
                    isValid = false;
                    errorMessage = 'University ID is required';
                }
                break;
                
            case 'phone':
                const phoneRegex = /^[\+]?[0-9\-\(\)\s]+$/;
                if (!value) {
                    isValid = false;
                    errorMessage = 'Phone number is required';
                } else if (!phoneRegex.test(value)) {
                    isValid = false;
                    errorMessage = 'Please enter a valid phone number';
                }
                break;
                
            case 'department':
                if (!value) {
                    isValid = false;
                    errorMessage = 'Department is required';
                }
                break;
                
            case 'session_year':
                if (!value) {
                    isValid = false;
                    errorMessage = 'Session year is required';
                }
                break;
        }
        
        // Apply validation state
        if (!isValid) {
            field.classList.add('border-red-500');
            const errorElement = document.createElement('span');
            errorElement.className = 'error-message text-red-600 text-sm mt-1 block';
            errorElement.textContent = errorMessage;
            field.parentNode.appendChild(errorElement);
        }
        
        return isValid;
    }

    validateForm() {
        let isValid = true;
        
        Object.values(this.fields).forEach(field => {
            if (field && field.id !== 'email' && !this.validateField(field)) {
                isValid = false;
            }
        });
        
        return isValid;
    }

    // Department dropdown methods
    filterDepartments() {
        const input = this.fields.department;
        const filter = input.value.toLowerCase();
        
        if (filter.length === 0) {
            this.hideDepartments();
            return;
        }
        
        const filtered = this.departments.filter(dept =>
            dept.toLowerCase().includes(filter)
        );
        
        this.displayDepartments(filtered);
    }

    showDepartments() {
        const input = this.fields.department;
        if (input.value.length === 0) {
            this.displayDepartments(this.departments);
        }
    }

    hideDepartments() {
        if (this.departmentDropdown) {
            this.departmentDropdown.classList.remove('show');
        }
    }

    displayDepartments(departments) {
        if (!this.departmentDropdown || departments.length === 0) {
            this.hideDepartments();
            return;
        }
        
        this.departmentDropdown.innerHTML = departments.map(dept =>
            `<div class="department-item" data-value="${dept}">${dept}</div>`
        ).join('');
        
        // Add click handlers
        this.departmentDropdown.querySelectorAll('.department-item').forEach(item => {
            item.addEventListener('click', () => {
                this.fields.department.value = item.dataset.value;
                this.hideDepartments();
                this.validateField(this.fields.department);
            });
        });
        
        this.departmentDropdown.classList.add('show');
    }

    showNotification(title, message, type = 'info') {
        // Create notification container if it doesn't exist
        let notificationContainer = document.getElementById('notificationContainer');
        if (!notificationContainer) {
            notificationContainer = document.createElement('div');
            notificationContainer.id = 'notificationContainer';
            notificationContainer.className = 'fixed top-4 right-4 z-50 space-y-2';
            document.body.appendChild(notificationContainer);
        }

        const notification = document.createElement('div');
        notification.className = `notification ${type} bg-white rounded-lg shadow-lg border p-4 max-w-sm transform transition-all duration-300 translate-x-full opacity-0`;
        
        const icons = {
            success: `<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>`,
            error: `<svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>`,
            warning: `<svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                      </svg>`,
            info: `<svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                   </svg>`
        };
        
        notification.innerHTML = `
            <div class="flex items-start">
                ${icons[type]}
                <div class="ml-3 flex-1">
                    <div class="text-sm font-medium text-gray-900">${title}</div>
                    <div class="text-sm text-gray-600 mt-1">${message}</div>
                </div>
                <button class="ml-4 text-gray-400 hover:text-gray-600" onclick="this.parentElement.parentElement.remove()">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;
        
        notificationContainer.appendChild(notification);
        
        // Show notification
        setTimeout(() => {
            notification.classList.remove('translate-x-full', 'opacity-0');
        }, 100);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 300);
        }, 5000);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new EditProfileManager();
});
