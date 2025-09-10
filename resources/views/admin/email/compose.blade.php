@extends('layouts.admin_app')

@section('title', 'Email Communication')

@section('content')
    <div class="email-communication-container">
        <div class="container mx-auto px-4 py-8">
            <div class="email-form-card">
                <div class="email-form-header">
                    <h1 class="email-form-title">
                        <i class="fas fa-envelope mr-3"></i>Email Communication
                    </h1>
                    <p class="email-form-subtitle">Send individual or bulk emails to students</p>
                </div>

                <div class="email-type-selector">
                    <div class="email-type-buttons">
                        <button type="button" class="email-type-btn active" data-type="individual">
                            <i class="fas fa-user"></i>
                            Individual Email
                        </button>
                        <button type="button" class="email-type-btn" data-type="bulk">
                            <i class="fas fa-users"></i>
                            Bulk Email
                        </button>
                    </div>
                </div>

                <div class="email-form-content">
                    <!-- Individual Email Form -->
                    <div id="individual-form" class="form-section">
                        <h3 class="form-section-title">
                            <i class="fas fa-user mr-2"></i>Send Individual Email
                        </h3>
                        <form action="{{ route('admin.email.send-individual') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student_id" class="form-label">
                                            Select Student <span class="required">*</span>
                                        </label>
                                        <select name="student_id" id="student_id" class="form-control select2" required>
                                            <option value="">Choose a student...</option>
                                            @foreach ($students as $student)
                                                <option value="{{ $student->student_id }}">
                                                    {{ $student->name }} ({{ $student->student_id }}) -
                                                    {{ $student->email }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('student_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="individual_subject" class="form-label">
                                            Subject <span class="required">*</span>
                                        </label>
                                        <input type="text" name="subject" id="individual_subject" class="form-control"
                                            placeholder="Enter email subject" required>
                                        @error('subject')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="individual_message" class="form-label">
                                    Message <span class="required">*</span>
                                </label>
                                <textarea name="message" id="individual_message" class="form-control" rows="10"
                                    placeholder="Enter your message here..." required></textarea>
                                @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Send Individual Email
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Bulk Email Form -->
                    <div id="bulk-form" class="form-section" style="display: none;">
                        <h3 class="form-section-title">
                            <i class="fas fa-users mr-2"></i>Send Bulk Email
                        </h3>
                        <div class="student-count-info">
                            <div class="icon">📢</div>
                            <div class="text">This email will be sent to all active students in the system</div>
                            <div class="count">Total Active Students: {{ $students->count() }}</div>
                        </div>
                        <form action="{{ route('admin.email.send-bulk') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="bulk_subject" class="form-label">
                                    Subject <span class="required">*</span>
                                </label>
                                <input type="text" name="subject" id="bulk_subject" class="form-control"
                                    placeholder="Enter email subject" required>
                                @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="bulk_message" class="form-label">
                                    Message <span class="required">*</span>
                                </label>
                                <textarea name="message" id="bulk_message" class="form-control" rows="10" placeholder="Enter your message here..."
                                    required></textarea>
                                @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-warning"
                                    onclick="return confirm('Are you sure you want to send this email to all {{ $students->count() }} active students?')">
                                    <i class="fas fa-paper-plane"></i> Send Bulk Email
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/admin_email_communication.js') }}"></script>
@endsection
