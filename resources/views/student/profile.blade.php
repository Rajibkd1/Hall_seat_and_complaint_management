@extends('layouts.app')

@section('content')


@section('content')
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Profile Card -->
        <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl overflow-hidden animate-fade-in">
            <!-- Profile Header -->
            <div class="relative h-48 bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="absolute -bottom-16 left-8 z-10">
                    <div class="relative group">
                        <img id="profileImg" src="{{ $student->profile_image_url }}" 
                             alt="Profile" class="w-32 h-32 rounded-full border-4 border-white shadow-xl object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center cursor-pointer">
                            <span class="text-white text-sm font-medium">Change Photo</span>
                        </div>
                        <input type="file" id="imageUpload" accept="image/*" class="hidden">
                    </div>
                </div>
                <div class="absolute top-4 right-4 flex space-x-2">
                    <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-white text-sm font-medium">Online</span>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="pt-20 pb-8 px-8">
                <form id="profileForm">
                    @csrf
                    
                    <!-- Student Info Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 animate-slide-up">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Student Name -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Student Name</label>
                                <div class="relative">
                                    <input type="text" id="studentName" name="name" value="{{ $student->name }}" readonly
                                           class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:bg-white transition-all duration-300 text-lg font-medium text-gray-800">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- University ID -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-600 mb-2">University ID</label>
                                <div class="relative">
                                    <input type="text" id="universityId" name="university_id" value="{{ $student->university_id }}"
                                           class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:bg-white transition-all duration-300 text-lg font-medium text-gray-800">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Department -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Department</label>
                                <div class="relative">
                                    <select id="department" name="department"
                                            class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:bg-white transition-all duration-300 text-lg font-medium text-gray-800 appearance-none">
                                        <option value="Computer Science & Engineering" {{ $student->department == 'Computer Science & Engineering' ? 'selected' : '' }}>Computer Science & Engineering</option>
                                        <option value="Electrical & Electronic Engineering" {{ $student->department == 'Electrical & Electronic Engineering' ? 'selected' : '' }}>Electrical & Electronic Engineering</option>
                                        <option value="Mechanical Engineering" {{ $student->department == 'Mechanical Engineering' ? 'selected' : '' }}>Mechanical Engineering</option>
                                        <option value="Civil Engineering" {{ $student->department == 'Civil Engineering' ? 'selected' : '' }}>Civil Engineering</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Session Year -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Session Year</label>
                                <div class="relative">
                                    <input type="text" id="sessionYear" name="session_year" value="{{ $student->session_year }}" readonly
                                           class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:bg-white transition-all duration-300 text-lg font-medium text-gray-800">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Number -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Contact Number</label>
                                <div class="relative">
                                    <input type="tel" id="contactNumber" name="phone" value="{{ $student->phone }}" readonly
                                           class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:bg-white transition-all duration-300 text-lg font-medium text-gray-800">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Edit Profile Button -->
                <div class="flex justify-center mt-8">
                    <button id="editBtn" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 font-semibold">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Profile
                    </button>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mt-6 justify-center">
                    <button id="saveBtn" style="display: none;" 
                            class="px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-full hover:from-green-700 hover:to-emerald-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 font-semibold">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Save Changes
                    </button>
                    <button id="cancelBtn" style="display: none;"
                            class="px-8 py-3 bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-full hover:from-gray-700 hover:to-gray-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 font-semibold">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </main>
</body>
@endsection

@push('scripts')
    <script>
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
    </script>
@endpush
@endsection