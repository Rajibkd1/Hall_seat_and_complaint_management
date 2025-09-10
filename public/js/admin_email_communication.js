// Email Communication JavaScript
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        placeholder: 'Choose a student...',
        allowClear: true,
        width: '100%'
    });

    // Email type toggle
    $('.email-type-btn').click(function() {
        const emailType = $(this).data('type');
        
        // Update button states
        $('.email-type-btn').removeClass('active');
        $(this).addClass('active');
        
        // Show/hide forms
        if (emailType === 'individual') {
            $('#individual-form').show();
            $('#bulk-form').hide();
        } else {
            $('#individual-form').hide();
            $('#bulk-form').show();
        }
    });

    // Rich text editor for message fields
    $('#individual_message, #bulk_message').summernote({
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        placeholder: 'Enter your message here...',
        callbacks: {
            onInit: function() {
                $(this).next('.note-editor').css('border-radius', '8px');
            }
        }
    });

    // Form validation and submission
    $('form').submit(function(e) {
        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        
        // Add loading state
        submitBtn.addClass('loading');
        submitBtn.prop('disabled', true);
        
        // Remove loading state after 5 seconds (fallback)
        setTimeout(function() {
            submitBtn.removeClass('loading');
            submitBtn.prop('disabled', false);
        }, 5000);
    });

    // Show success/error messages
    @if(session('success'))
        showAlert('success', '{{ session('success') }}');
    @endif
    
    @if(session('error'))
        showAlert('error', '{{ session('error') }}');
    @endif
});

function showAlert(type, message) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} mr-2"></i>
            ${message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `;
    
    $('.email-form-content').prepend(alertHtml);
    
    // Auto-dismiss after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut();
    }, 5000);
}

// Character count for message fields
function updateCharCount(textarea) {
    const maxLength = 5000;
    const currentLength = textarea.val().length;
    const remaining = maxLength - currentLength;
    
    let counter = textarea.siblings('.char-counter');
    if (counter.length === 0) {
        counter = $('<small class="char-counter text-muted"></small>');
        textarea.after(counter);
    }
    
    counter.text(`${currentLength}/${maxLength} characters`);
    
    if (remaining < 100) {
        counter.addClass('text-warning');
    } else {
        counter.removeClass('text-warning');
    }
}

// Add character counter to message fields
$('#individual_message, #bulk_message').on('summernote.change', function() {
    updateCharCount($(this));
});

// Form validation
function validateForm(form) {
    let isValid = true;
    const requiredFields = form.find('[required]');
    
    requiredFields.each(function() {
        const field = $(this);
        const value = field.val();
        
        if (!value || value.trim() === '') {
            field.addClass('is-invalid');
            isValid = false;
        } else {
            field.removeClass('is-invalid');
        }
    });
    
    return isValid;
}

// Real-time validation
$('input[required], select[required], textarea[required]').on('blur', function() {
    const field = $(this);
    const value = field.val();
    
    if (!value || value.trim() === '') {
        field.addClass('is-invalid');
    } else {
        field.removeClass('is-invalid');
    }
});

// Clear validation on input
$('input[required], select[required], textarea[required]').on('input', function() {
    $(this).removeClass('is-invalid');
});

