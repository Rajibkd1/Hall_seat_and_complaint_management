@include('layouts.admin_layout_helper')
@extends($layout)

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100">
        <div class="container mx-auto px-4 py-8">
            <!-- Header with Breadcrumb -->
            <div class="mb-8">
                <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-4">
                    <a href="{{ route('admin.notices') }}"
                        class="hover:text-blue-600 transition-colors duration-200">Notices</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-900 font-medium">Create Notice</span>
                </nav>
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-800 mb-2">Create New Notice</h1>
                        <p class="text-gray-600">Add a new notice for hall residents</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.notices') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to List
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden form-card">
                        <!-- Form Header -->
                        <div class="bg-gradient-to-r from-blue-600 to-purple-700 px-6 py-4">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-semibold text-white">Notice Details</h2>
                                    <p class="text-blue-100 text-sm">Fill in the information below</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Content -->
                        <div class="p-6">
                            <form action="{{ route('admin.notices.store') }}" method="POST" id="createNoticeForm">
                                @csrf

                                <!-- Title Field -->
                                <div class="mb-6">
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                                </path>
                                            </svg>
                                            Notice Title
                                            <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('title') border-red-500 @enderror"
                                        placeholder="Enter notice title..." required>
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <div class="mt-1 text-sm text-gray-500">
                                        <span id="titleCount">0</span> characters
                                    </div>
                                </div>

                                <!-- Notice Type Field -->
                                <div class="mb-6">
                                    <label for="notice_type" class="block text-sm font-medium text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Notice Type
                                            <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <select name="notice_type" id="notice_type"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('notice_type') border-red-500 @enderror">
                                        <option value="announcement"
                                            {{ old('notice_type') === 'announcement' ? 'selected' : '' }}>Announcement
                                        </option>
                                        <option value="event" {{ old('notice_type') === 'event' ? 'selected' : '' }}>Event
                                        </option>
                                        <option value="deadline" {{ old('notice_type') === 'deadline' ? 'selected' : '' }}>
                                            Deadline</option>
                                    </select>
                                    @error('notice_type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description Field -->
                                <div class="mb-6">
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            Description
                                            <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>

                                    <!-- Rich Text Editor -->
                                    <div
                                        class="rich-text-editor border border-gray-300 rounded-lg overflow-hidden @error('description') border-red-500 @enderror">
                                        <!-- Toolbar -->
                                        <div
                                            class="toolbar bg-gray-50 border-b border-gray-200 p-2 flex flex-wrap items-center gap-1">
                                            <!-- Undo/Redo -->
                                            <button type="button" class="toolbar-btn" data-command="undo"
                                                title="Undo">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                                </svg>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="redo"
                                                title="Redo">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M21 10h-10a8 8 0 00-8 8v2m18-10l-6 6m6-6l-6-6"></path>
                                                </svg>
                                            </button>

                                            <div class="w-px h-6 bg-gray-300 mx-1"></div>

                                            <!-- Text Formatting -->
                                            <button type="button" class="toolbar-btn" data-command="bold"
                                                title="Bold">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"></path>
                                                </svg>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="italic"
                                                title="Italic">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 4h4M8 20h4M12 4v16"></path>
                                                </svg>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="underline"
                                                title="Underline">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 4v16m-4-4h8"></path>
                                                </svg>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="strikeThrough"
                                                title="Strikethrough">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l6 0M9 12l0 0M15 12l0 0M9 12l0 0M15 12l0 0M9 12l0 0M15 12l0 0">
                                                    </path>
                                                </svg>
                                            </button>

                                            <div class="w-px h-6 bg-gray-300 mx-1"></div>

                                            <!-- Lists -->
                                            <button type="button" class="toolbar-btn" data-command="insertUnorderedList"
                                                title="Bullet List">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                                </svg>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="insertOrderedList"
                                                title="Numbered List">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                                </svg>
                                            </button>

                                            <div class="w-px h-6 bg-gray-300 mx-1"></div>

                                            <!-- Alignment -->
                                            <button type="button" class="toolbar-btn" data-command="justifyLeft"
                                                title="Align Left">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 4h18M3 8h12M3 12h18M3 16h12"></path>
                                                </svg>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="justifyCenter"
                                                title="Align Center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 4h18M3 8h12M3 12h18M3 16h12"></path>
                                                </svg>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="justifyRight"
                                                title="Align Right">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 4h18M3 8h12M3 12h18M3 16h12"></path>
                                                </svg>
                                            </button>

                                            <div class="w-px h-6 bg-gray-300 mx-1"></div>

                                            <!-- Links -->
                                            <button type="button" class="toolbar-btn" data-command="createLink"
                                                title="Insert Link">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                                    </path>
                                                </svg>
                                            </button>

                                            <div class="w-px h-6 bg-gray-300 mx-1"></div>

                                            <!-- Clear Formatting -->
                                            <button type="button" class="toolbar-btn" data-command="removeFormat"
                                                title="Clear Formatting">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Editor Content -->
                                        <div id="description" class="editor-content min-h-[150px] p-4 focus:outline-none"
                                            contenteditable="true" data-placeholder="Enter notice description..."></div>
                                    </div>

                                    <!-- Hidden textarea for form submission -->
                                    <textarea name="description" id="description-hidden" style="display: none;">{{ old('description') }}</textarea>

                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <div class="mt-1 text-sm text-gray-500">
                                        <span id="descCount">0</span> characters
                                    </div>
                                </div>

                                <!-- Date and Status Row -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <!-- Date Posted Field -->
                                    <div>
                                        <label for="date_posted" class="block text-sm font-medium text-gray-700 mb-2">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 text-gray-500 mr-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                Date Posted
                                                <span class="text-red-500 ml-1">*</span>
                                            </span>
                                        </label>
                                        <input type="date" name="date_posted" id="date_posted"
                                            value="{{ old('date_posted', date('Y-m-d')) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('date_posted') border-red-500 @enderror"
                                            required>
                                        @error('date_posted')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Status Field -->
                                    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 text-gray-500 mr-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Status
                                                <span class="text-red-500 ml-1">*</span>
                                            </span>
                                        </label>
                                        <select name="status" id="status"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('status') border-red-500 @enderror">
                                            <option value="active"
                                                {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                        @error('status')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                                    <button type="submit"
                                        class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                                        id="submitBtn">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Create Notice
                                    </button>
                                    <a href="{{ route('admin.notices') }}"
                                        class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Form Progress -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 info-card">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                            Form Progress
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Title</span>
                                <div class="w-4 h-4 rounded-full bg-gray-200" id="titleProgress"></div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Type</span>
                                <div class="w-4 h-4 rounded-full bg-green-500" id="typeProgress"></div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Description</span>
                                <div class="w-4 h-4 rounded-full bg-gray-200" id="descProgress"></div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Date</span>
                                <div class="w-4 h-4 rounded-full bg-green-500" id="dateProgress"></div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Status</span>
                                <div class="w-4 h-4 rounded-full bg-green-500" id="statusProgress"></div>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Overall Progress</span>
                                <span class="font-medium text-gray-900" id="overallProgress">60%</span>
                            </div>
                            <div class="mt-2 bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" id="progressBar"
                                    style="width: 60%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Tips Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 info-card">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                </path>
                            </svg>
                            Writing Tips
                        </h3>
                        <div class="space-y-3 text-sm text-gray-600">
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <p>Keep titles concise and descriptive (recommended: 5-10 words).</p>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <p>Use clear and simple language in descriptions.</p>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <p>Include important details like dates, times, and locations.</p>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <p>Active notices are immediately visible to all students.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 info-card">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <button type="button" onclick="previewNotice()"
                                class="w-full text-left px-4 py-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200 flex items-center">
                                <svg class="w-5 h-5 text-gray-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                <span class="text-gray-700">Preview Notice</span>
                            </button>
                            <button type="button" onclick="clearForm()"
                                class="w-full text-left px-4 py-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200 flex items-center">
                                <svg class="w-5 h-5 text-gray-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                <span class="text-gray-700">Clear Form</span>
                            </button>
                            <button type="button" onclick="saveAsDraft()"
                                class="w-full text-left px-4 py-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200 flex items-center">
                                <svg class="w-5 h-5 text-gray-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>
                                <span class="text-gray-700">Save as Draft</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div id="previewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4 max-h-[80vh] overflow-y-auto transform transition-all duration-300 scale-95 opacity-0"
            id="previewContent">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Notice Preview</h3>
                <button onclick="closePreview()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="border border-gray-200 rounded-lg p-4">
                <h4 id="previewTitle" class="text-xl font-bold text-gray-900 mb-2"></h4>
                <p id="previewDate" class="text-sm text-gray-600 mb-4"></p>
                <div id="previewDescription" class="text-gray-700 whitespace-pre-wrap"></div>
                <div id="previewStatus" class="mt-4"></div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('css/admin_create_notice.css') }}">
    <script src="{{ asset('js/admin_create_notice.js') }}"></script>
@endsection
