# Typify Authentication System - Documentation

## Overview
Sistem autentikasi lengkap untuk Typify web app dengan fitur:
- User Registration & Verification
- User Login with Remember Me
- Password Reset
- Real-time Form Validation
- Toast Notifications
- Gamification Integration

---

## Frontend Files

### 1. **js/auth.js**
Main authentication module dengan fungsi:

#### Validation Functions
```javascript
validateField(e)           // Real-time field validation
validateEmail(email)       // Validate email format
validatePassword(password) // Validate password strength
validateUsername(username) // Validate username format
clearFieldError(e)         // Clear field error styling
```

#### Form Handling
```javascript
handleFormSubmit(e)        // Handle form submission
validateLogin()            // Validate login form
validateRegister()         // Validate register form
```

#### Forgot Password
```javascript
openForgotPasswordModal(e) // Open forgot password modal
handleForgotPassword(e)    // Handle forgot password submission
```

#### Notifications
```javascript
showToast(message, type)   // Show toast notification
setupToastContainer()      // Initialize toast container
```

#### Session Management
```javascript
handleLogout()             // Handle user logout
```

---

### 2. **css/auth.css**
Styling untuk semua komponen autentikasi:

#### Classes
- `.auth-card` - Main authentication card
- `.input-group` - Input wrapper with label
- `.input-group input.input-error` - Error state styling
- `.error-message` - Error message text
- `.primary-btn` - Primary button styling
- `.secondary-btn` - Secondary button styling
- `.forgot-password-link` - Link styling
- `.auth-divider` - Divider line
- `.social-btn` - Social media button
- `.modal-overlay` - Modal background
- `.modal-content` - Modal container
- `.toast` - Toast notification
- `.toast-success`, `.toast-error`, `.toast-info`, `.toast-warning` - Toast variants

#### Colors
- Primary: `#243b6b` (Biru)
- Secondary: `#f5b5c5` (Pink)
- Error: `#ef4444` (Merah)
- Success: `#10b981` (Hijau)

#### Animations
- `slideUp` - Slide up entrance
- `slideDown` - Slide down entrance
- `fadeIn` - Fade in entrance
- `slideInRight` - Slide in from right
- `slideOutRight` - Slide out to right

---

## Pages

### 1. **pages/auth/login.php**
Halaman login dengan:
- Email & Password input
- Remember me checkbox
- Forgot password link
- Social login buttons
- Register link

**Form Fields:**
```
- email (required, email format)
- password (required, min 6 chars)
- remember (optional checkbox)
```

### 2. **pages/auth/register.php**
Halaman registrasi dengan:
- Username input
- Email input
- Password & confirmation
- Terms agreement checkbox
- Social signup buttons
- Login link

**Form Fields:**
```
- username (required, 3-20 chars)
- email (required, email format)
- password (required, min 6 chars)
- confirm-password (required, match password)
- agree_terms (required checkbox)
```

### 3. **pages/auth/forgot-password.php**
Halaman untuk request password reset dengan:
- Email input
- Send reset link button

**Form Fields:**
```
- email (required, email format)
```

### 4. **pages/auth/verification.php**
Halaman untuk email verification dengan:
- Verification code input
- Resend code button
- Back to login link

**Form Fields:**
```
- verification_code (required, 6 digits)
```

### 5. **pages/auth/reset-password-form.php**
Halaman untuk reset password (dari email link) dengan:
- New password input
- Confirm password input
- Update password button

**Form Fields:**
```
- reset_token (hidden, dari URL query)
- password (required, min 6 chars)
- confirm-password (required, match password)
```

---

## Backend API Endpoints

### 1. **POST /auth/login-process.php**
Login endpoint

**Request:**
```json
{
    "email": "user@example.com",
    "password": "password123",
    "remember": 1 // optional
}
```

**Response Success (200):**
```json
{
    "status": "success",
    "message": "Login berhasil",
    "redirect": "/"
}
```

**Response Error (401, 403):**
```json
{
    "status": "error",
    "message": "Email tidak terdaftar" // atau pesan error lainnya
}
```

**Validation:**
- Email format valid
- Email terdaftar di database
- Password cocok
- Email sudah terverifikasi

---

### 2. **POST /auth/register-process.php**
Register endpoint

**Request:**
```json
{
    "username": "johndoe",
    "email": "john@example.com",
    "password": "password123",
    "confirm-password": "password123"
}
```

**Response Success (200):**
```json
{
    "status": "success",
    "message": "Registrasi berhasil. Silakan cek email untuk verifikasi.",
    "redirect": "/pages/auth/verification.php"
}
```

**Response Error (400, 409):**
```json
{
    "status": "error",
    "message": "Username sudah digunakan" // atau error lainnya
}
```

**Validation:**
- Username 3-20 karakter
- Username belum digunakan
- Email format valid
- Email belum terdaftar
- Password minimal 6 karakter
- Password cocok dengan konfirmasi

---

### 3. **POST /auth/reset-password.php**
Request password reset link

**Request:**
```json
{
    "email": "user@example.com"
}
```

**Response (200):**
```json
{
    "status": "success",
    "message": "Link reset password telah dikirim ke email Anda"
}
```

**Validation:**
- Email format valid
- Email terdaftar (return same message for security)

---

### 4. **POST /auth/verify-email.php**
Verify email dengan code

**Request:**
```json
{
    "verification_code": "ABC123"
}
```

**Response Success (200):**
```json
{
    "status": "success",
    "message": "Email berhasil diverifikasi. Silakan login.",
    "redirect": "/pages/auth/login.php"
}
```

**Response Error (404):**
```json
{
    "status": "error",
    "message": "Kode verifikasi tidak valid"
}
```

---

### 5. **POST /auth/update-password.php**
Update password dengan reset token

**Request:**
```json
{
    "reset_token": "token_dari_email",
    "password": "newpassword123",
    "confirm-password": "newpassword123"
}
```

**Response Success (200):**
```json
{
    "status": "success",
    "message": "Password berhasil diperbarui. Silakan login.",
    "redirect": "/pages/auth/login.php"
}
```

**Response Error (401, 404):**
```json
{
    "status": "error",
    "message": "Link reset telah kadaluarsa"
}
```

---

### 6. **POST /auth/logout.php**
Logout endpoint

**Response (200):**
```json
{
    "status": "success",
    "message": "Logout berhasil"
}
```

---

## Database Schema

### users table
```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(120) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    avatar VARCHAR(255) DEFAULT 'default.jpg',
    bio TEXT,
    email_verified BOOLEAN DEFAULT 0,
    verification_code VARCHAR(6),
    reset_token VARCHAR(255),
    reset_expires DATETIME,
    remember_token VARCHAR(255),
    last_login DATETIME,
    status ENUM('active', 'suspended', 'deleted') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### user_profiles table
```sql
CREATE TABLE user_profiles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL UNIQUE,
    full_name VARCHAR(100),
    phone VARCHAR(20),
    location VARCHAR(100),
    website VARCHAR(255),
    social_twitter VARCHAR(100),
    social_instagram VARCHAR(100),
    social_github VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## Usage Examples

### Login Form
```html
<form method="POST" action="/auth/login-process.php">
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <button type="submit" class="primary-btn">Login</button>
</form>
```

### Register Form
```html
<form method="POST" action="/auth/register-process.php">
    <input type="text" name="username" required>
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <input type="password" name="confirm-password" required>
    <button type="submit" class="primary-btn">Register</button>
</form>
```

### Show Toast
```javascript
showToast('Login berhasil!', 'success');
showToast('Email sudah terdaftar', 'error');
showToast('Informasi penting', 'info');
showToast('Hati-hati!', 'warning');
```

---

## Security Notes

1. **Password Hashing**: Menggunakan `PASSWORD_BCRYPT` untuk hash password
2. **Email Verification**: Email harus terverifikasi sebelum login
3. **Reset Token**: Token reset berlaku hanya 1 jam
4. **Remember Token**: Token tersimpan hashed di database
5. **Session Management**: Menggunakan PHP session untuk authenticated users
6. **CSRF Protection**: Implementasikan token CSRF untuk POST requests (TODO)
7. **Rate Limiting**: Implementasikan rate limiting untuk login attempts (TODO)

---

## TODO - Future Improvements

- [ ] CSRF token implementation
- [ ] Rate limiting for login attempts
- [ ] Two-factor authentication (2FA)
- [ ] OAuth social login integration
- [ ] Email notification system
- [ ] Activity logging
- [ ] User role & permissions system
- [ ] Session timeout handling
- [ ] Auto logout on inactivity

---

## Support Files

- **css/variables.css** - Color & design variables
- **css/style.css** - Global styles
- **css/components.css** - Reusable components
- **css/animations.css** - Animation definitions
- **includes/header.php** - HTML head & navigation
- **includes/footer.php** - Footer & script includes
- **includes/db.php** - Database connection

