<div id="dualUploadModal"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden transition-opacity duration-300">
    <div
        class="bg-white rounded-xl shadow-2xl p-6 w-11/12 max-w-2xl transform transition-all duration-300 scale-95 opacity-0">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                    </path>
                </svg>
                <h2 class="text-xl font-bold text-gray-900">Upload University ID Card</h2>
            </div>
            <button id="closeModal" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Upload Form -->
        <form id="uploadForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Front Side Upload -->
                <div class="space-y-3">
                    <label class="block text-sm font-medium text-gray-700">
                        Front Side <span class="text-red-500">*</span>
                    </label>
                    <div class="upload-area" data-type="front">
                        <div class="upload-zone border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors duration-200 relative">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                </path>
                            </svg>
                            <p class="text-sm text-gray-600 mb-2 pointer-events-none">Drop front image here</p>
                            <p class="text-xs text-gray-500 mb-4 pointer-events-none">or click to browse</p>
                            <input type="file" name="id_card_front" accept="image/jpeg,image/png,image/gif"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <button type="button" class="choose-file-btn inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-md hover:bg-blue-700 transition-colors duration-200 pointer-events-none">
                                Choose Front Image
                            </button>
                        </div>
                        <div class="preview-container hidden mt-3">
                            <img class="preview-image w-full h-32 object-contain border border-gray-200 rounded-lg bg-gray-50" alt="Front Preview">
                            <p class="file-name text-xs text-gray-600 mt-1"></p>
                            <button type="button" class="remove-image text-xs text-red-600 hover:text-red-800 mt-1">Remove</button>
                        </div>
                    </div>
                </div>

                <!-- Back Side Upload -->
                <div class="space-y-3">
                    <label class="block text-sm font-medium text-gray-700">
                        Back Side <span class="text-red-500">*</span>
                    </label>
                    <div class="upload-area" data-type="back">
                        <div class="upload-zone border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors duration-200 relative">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                </path>
                            </svg>
                            <p class="text-sm text-gray-600 mb-2 pointer-events-none">Drop back image here</p>
                            <p class="text-xs text-gray-500 mb-4 pointer-events-none">or click to browse</p>
                            <input type="file" name="id_card_back" accept="image/jpeg,image/png,image/gif"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <button type="button" class="choose-file-btn inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-md hover:bg-blue-700 transition-colors duration-200 pointer-events-none">
                                Choose Back Image
                            </button>
                        </div>
                        <div class="preview-container hidden mt-3">
                            <img class="preview-image w-full h-32 object-contain border border-gray-200 rounded-lg bg-gray-50" alt="Back Preview">
                            <p class="file-name text-xs text-gray-600 mt-1"></p>
                            <button type="button" class="remove-image text-xs text-red-600 hover:text-red-800 mt-1">Remove</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upload Instructions -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="text-sm font-medium text-blue-900 mb-1">Upload Instructions</h4>
                        <ul class="text-xs text-blue-700 space-y-1">
                            <li>• Upload both front and back sides of your University ID Card</li>
                            <li>• Supported formats: JPG, PNG, GIF (Max 2MB each)</li>
                            <li>• Ensure images are clear and readable</li>
                            <li>• You can upload one or both sides at once</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3">
                <button type="button" id="cancelBtn"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors duration-200">
                    Cancel
                </button>
                <button type="submit" id="uploadBtn"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-colors duration-200 flex items-center">
                    <span>Upload Images</span>
                    <svg id="uploadSpinner" class="w-4 h-4 ml-2 hidden animate-spin" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                </button>
            </div>
        </form>

        <!-- Status Messages -->
        <div id="uploadStatus" class="mt-4 p-3 rounded-md text-sm hidden"></div>
    </div>
</div>

<script>
    // Show modal with animation
    function showUploadModal() {
        const modal = document.getElementById('dualUploadModal');
        const modalContent = modal.querySelector('div');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95', 'opacity-0');
        }, 10);
    }

    // Hide modal with animation
    function hideUploadModal() {
        const modal = document.getElementById('dualUploadModal');
        const modalContent = modal.querySelector('div');
        modal.classList.add('opacity-0');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            resetForm();
        }, 300);
    }

    // Reset form state
    function resetForm() {
        document.getElementById('uploadForm').reset();
        document.querySelectorAll('.preview-container').forEach(container => {
            container.classList.add('hidden');
        });
        document.querySelectorAll('.upload-zone').forEach(zone => {
            zone.classList.remove('hidden');
        });
        document.getElementById('uploadStatus').classList.add('hidden');
        document.getElementById('uploadBtn').disabled = false;
        document.getElementById('uploadSpinner').classList.add('hidden');
    }

    // Show status message
    function showStatus(message, type = 'info') {
        const statusDiv = document.getElementById('uploadStatus');
        statusDiv.textContent = message;
        statusDiv.className =
            `mt-4 p-3 rounded-md text-sm ${type === 'success' ? 'bg-green-100 text-green-700' : type === 'error' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700'}`;
        statusDiv.classList.remove('hidden');
    }

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('dualUploadModal');
        const uploadForm = document.getElementById('uploadForm');
        const uploadBtn = document.getElementById('uploadBtn');
        const uploadSpinner = document.getElementById('uploadSpinner');

        // Close modal events
        document.getElementById('closeModal').addEventListener('click', hideUploadModal);
        document.getElementById('cancelBtn').addEventListener('click', hideUploadModal);

        // Prevent modal from closing when clicking inside modal content
        modal.querySelector('.bg-white').addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Close modal when clicking on backdrop
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                hideUploadModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                hideUploadModal();
            }
        });

        // Handle file uploads for both sides
        document.querySelectorAll('.upload-area').forEach(area => {
            const fileInput = area.querySelector('input[type="file"]');
            const previewContainer = area.querySelector('.preview-container');
            const previewImage = area.querySelector('.preview-image');
            const fileName = area.querySelector('.file-name');
            const removeBtn = area.querySelector('.remove-image');
            const dropZone = area.querySelector('.upload-zone');

            // File input change event
            fileInput.addEventListener('change', function(e) {
                e.stopPropagation();
                const file = e.target.files[0];
                if (file) {
                    handleFileUpload(file, area, previewContainer, previewImage, fileName);
                }
            });

            // Remove image event
            removeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.value = '';
                previewContainer.classList.add('hidden');
                dropZone.classList.remove('hidden');
            });

            // Click event for upload zone (only trigger file input)
            dropZone.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.click();
            });

            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropZone.classList.add('border-blue-400', 'bg-blue-50');
            }

            function unhighlight() {
                dropZone.classList.remove('border-blue-400', 'bg-blue-50');
            }

            dropZone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    handleFileUpload(files[0], area, previewContainer, previewImage, fileName);
                }
            }
        });

        // Handle file upload and preview
        function handleFileUpload(file, area, previewContainer, previewImage, fileName) {
            // Validate file
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            const maxSize = 2 * 1024 * 1024; // 2MB

            if (!allowedTypes.includes(file.type)) {
                showStatus('Please select a valid image file (JPG, PNG, GIF)', 'error');
                return;
            }

            if (file.size > maxSize) {
                showStatus('File size must be less than 2MB', 'error');
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                fileName.textContent = `Selected: ${file.name}`;
                previewContainer.classList.remove('hidden');
                area.querySelector('.upload-zone').classList.add('hidden');
                showStatus('Images selected successfully. Click "Upload Images" to proceed.', 'success');
            };
            reader.readAsDataURL(file);
        }

        // Form submission
        uploadForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const frontFile = document.querySelector('input[name="id_card_front"]').files[0];
            const backFile = document.querySelector('input[name="id_card_back"]').files[0];

            if (!frontFile && !backFile) {
                showStatus('Please select at least one image to upload', 'error');
                return;
            }

            // Show loading state
            uploadBtn.disabled = true;
            uploadSpinner.classList.remove('hidden');

            const formData = new FormData();
            formData.append('_token', document.querySelector('input[name="_token"]').value);

            // Upload front image first if selected
            if (frontFile) {
                uploadImage('front', frontFile, formData, function() {
                    // Upload back image if selected
                    if (backFile) {
                        uploadImage('back', backFile, formData, function() {
                            handleUploadComplete();
                        });
                    } else {
                        handleUploadComplete();
                    }
                });
            } else if (backFile) {
                // Only back image selected
                uploadImage('back', backFile, formData, function() {
                    handleUploadComplete();
                });
            }
        });

        // Upload individual image
        function uploadImage(type, file, baseFormData, callback) {
            const formData = new FormData();
            formData.append('_token', baseFormData.get('_token'));
            formData.append('type', type);
            formData.append('id_card', file);

            fetch('{{ route('student.upload.id_card') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        showStatus(`${type.charAt(0).toUpperCase() + type.slice(1)} side uploaded successfully!`, 'success');
                        callback();
                    } else {
                        throw new Error(data.message || 'Upload failed');
                    }
                })
                .catch(error => {
                    console.error('Upload error:', error);
                    showStatus(`Upload failed: ${error.message}`, 'error');
                    uploadBtn.disabled = false;
                    uploadSpinner.classList.add('hidden');
                });
        }

        // Handle upload completion
        function handleUploadComplete() {
            showStatus('All images uploaded successfully!', 'success');
            setTimeout(() => {
                hideUploadModal();
                // Refresh the page to show updated images
                window.location.reload();
            }, 2000);
        }
    });
</script>
