/**
 * Event Management System - Client-Side JavaScript
 * Handles form validation, loading states, and UI interactions
 */

// Form validation and submission handling
document.addEventListener('DOMContentLoaded', function() {
    
    // ==================== FORM VALIDATION ====================
    
    // Registration form validation
    const registrationForm = document.getElementById('registrationForm');
    if (registrationForm) {
        registrationForm.addEventListener('submit', function(e) {
            let isValid = true;
            const errors = [];
            
            // Get form fields
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');
            
            // Clear previous errors
            clearErrors();
            
            // Validate name
            if (!name.value.trim() || name.value.trim().length < 2) {
                isValid = false;
                errors.push('Name must be at least 2 characters');
                showFieldError(name, 'Name must be at least 2 characters');
            }
            
            // Validate email
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!email.value.trim() || !emailRegex.test(email.value.trim())) {
                isValid = false;
                errors.push('Please provide a valid email address');
                showFieldError(email, 'Please provide a valid email address');
            }
            
            // Validate phone
            const phoneRegex = /^[0-9+\-\s()]{10,20}$/;
            if (!phone.value.trim() || !phoneRegex.test(phone.value.trim())) {
                isValid = false;
                errors.push('Phone number must be 10-20 digits');
                showFieldError(phone, 'Phone number must be 10-20 digits');
            }
            
            if (!isValid) {
                e.preventDefault();
                showAlert('Please fix the errors before submitting', 'danger');
                return false;
            }
            
            // Show loading state
            showLoadingState(this);
        });
    }
    
    // Event creation/edit form validation
    const eventForm = document.querySelector('form[action*="admin/events"]');
    if (eventForm) {
        eventForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            const title = document.getElementById('title');
            const description = document.getElementById('description');
            const date = document.getElementById('date');
            const time = document.getElementById('time');
            const location = document.getElementById('location');
            const maxParticipants = document.getElementById('max_participants');
            
            clearErrors();
            
            // Validate title
            if (!title.value.trim() || title.value.trim().length < 3) {
                isValid = false;
                showFieldError(title, 'Title must be at least 3 characters');
            }
            
            // Validate description
            if (!description.value.trim() || description.value.trim().length < 10) {
                isValid = false;
                showFieldError(description, 'Description must be at least 10 characters');
            }
            
            // Validate date
            if (!date.value) {
                isValid = false;
                showFieldError(date, 'Event date is required');
            } else {
                const selectedDate = new Date(date.value);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                
                if (selectedDate < today) {
                    isValid = false;
                    showFieldError(date, 'Event date cannot be in the past');
                }
            }
            
            // Validate time
            if (!time.value) {
                isValid = false;
                showFieldError(time, 'Event time is required');
            }
            
            // Validate location
            if (!location.value.trim() || location.value.trim().length < 3) {
                isValid = false;
                showFieldError(location, 'Location must be at least 3 characters');
            }
            
            // Validate max participants
            if (!maxParticipants.value || parseInt(maxParticipants.value) <= 0) {
                isValid = false;
                showFieldError(maxParticipants, 'Maximum participants must be greater than 0');
            }
            
            if (!isValid) {
                e.preventDefault();
                showAlert('Please fix the errors before submitting', 'danger');
                return false;
            }
            
            showLoadingState(this);
        });
    }
    
    // ==================== HELPER FUNCTIONS ====================
    
    function showFieldError(field, message) {
        field.classList.add('is-invalid');
        
        // Create or update error message
        let errorDiv = field.nextElementSibling;
        if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
            errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback';
            field.parentNode.insertBefore(errorDiv, field.nextSibling);
        }
        errorDiv.textContent = message;
    }
    
    function clearErrors() {
        // Remove all invalid classes
        document.querySelectorAll('.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });
        
        // Remove all error messages
        document.querySelectorAll('.invalid-feedback').forEach(el => {
            el.remove();
        });
    }
    
    function showLoadingState(form) {
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            const originalText = submitBtn.innerHTML;
            submitBtn.setAttribute('data-original-text', originalText);
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
        }
    }
    
    function showAlert(message, type = 'info') {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            <i class="fas fa-${type === 'danger' ? 'exclamation-circle' : 'info-circle'}"></i> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        // Insert into the most appropriate container available
        const container = document.querySelector('.container') || document.querySelector('.container-fluid') || document.querySelector('.main-content') || document.body;
        if (container) {
            container.insertBefore(alertDiv, container.firstChild);
            
            // Use Bootstrap's Alert API and auto-dismiss after 5 seconds
            const bsAlert = new bootstrap.Alert(alertDiv);
            setTimeout(() => {
                try { bsAlert.close(); } catch (e) { alertDiv.remove(); }
            }, 5000);
        }
    }
    
    // ==================== DELETE CONFIRMATION ====================
    
    // Add confirmation to all delete buttons
    document.querySelectorAll('a[href*="delete"], button[onclick*="delete"]').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const itemName = this.getAttribute('data-name') || 'this item';
            if (!confirm(`Are you sure you want to delete "${itemName}"? This action cannot be undone.`)) {
                e.preventDefault();
                return false;
            }
        });
    });
    
    // ==================== SEARCH FUNCTIONALITY ====================
    
    const searchInput = document.getElementById('searchEvents');
    if (searchInput) {
        let searchTimeout;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            
            searchTimeout = setTimeout(() => {
                const keyword = this.value.trim();
                if (keyword.length >= 2) {
                    // Show loading indicator
                    this.classList.add('searching');
                    
                    // Submit search form
                    this.closest('form').submit();
                }
            }, 500); // Debounce for 500ms
        });
    }
    
    // ==================== AUTO-DISMISS ALERTS ====================
    // Ensure alerts are closed even if DOMContentLoaded already fired when script runs
    function autoDismissAlerts() {
        setTimeout(() => {
            document.querySelectorAll('.alert:not(.alert-permanent)').forEach(alert => {
                try {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                } catch (e) {
                    // Fallback: remove element directly
                    alert.remove();
                }
            });
        }, 5000);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', autoDismissAlerts);
    } else {
        autoDismissAlerts();
    }
    
    // ==================== PHONE NUMBER FORMATTING ====================
    
    const phoneInputs = document.querySelectorAll('input[type="tel"]');
    phoneInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            // Remove non-numeric characters except +, -, (), and spaces
            let value = this.value.replace(/[^0-9+\-\s()]/g, '');
            this.value = value;
        });
    });
    
    // ==================== FORM FIELD REAL-TIME VALIDATION ====================
    
    // Real-time email validation
    const emailInputs = document.querySelectorAll('input[type="email"]');
    emailInputs.forEach(input => {
        input.addEventListener('blur', function() {
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (this.value && !emailRegex.test(this.value)) {
                showFieldError(this, 'Please enter a valid email address');
            } else {
                this.classList.remove('is-invalid');
                const errorDiv = this.nextElementSibling;
                if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
                    errorDiv.remove();
                }
            }
        });
    });
    
    // ==================== SMOOTH SCROLL ====================
    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // ==================== COPY TO CLIPBOARD ====================
    
    const copyButtons = document.querySelectorAll('[data-copy]');
    copyButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const textToCopy = this.getAttribute('data-copy');
            navigator.clipboard.writeText(textToCopy).then(() => {
                showAlert('Copied to clipboard!', 'success');
            });
        });
    });
    
});

// ==================== EXPORT FUNCTIONALITY ====================

function exportData(format, eventId = null) {
    const btn = event.target;
    const originalText = btn.innerHTML;
    
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Exporting...';
    
    // The form will handle the actual export
    // This just provides visual feedback
    setTimeout(() => {
        btn.disabled = false;
        btn.innerHTML = originalText;
    }, 2000);
}

// ==================== PRINT FUNCTIONALITY ====================

function printPage() {
    window.print();
}

// ==================== UTILITY FUNCTIONS ====================

// Format date
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

// Format time
function formatTime(timeString) {
    const [hours, minutes] = timeString.split(':');
    const hour = parseInt(hours);
    const ampm = hour >= 12 ? 'PM' : 'AM';
    const displayHour = hour % 12 || 12;
    return `${displayHour}:${minutes} ${ampm}`;
}

// Console log for debugging
console.log('Event Management System - JavaScript Loaded');
