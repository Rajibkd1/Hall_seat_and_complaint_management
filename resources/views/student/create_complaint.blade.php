@extends('layouts.app')

@section('content')
<body class="min-h-screen font-inter relative overflow-x-hidden bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100">
    
    <!-- Subtle Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape w-64 h-64 bg-gradient-to-br from-blue-200 to-indigo-300 rounded-full"></div>
        <div class="shape w-48 h-48 bg-gradient-to-br from-slate-200 to-blue-300 rounded-full"></div>
        <div class="shape w-32 h-32 bg-gradient-to-br from-indigo-200 to-purple-300 rounded-full"></div>
    </div>
    <!-- Navigation Tabs -->
    <div class="flex justify-center py-8">
        <div class="bg-white/90 backdrop-blur-lg rounded-2xl p-2 shadow-lg">
            <div class="flex space-x-2">
                <a href="{{ route('student.complaint_list') }}" 
                   class="px-6 py-3 text-gray-600 hover:bg-gray-100 rounded-xl font-semibold transition-all duration-300">
                    All Complaints
                </a>
                <a href="{{ route('student.track_complaint') }}" 
                   class="px-6 py-3 text-gray-600 hover:bg-gray-100 rounded-xl font-semibold transition-all duration-300">
                    Track Complaint
                </a>
                <a href="{{ route('student.create_complaint') }}" 
                   class="px-6 py-3 bg-red-600 text-white rounded-xl font-semibold transition-all duration-300">
                    Create New
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        
        <!-- Complaint Form -->
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-xl border border-gray-200/50 overflow-hidden animate-fade-in">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <h2 class="text-2xl font-bold text-white mb-2">Submit Your Complaint</h2>
                <p class="text-blue-100">Please provide detailed information about your concern</p>
            </div>
            
            <!-- Form Content -->
            <div class="p-8">
                <form id="complaintForm" class="space-y-6">
                    @csrf
                    
                    <!-- Complaint Details Section -->
                    <div class="animate-form-appear" style="animation-delay: 0.1s;">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            Complaint Details
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Category *</label>
                                <select id="category" name="category" required
                                        class="w-full px-4 py-3 bg-white/70 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:bg-white transition-all duration-300 text-gray-800 input-focus appearance-none">
                                    <option value="">Select a category</option>
                                    <option value="electrical">Electrical Issues</option>
                                    <option value="water">Water/Plumbing</option>
                                    <option value="roommate">Roommate Issues</option>
                                    <option value="medical">Medical Emergency</option>
                                    <option value="harassment">Harassment/Bullying</option>
                                    <option value="safety">Safety Concerns</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Emergency Flag *</label>
                                <div class="flex space-x-4">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="emergency_flag" value="1" class="sr-only">
                                        <div class="emergency-selector w-24 h-10 bg-red-500 rounded-lg flex items-center justify-center text-white font-medium text-sm transition-all duration-300 opacity-50 hover:opacity-100">
                                            Emergency
                                        </div>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="emergency_flag" value="0" class="sr-only" checked>
                                        <div class="emergency-selector w-24 h-10 bg-green-500 rounded-lg flex items-center justify-center text-white font-medium text-sm transition-all duration-300 opacity-100">
                                            Normal
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Description *</label>
                            <textarea id="description" name="description" required rows="6"
                                      class="w-full px-4 py-3 bg-white/70 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:bg-white transition-all duration-300 text-gray-800 input-focus resize-none"
                                      placeholder="Please provide a detailed description of your complaint, including dates, times, and any relevant information..."></textarea>
                            <div class="text-right text-sm text-gray-500 mt-1">
                                <span id="charCount">0</span>/1000 characters
                            </div>
                        </div>
                    </div>

                    <!-- File Upload Section -->
                    <div class="animate-form-appear" style="animation-delay: 0.2s;">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                            </svg>
                            Supporting Image (Optional)
                        </h3>
                        
                        <div class="file-drop-zone rounded-xl p-8 text-center cursor-pointer transition-all duration-300" id="fileDropZone">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="text-gray-600 mb-2">Drop image here or click to browse</p>
                            <p class="text-sm text-gray-500">Supported formats: JPG, PNG (Max 5MB)</p>
                            <input type="file" id="fileInput" name="image" accept=".jpg,.jpeg,.png" class="hidden">
                        </div>
                        
                        <div id="fileList" class="mt-4 space-y-2"></div>
                    </div>

                    <!-- Submit Button -->
                    <div class="animate-form-appear" style="animation-delay: 0.4s;">
                        <button type="submit" id="submitBtn" 
                                class="w-full px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 font-semibold text-lg flex items-center justify-center space-x-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            <span>Submit Complaint</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-6 border border-gray-200/50 text-center hover:shadow-lg transition-all duration-300 animate-bounce-in" style="animation-delay: 0.5s;">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Track Status</h3>
                <p class="text-sm text-gray-600">Check the progress of your submitted complaints</p>
            </div>
            
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-6 border border-gray-200/50 text-center hover:shadow-lg transition-all duration-300 animate-bounce-in" style="animation-delay: 0.6s;">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Get Help</h3>
                <p class="text-sm text-gray-600">Need assistance? Contact our support team</p>
            </div>
            
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-6 border border-gray-200/50 text-center hover:shadow-lg transition-all duration-300 animate-bounce-in" style="animation-delay: 0.7s;">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Guidelines</h3>
                <p class="text-sm text-gray-600">Read complaint submission guidelines and policies</p>
            </div>
        </div>
    </main>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white/95 backdrop-blur-lg rounded-3xl max-w-md w-full border border-gray-200 shadow-2xl animate-bounce-in">
            <div class="p-8 text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Complaint Submitted Successfully!</h3>
                <p class="text-gray-600 mb-4">Your complaint has been received and assigned tracking ID: <span id="trackingId" class="font-mono font-bold text-blue-600">#CM-2025-001</span></p>
                <p class="text-sm text-gray-500 mb-6">You will receive updates via email. Expected response time: 2-3 business days.</p>
                <div class="flex space-x-3">
                    <button id="closeSuccessModal" class="flex-1 px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-300 font-semibold">
                        Close
                    </button>
                    <a href="{{ route('student.complaint_list') }}" class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300 font-semibold text-center">
                        View All
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

@push('head-scripts')
    <link rel="stylesheet" href="{{ asset('css/create_complaint.css') }}">
@endpush

<script>
    class StudentComplaintSystem {
        constructor() {
            this.initializeElements();
            this.bindEvents();
            this.setupFormValidation();
            this.setupFileUpload();
        }

        initializeElements() {
            this.form = document.getElementById('complaintForm');
            this.submitBtn = document.getElementById('submitBtn');
            this.successModal = document.getElementById('successModal');
            this.closeSuccessModal = document.getElementById('closeSuccessModal');
            this.fileDropZone = document.getElementById('fileDropZone');
            this.fileInput = document.getElementById('fileInput');
            this.fileList = document.getElementById('fileList');
            this.charCount = document.getElementById('charCount');
            this.description = document.getElementById('description');
            this.emergencySelectors = document.querySelectorAll('.emergency-selector');
            this.uploadedFile = null;
        }

        bindEvents() {
            this.form.addEventListener('submit', (e) => this.handleSubmit(e));
            this.closeSuccessModal.addEventListener('click', () => this.closeModal());
            this.description.addEventListener('input', () => this.updateCharCount());
            
            // Emergency flag selection
            this.emergencySelectors.forEach(selector => {
                selector.addEventListener('click', (e) => {
                    this.selectEmergencyFlag(e.target.closest('.emergency-selector'));
                });
            });

            // Input focus effects
            document.querySelectorAll('.input-focus').forEach(input => {
                input.addEventListener('focus', (e) => {
                    e.target.parentElement.classList.add('transform', 'scale-105');
                });
                input.addEventListener('blur', (e) => {
                    e.target.parentElement.classList.remove('transform', 'scale-105');
                });
            });
        }

        setupFormValidation() {
            const inputs = this.form.querySelectorAll('input[required], select[required], textarea[required]');
            inputs.forEach(input => {
                input.addEventListener('blur', () => this.validateField(input));
                input.addEventListener('input', () => this.clearFieldError(input));
            });
        }

        setupFileUpload() {
            this.fileDropZone.addEventListener('click', () => this.fileInput.click());
            this.fileDropZone.addEventListener('dragover', (e) => this.handleDragOver(e));
            this.fileDropZone.addEventListener('dragleave', (e) => this.handleDragLeave(e));
            this.fileDropZone.addEventListener('drop', (e) => this.handleDrop(e));
            this.fileInput.addEventListener('change', (e) => this.handleFileSelect(e));
        }

        handleDragOver(e) {
            e.preventDefault();
            this.fileDropZone.classList.add('dragover');
        }

        handleDragLeave(e) {
            e.preventDefault();
            this.fileDropZone.classList.remove('dragover');
        }

        handleDrop(e) {
            e.preventDefault();
            this.fileDropZone.classList.remove('dragover');
            const files = Array.from(e.dataTransfer.files);
            if (files.length > 0) {
                this.processFile(files[0]);
            }
        }

        handleFileSelect(e) {
            const files = Array.from(e.target.files);
            if (files.length > 0) {
                this.processFile(files[0]);
            }
        }

        processFile(file) {
            if (this.validateFile(file)) {
                this.uploadedFile = file;
                this.addFileToList(file);
            }
        }

        validateFile(file) {
            const maxSize = 5 * 1024 * 1024; // 5MB
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            
            if (file.size > maxSize) {
                this.showNotification('File size must be less than 5MB', 'error');
                return false;
            }
            
            if (!allowedTypes.includes(file.type)) {
                this.showNotification('Only JPG and PNG images are allowed', 'error');
                return false;
            }
            
            return true;
        }

        addFileToList(file) {
            this.fileList.innerHTML = '';
            const fileItem = document.createElement('div');
            fileItem.className = 'flex items-center justify-between p-3 bg-blue-50 border border-blue-200 rounded-lg';
            fileItem.innerHTML = `
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-gray-800">${file.name}</p>
                        <p class="text-xs text-gray-500">${this.formatFileSize(file.size)}</p>
                    </div>
                </div>
                <button type="button" class="text-red-500 hover:text-red-700 transition-colors duration-200" onclick="this.removeFile()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            
            // Add remove functionality
            fileItem.querySelector('button').addEventListener('click', () => {
                this.uploadedFile = null;
                this.fileList.innerHTML = '';
                this.fileInput.value = '';
            });
            
            this.fileList.appendChild(fileItem);
        }

        formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        selectEmergencyFlag(selector) {
            this.emergencySelectors.forEach(s => s.classList.remove('opacity-100', 'scale-105'));
            this.emergencySelectors.forEach(s => s.classList.add('opacity-50'));
            selector.classList.remove('opacity-50');
            selector.classList.add('opacity-100', 'scale-105');
            
            const radio = selector.parentElement.querySelector('input[type="radio"]');
            radio.checked = true;
        }

        updateCharCount() {
            const count = this.description.value.length;
            this.charCount.textContent = count;
            
            if (count > 1000) {
                this.charCount.classList.add('text-red-500');
                this.description.classList.add('border-red-500');
            } else {
                this.charCount.classList.remove('text-red-500');
                this.description.classList.remove('border-red-500');
            }
        }

        validateField(field) {
            if (!field.value.trim()) {
                this.showFieldError(field, 'This field is required');
                return false;
            }
            
            return true;
        }

        showFieldError(field, message) {
            field.classList.add('border-red-500');
            let errorDiv = field.parentElement.querySelector('.error-message');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'error-message text-red-500 text-sm mt-1';
                field.parentElement.appendChild(errorDiv);
            }
            errorDiv.textContent = message;
        }

        clearFieldError(field) {
            field.classList.remove('border-red-500');
            const errorDiv = field.parentElement.querySelector('.error-message');
            if (errorDiv) {
                errorDiv.remove();
            }
        }

        async handleSubmit(e) {
            e.preventDefault();
            
            if (!this.validateForm()) {
                this.showNotification('Please fill in all required fields correctly', 'error');
                return;
            }

            // Show loading state
            this.submitBtn.innerHTML = `
                <svg class="w-6 h-6 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                <span>Submitting...</span>
            `;
            this.submitBtn.disabled = true;

            // Prepare form data
            const formData = new FormData(this.form);
            if (this.uploadedFile) {
                formData.append('image', this.uploadedFile);
            }

            try {
                const response = await fetch('{{ route("student.store_complaint") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                });

                const data = await response.json();

                if (data.success) {
                    // Generate tracking ID
                    document.getElementById('trackingId').textContent = `#${data.tracking_id}`;

                    // Show success modal
                    this.successModal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';

                    // Reset form
                    this.form.reset();
                    this.fileList.innerHTML = '';
                    this.uploadedFile = null;
                    this.charCount.textContent = '0';
                    this.emergencySelectors.forEach(s => {
                        s.classList.remove('opacity-100', 'scale-105');
                        s.classList.add('opacity-50');
                    });
                    // Set default emergency flag to normal
                    this.emergencySelectors[1].classList.remove('opacity-50');
                    this.emergencySelectors[1].classList.add('opacity-100');
                } else {
                    this.showNotification(data.message || 'Error submitting complaint', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                this.showNotification('Error submitting complaint', 'error');
            }

            // Reset button
            this.submitBtn.innerHTML = `
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                <span>Submit Complaint</span>
            `;
            this.submitBtn.disabled = false;
        }

        validateForm() {
            const requiredFields = this.form.querySelectorAll('input[required], select[required], textarea[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!this.validateField(field)) {
                    isValid = false;
                }
            });

            // Check if emergency flag is selected
            const emergencySelected = this.form.querySelector('input[name="emergency_flag"]:checked');
            if (!emergencySelected) {
                this.showNotification('Please select emergency flag', 'error');
                isValid = false;
            }

            return isValid;
        }

        closeModal() {
            this.successModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
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

    // Initialize the complaint system when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        new StudentComplaintSystem();
        
        // Add subtle parallax effect to floating shapes
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const shapes = document.querySelectorAll('.shape');
            shapes.forEach((shape, index) => {
                const speed = 0.2 + (index * 0.1);
                shape.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });
    });
</script>
@endsection
