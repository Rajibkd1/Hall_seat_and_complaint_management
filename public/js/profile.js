        // Profile Management JavaScript with Laravel integration
        class ProfileManager {
            constructor() {
                this.isEditing = false;
                this.originalValues = {};
                this.initializeElements();
                this.bindEvents();
            }

            initializeElements() {
                this.editBtn = document.getElementById('editBtn');
                this.saveBtn = document.getElementById('saveBtn');
                this.cancelBtn = document.getElementById('cancelBtn');
                this.imageUpload = document.getElementById('imageUpload');
                this.profileImg = document.getElementById('profileImg');
                this.form = document.getElementById('profileForm');
                
                this.fields = {
                    studentName: document.getElementById('studentName'),
                    universityId: document.getElementById('universityId'),
                    department: document.getElementById('department'),
                    sessionYear: document.getElementById('sessionYear'),
                    contactNumber: document.getElementById('contactNumber'),
                };
            }

            bindEvents() {
                this.editBtn.addEventListener('click', () => this.toggleEditMode());
                this.saveBtn.addEventListener('click', () => this.saveProfile());
                this.cancelBtn.addEventListener('click', () => this.cancelEdit());
                this.profileImg.addEventListener('click', () => {
                    if (this.isEditing) this.imageUpload.click();
                });
                this.imageUpload.addEventListener('change', (e) => this.handleImageUpload(e));

                // Add smooth focus transitions
                Object.values(this.fields).forEach(field => {
                    field.addEventListener('focus', (e) => {
                        e.target.parentElement.classList.add('transform', 'scale-105');
                    });
                    field.addEventListener('blur', (e) => {
                        e.target.parentElement.classList.remove('transform', 'scale-105');
                    });
                });
            }

            toggleEditMode() {
                this.isEditing = !this.isEditing;
                
                if (this.isEditing) {
                    this.enterEditMode();
                } else {
                    this.exitEditMode();
                }
            }

            enterEditMode() {
                // Store original values
                Object.keys(this.fields).forEach(key => {
                    this.originalValues[key] = this.fields[key].value;
                });

                // Enable fields
                Object.values(this.fields).forEach(field => {
                    field.removeAttribute('readonly');
                    field.removeAttribute('disabled');
                    field.classList.remove('bg-gray-50');
                    field.classList.add('bg-white', 'animate-pulse-glow');
                });

                // Update buttons
                this.editBtn.innerHTML = `
                    <svg class="w-5 h-5 inline-block mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Editing Mode
                `;
                this.editBtn.classList.add('bg-yellow-500', 'hover:bg-yellow-600');
                this.editBtn.classList.remove('bg-gradient-to-r', 'from-blue-600', 'to-purple-600');
                this.saveBtn.style.display = 'inline-block';
                this.cancelBtn.style.display = 'inline-block';

                this.showNotification('Edit mode enabled - Make your changes', 'info');
            }

            exitEditMode() {
                // Disable fields
                Object.values(this.fields).forEach(field => {
                    field.setAttribute('readonly', '');
                    if (field.tagName === 'SELECT') {
                        field.setAttribute('disabled', '');
                    }
                    field.classList.add('bg-gray-50');
                    field.classList.remove('bg-white', 'animate-pulse-glow');
                });

                // Update buttons
                this.editBtn.innerHTML = `
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Profile
                `;
                this.editBtn.classList.remove('bg-yellow-500', 'hover:bg-yellow-600');
                this.editBtn.classList.add('bg-gradient-to-r', 'from-blue-600', 'to-purple-600');
                this.saveBtn.style.display = 'none';
                this.cancelBtn.style.display = 'none';
            }

            async saveProfile() {
                // Show loading state
                this.saveBtn.innerHTML = `
                    <svg class="w-5 h-5 inline-block mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Saving...
                `;
                this.saveBtn.disabled = true;
                
                this.showNotification('Saving profile changes...', 'info');

                try {
                    const formData = new FormData(this.form);
                    console.log('Sending form data:', Array.from(formData.entries()));

                    const response = await fetch('/student/profile', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: formData
                    });

                    if (!response.ok) {
                        console.error('HTTP Status:', response.status);
                        const errorText = await response.text();
                        console.error('Server error response:', errorText);

                        if (response.status === 422) { // Validation error
                            try {
                                const errorResult = JSON.parse(errorText);
                                let errorMessage = 'Validation failed:';
                                if (errorResult.errors) {
                                    Object.values(errorResult.errors).flat().forEach(err => {
                                        errorMessage += '\n- ' + err;
                                    });
                                }
                                this.showNotification(errorMessage, 'error');
                            } catch (e) {
                                this.showNotification('Server returned an invalid JSON response for validation errors.', 'error');
                            }
                            return; // Stop further processing
                        } else {
                            this.showNotification('Server responded with an error: ' + response.status + '. Check console for details.', 'error');
                            throw new Error('Server responded with an error: ' + response.status);
                        }
                    }

                    const result = await response.json();

                    if (result.success) {
                        this.isEditing = false;
                        this.exitEditMode();
                        this.showNotification('Profile updated successfully!', 'success');
                        
                        // Update profile image if changed
                        if (result.student.profile_image) {
                            this.profileImg.src = `/storage/${result.student.profile_image}`;
                        }
                    } else {
                        let errorMessage = 'Error updating profile: ' + (result.message || 'Unknown error');
                        if (result.errors) {
                            errorMessage += '\n' + Object.values(result.errors).flat().join('\n');
                        }
                        this.showNotification(errorMessage, 'error');
                        console.error('Validation errors:', result.errors);
                    }
                } catch (error) {
                    this.showNotification('Network error occurred while saving', 'error');
                    console.error('Save error:', error);
                } finally {
                    this.saveBtn.innerHTML = `
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Save Changes
                    `;
                    this.saveBtn.disabled = false;
                }
            }

            cancelEdit() {
                // Restore original values
                Object.keys(this.originalValues).forEach(key => {
                    this.fields[key].value = this.originalValues[key];
                });

                this.isEditing = false;
                this.exitEditMode();
                this.showNotification('Changes cancelled - Original data restored', 'warning');
            }

            handleImageUpload(event) {
                const file = event.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.profileImg.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            this.profileImg.src = e.target.result;
                            this.profileImg.style.transform = 'scale(1)';
                            this.showNotification('Profile image selected - Save to apply changes', 'info');
                        }, 200);
                    };
                    reader.readAsDataURL(file);
                } else {
                    this.showNotification('Please select a valid image file', 'error');
                }
            }

            showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                const colors = {
                    success: 'bg-green-500 border-green-400',
                    error: 'bg-red-500 border-red-400',
                    warning: 'bg-yellow-500 border-yellow-400',
                    info: 'bg-blue-500 border-blue-400'
                };

                const icons = {
                    success: '✓',
                    error: '✕',
                    warning: '⚠',
                    info: 'ℹ'
                };

                notification.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-4 rounded-lg shadow-lg z-50 transform translate-x-full transition-all duration-300 border-l-4 max-w-sm`;
                notification.innerHTML = `
                    <div class="flex items-center">
                        <span class="text-xl mr-3">${icons[type]}</span>
                        <span class="font-medium">${message}</span>
                    </div>
                `;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.classList.remove('translate-x-full');
                }, 100);

                setTimeout(() => {
                    notification.classList.add('translate-x-full');
                    setTimeout(() => {
                        if (document.body.contains(notification)) {
                            document.body.removeChild(notification);
                        }
                    }, 300);
                }, 4000);
            }
        }

        // Initialize profile manager when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new ProfileManager();
        });

        // Add interactive hover effects
        document.querySelectorAll('.group').forEach(group => {
            group.addEventListener('mouseenter', () => {
                group.classList.add('transform', 'scale-102');
            });
            group.addEventListener('mouseleave', () => {
                group.classList.remove('transform', 'scale-102');
            });
        });