<div id="uploadModal"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden transition-opacity duration-300">
    <div
        class="bg-white rounded-xl shadow-2xl p-6 w-11/12 max-w-md transform transition-all duration-300 scale-95 opacity-0">
        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
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
            <!-- ID Card Type Selection -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Select ID Card Side
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <label
                        class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                        <input type="radio" name="type" value="front" class="mr-2" checked>
                        <span class="text-sm font-medium text-gray-700">Front Side</span>
                    </label>
                    <label
                        class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                        <input type="radio" name="type" value="back" class="mr-2">
                        <span class="text-sm font-medium text-gray-700">Back Side</span>
                    </label>
                </div>
            </div>

            <div class="mb-6">
                <label for="id_card" class="block text-sm font-medium text-gray-700 mb-2">
                    Select ID Card Image (JPG, PNG, GIF - Max 2MB)
                </label>
                <div
                    class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors duration-200">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                        </path>
                    </svg>
                    <p class="text-sm text-gray-600 mb-2">Drag & drop your file here</p>
                    <p class="text-xs text-gray-500 mb-4">or</p>
                    <input type="file" id="id_card" name="id_card" accept="image/jpeg,image/png,image/gif"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <label for="id_card"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors duration-200 cursor-pointer">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Choose File
                    </label>
                </div>
                <p id="fileName" class="text-sm text-gray-600 mt-2 hidden"></p>
            </div>

            <!-- Preview Section -->
            <div id="imagePreview" class="mb-6 hidden">
                <h3 class="text-sm font-medium text-gray-700 mb-2">Preview</h3>
                <div class="border border-gray-200 rounded-lg p-2">
                    <img id="previewImage" class="w-full h-32 object-contain rounded" alt="ID Card Preview">
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
                    <span>Upload</span>
                    <svg id="uploadSpinner" class="w-4 h-4 ml-2 hidden animate-spin" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m极 0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
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
        const modal = document.getElementById('uploadModal');
        const modalContent = modal.querySelector('div');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95', 'opacity-0');
        }, 10);
    }

    // Hide modal with animation
    function hideUploadModal() {
        const modal = document.getElementById('uploadModal');
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
        document.getElementById('imagePreview').classList.add('hidden');
        document.getElementById('fileName').classList.add('hidden');
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
        const modal = document.getElementById('uploadModal');
        const fileInput = document.getElementById('id_card');
        const fileName = document.getElementById('fileName');
        const imagePreview = document.getElementById('imagePreview');
        const previewImage = document.getElementById('previewImage');
        const uploadForm = document.getElementById('uploadForm');
        const uploadBtn = document.getElementById('uploadBtn');
        const uploadSpinner = document.getElementById('uploadSpinner');

        // Close modal events
        document.getElementById('closeModal').addEventListener('click', hideUploadModal);
        document.getElementById('cancelBtn').addEventListener('click', hideUploadModal);

        // File input change event
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Show file name
                fileName.textContent = `Selected: ${file.name}`;
                fileName.classList.remove('hidden');

                // Validate file
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                const maxSize = 2 * 1024 * 1024; // 2MB

                if (!allowedTypes.includes(file.type)) {
                    showStatus('Please select a valid image file (JPG, PNG, GIF)', 'error');
                    resetForm();
                    return;
                }

                if (file.size > maxSize) {
                    showStatus('File size must be less than 2MB', 'error');
                    resetForm();
                    return;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    showStatus('File selected successfully. Click Upload to proceed.', 'success');
                };
                reader.readAsDataURL(file);
            }
        });

        // Form submission
        uploadForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const file = fileInput.files[0];
            if (!file) {
                showStatus('Please select a file to upload', 'error');
                return;
            }

            // Show loading state
            uploadBtn.disabled = true;
            uploadSpinner.classList.remove('hidden');

            const formData = new FormData(this);

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
                        showStatus('ID Card uploaded successfully!', 'success');
                        // Close modal after success
                        setTimeout(hideUploadModal, 2000);
                    } else {
                        showStatus('Upload failed: ' + (data.message || 'Unknown error'), 'error');
                        uploadBtn.disabled = false;
                        uploadSpinner.classList.add('hidden');
                    }
                })
                .catch(error => {
                    console.error('Upload error:', error);
                    showStatus('Upload failed: ' + error.message, 'error');
                    uploadBtn.disabled = false;
                    uploadSpinner.classList.add('hidden');
                });
        });

        // Drag and drop functionality
        const dropZone = fileInput.parentElement;
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
            fileInput.files = files;
            const event = new Event('change');
            fileInput.dispatchEvent(event);
        }
    });
</script>
