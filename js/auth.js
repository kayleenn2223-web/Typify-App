// ============================================
// TYPIFY AUTH MODULE
// Login, Register, Forgot Password, Validation
// ============================================

// DOM Elements
const authForm = document.querySelector('form');
const submitBtn = document.querySelector('.primary-btn');
const inputs = document.querySelectorAll('input');
const emailInput = document.querySelector('input[type="email"]');
const passwordInput = document.querySelector('input[type="password"]');
const confirmPasswordInput = document.querySelector('input[name="confirm-password"]');

// Initialize Auth Module
document.addEventListener('DOMContentLoaded', function() {
    initializeAuth();
    setupFormValidation();
    setupForgotPasswordModal();
});

// ============================================
// INITIALIZATION
// ============================================

function initializeAuth() {
    console.log('🔐 Typify Auth Module Initialized');
    addInputEventListeners();
    setupToastContainer();
}

function addInputEventListeners() {
    inputs.forEach(input => {
        input.addEventListener('input', validateField);
        input.addEventListener('blur', validateField);
        input.addEventListener('focus', clearFieldError);
    });
}

// ============================================
// FORM VALIDATION
// ============================================

function setupFormValidation() {
    if (authForm) {
        authForm.addEventListener('submit', handleFormSubmit);
    }
}

function validateField(e) {
    const field = e.target;
    const value = field.value.trim();
    const fieldName = field.getAttribute('name') || field.getAttribute('type');
    let isValid = true;
    let errorMsg = '';

    // Validate based on field type
    if (field.type === 'email') {
        isValid = validateEmail(value);
        errorMsg = isValid ? '' : '❌ Email tidak valid';
    } else if (field.type === 'password' && field.name !== 'confirm-password') {
        isValid = validatePassword(value);
        errorMsg = isValid ? '' : '❌ Password minimal 6 karakter';
    } else if (field.name === 'confirm-password') {
        isValid = value === passwordInput.value;
        errorMsg = isValid ? '' : '❌ Password tidak cocok';
    } else if (field.type === 'text' && field.name === 'username') {
        isValid = validateUsername(value);
        errorMsg = isValid ? '' : '❌ Username harus 3-20 karakter';
    }

    // Update field style
    if (value === '') {
        removeFieldError(field);
        return;
    }

    if (!isValid) {
        showFieldError(field, errorMsg);
    } else {
        removeFieldError(field);
    }

    return isValid;
}

function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function validatePassword(password) {
    return password.length >= 6;
}

function validateUsername(username) {
    return username.length >= 3 && username.length <= 20;
}

function clearFieldError(e) {
    const field = e.target;
    removeFieldError(field);
}

function showFieldError(field, message) {
    field.classList.add('input-error');
    
    let errorElement = field.parentElement.querySelector('.error-message');
    if (!errorElement) {
        errorElement = document.createElement('small');
        errorElement.classList.add('error-message');
        field.parentElement.appendChild(errorElement);
    }
    errorElement.textContent = message;
}

function removeFieldError(field) {
    field.classList.remove('input-error');
    const errorElement = field.parentElement.querySelector('.error-message');
    if (errorElement) {
        errorElement.textContent = '';
    }
}

// ============================================
// FORM SUBMISSION
// ============================================

async function handleFormSubmit(e) {
    e.preventDefault();
    
    // Validate all fields
    let allValid = true;
    inputs.forEach(input => {
        if (input.value.trim() === '') {
            allValid = false;
        }
    });

    if (!allValid) {
        showToast('❌ Harap isi semua field', 'error');
        return;
    }

    // Validate each field
    inputs.forEach(input => {
        if (!validateField({target: input})) {
            allValid = false;
        }
    });

    if (!allValid) {
        showToast('❌ Ada data yang tidak valid', 'error');
        return;
    }

    // Disable button during submission
    submitBtn.disabled = true;
    submitBtn.textContent = 'Memproses...';

    try {
        // Get form data
        const formData = new FormData(authForm);
        const currentPage = window.location.pathname;
        
        let endpoint = '/Typify-App-ellen/auth/login-process.php';
        if (currentPage.includes('register')) {
            endpoint = '/Typify-App-ellen/auth/register-process.php';
        }

        // Submit form
        const response = await fetch(endpoint, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const data = await response.json();

        if (data.status === 'success') {
            showToast('✅ ' + data.message, 'success');
            setTimeout(() => {
                window.location.href = data.redirect || '/';
            }, 1500);
        } else {
            showToast('❌ ' + data.message, 'error');
            submitBtn.disabled = false;
            submitBtn.textContent = currentPage.includes('register') ? 'Daftar' : 'Login';
        }
    } catch (error) {
        console.error('Form submission error:', error);
        showToast('❌ Terjadi kesalahan. Silakan coba lagi', 'error');
        submitBtn.disabled = false;
        submitBtn.textContent = authForm.querySelector('.primary-btn').getAttribute('data-original-text') || 'Submit';
    }
}

// ============================================
// FORGOT PASSWORD MODAL
// ============================================

function setupForgotPasswordModal() {
    const forgotPasswordLinks = document.querySelectorAll('.forgot-password-link');
    forgotPasswordLinks.forEach(link => {
        link.addEventListener('click', openForgotPasswordModal);
    });
}

function openForgotPasswordModal(e) {
    e.preventDefault();
    
    const modal = document.createElement('div');
    modal.classList.add('modal-overlay');
    modal.innerHTML = `
        <div class="modal-content forgot-password-modal">
            <div class="modal-header">
                <h2>Lupa Password?</h2>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <p class="modal-description">Masukkan email Anda untuk menerima link reset password</p>
                <form id="forgotPasswordForm">
                    <div class="input-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Masukkan email Anda" required>
                        <small class="error-message"></small>
                    </div>
                    <button type="submit" class="primary-btn" style="width: 100%;">Kirim Link Reset</button>
                </form>
            </div>
        </div>
    `;

    document.body.appendChild(modal);

    // Close button
    modal.querySelector('.modal-close').addEventListener('click', () => {
        modal.remove();
    });

    // Close on overlay click
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.remove();
        }
    });

    // Form submission
    modal.querySelector('#forgotPasswordForm').addEventListener('submit', handleForgotPassword);
}

async function handleForgotPassword(e) {
    e.preventDefault();
    
    const email = e.target.querySelector('input[name="email"]').value.trim();
    
    if (!validateEmail(email)) {
        showToast('❌ Email tidak valid', 'error');
        return;
    }

    const submitBtn = e.target.querySelector('.primary-btn');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Mengirim...';

    try {
        const response = await fetch('/Typify-App-ellen/auth/reset-password.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ email: email })
        });

        const data = await response.json();

        if (data.status === 'success') {
            showToast('✅ Email reset telah dikirim', 'success');
            setTimeout(() => {
                document.querySelector('.modal-overlay').remove();
            }, 1500);
        } else {
            showToast('❌ ' + data.message, 'error');
        }
    } catch (error) {
        console.error('Reset password error:', error);
        showToast('❌ Terjadi kesalahan', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Kirim Link Reset';
    }
}

// ============================================
// TOAST NOTIFICATIONS
// ============================================

function setupToastContainer() {
    if (!document.querySelector('.toast-container')) {
        const container = document.createElement('div');
        container.classList.add('toast-container');
        document.body.appendChild(container);
    }
}

function showToast(message, type = 'info') {
    const container = document.querySelector('.toast-container');
    
    const toast = document.createElement('div');
    toast.classList.add('toast', `toast-${type}`);
    toast.textContent = message;
    
    container.appendChild(toast);

    // Auto remove
    setTimeout(() => {
        toast.classList.add('toast-remove');
        setTimeout(() => toast.remove(), 300);
    }, 4000);

    // Click to remove
    toast.addEventListener('click', () => {
        toast.classList.add('toast-remove');
        setTimeout(() => toast.remove(), 300);
    });
}

// ============================================
// SESSION & LOGOUT
// ============================================

function handleLogout() {
    if (confirm('Yakin ingin logout?')) {
        fetch('/Typify-App-ellen/auth/logout.php', {
            method: 'POST'
        }).then(() => {
            showToast('✅ Logout berhasil', 'success');
            setTimeout(() => {
                window.location.href = '/Typify-App-ellen/';
            }, 1000);
        });
    }
}

// ============================================
// EXPORT FUNCTIONS
// ============================================

window.validateLogin = validateLogin;
window.validateRegister = validateRegister;
window.showToast = showToast;
window.handleLogout = handleLogout;

function validateLogin() {
    console.log('🔐 Login validation active');
    return validateAllFields();
}

function validateRegister() {
    console.log('📝 Register validation active');
    return validateAllFields();
}

function validateAllFields() {
    let isValid = true;
    inputs.forEach(input => {
        if (!validateField({target: input})) {
            isValid = false;
        }
    });
    return isValid;
}