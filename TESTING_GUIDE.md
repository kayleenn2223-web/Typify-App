# Typify Auth System - Testing Guide

## Prerequisites
- XAMPP installed & running
- MySQL database `typify` created
- Database tables created from `database/typify.sql`
- Web server running on `http://localhost/Typify-App`

---

## 1. Setup Database

### Step 1: Create Database
```sql
-- Go to phpMyAdmin: http://localhost/phpmyadmin
-- Create new database named "typify"
-- Import the database structure:
```

### Step 2: Import SQL File
```bash
# Navigate to XAMPP MySQL folder
cd C:\xampp\mysql\bin

# Import SQL file
mysql -u root typify < "C:\xampp\htdocs\Typify-App-ellen\database\typify.sql"
```

Or via phpMyAdmin:
1. Open phpMyAdmin
2. Select `typify` database
3. Go to Import tab
4. Choose `database/typify.sql` file
5. Click Import

---

## 2. Test Registration

### Test 2.1: Valid Registration
```
URL: http://localhost/Typify-App/pages/auth/register.php

Input:
- Username: testuser123
- Email: test@example.com
- Password: password123
- Confirm Password: password123

Expected:
- Success message
- Redirect to verification page
- Verification code logged in PHP error log
```

### Test 2.2: Invalid Email
```
Input:
- Username: testuser123
- Email: invalid-email
- Password: password123
- Confirm Password: password123

Expected:
- Error: "Format email tidak valid"
```

### Test 2.3: Short Password
```
Input:
- Username: testuser123
- Email: test@example.com
- Password: 12345
- Confirm Password: 12345

Expected:
- Error: "Password minimal 6 karakter"
```

### Test 2.4: Password Mismatch
```
Input:
- Username: testuser123
- Email: test@example.com
- Password: password123
- Confirm Password: password456

Expected:
- Error: "Password tidak cocok"
```

### Test 2.5: Duplicate Username
```
Register twice with same username:
Input: testuser123

Expected (2nd attempt):
- Error: "Username sudah digunakan"
```

### Test 2.6: Duplicate Email
```
Register twice with same email:
Input: test@example.com

Expected (2nd attempt):
- Error: "Email sudah terdaftar"
```

### Test 2.7: Short Username
```
Input:
- Username: ab (2 chars)
- Email: test@example.com
- Password: password123

Expected:
- Error: "Username harus 3-20 karakter"
```

---

## 3. Test Email Verification

### Test 3.1: Valid Verification Code
```
URL: http://localhost/Typify-App/pages/auth/verification.php

1. Get verification code from PHP error log:
   - Check C:\xampp\apache\logs\error.log
   - Find line: "Verification code for test@example.com: XXXXXX"

Input:
- Verification Code: XXXXXX (6 alphanumeric)

Expected:
- Success: "Email berhasil diverifikasi"
- Redirect to login page
```

### Test 3.2: Invalid Code Format
```
Input:
- Verification Code: ABCD (too short)

Expected:
- Error: "Format kode verifikasi tidak valid"
```

### Test 3.3: Non-existent Code
```
Input:
- Verification Code: AAAAAA

Expected:
- Error: "Kode verifikasi tidak valid"
```

### Test 3.4: Already Verified
```
Verify same email twice

Expected (2nd attempt):
- Error: "Email sudah terverifikasi"
```

---

## 4. Test Login

### Test 4.1: Valid Login
```
URL: http://localhost/Typify-App/pages/auth/login.php

Input (after verification):
- Email: test@example.com
- Password: password123
- Remember Me: (checked or unchecked)

Expected:
- Success: "Login berhasil"
- Session created
- Redirect to home page
```

### Test 4.2: Unverified Email
```
Input:
- Email: unverified@example.com (registered but not verified)
- Password: password123

Expected:
- Error: "Silakan verifikasi email Anda terlebih dahulu"
```

### Test 4.3: Invalid Email
```
Input:
- Email: test@invalid
- Password: password123

Expected:
- Error: "Format email tidak valid"
```

### Test 4.4: Wrong Password
```
Input:
- Email: test@example.com
- Password: wrongpassword

Expected:
- Error: "Email atau password salah"
```

### Test 4.5: Non-existent Email
```
Input:
- Email: nonexistent@example.com
- Password: password123

Expected:
- Error: "Email atau password salah"
```

### Test 4.6: Remember Me
```
1. Login with "Remember Me" checked
2. Close browser
3. Reopen: http://localhost/Typify-App

Expected:
- Should auto-login or show welcome message
- Check cookies: remember_token should exist
```

---

## 5. Test Forgot Password

### Test 5.1: Valid Email Request
```
URL: http://localhost/Typify-App/pages/auth/forgot-password.php

Input:
- Email: test@example.com

Expected:
- Success: "Jika email terdaftar, link reset akan dikirim"
- Reset link logged in error.log
- Check log for: "Password reset link for test@example.com: ..."
```

### Test 5.2: Non-existent Email
```
Input:
- Email: nonexistent@example.com

Expected:
- Success message (same as valid for security)
- No link in error.log
```

### Test 5.3: Invalid Email
```
Input:
- Email: invalid-email

Expected:
- Error: "Format email tidak valid"
```

---

## 6. Test Password Reset

### Test 6.1: Valid Reset Token
```
1. Request password reset for: test@example.com
2. Get reset link from error.log
3. Open reset link: /pages/auth/reset-password-form.php?token=XXXXX

Input:
- New Password: newpassword123
- Confirm Password: newpassword123

Expected:
- Success: "Password berhasil diperbarui"
- Can login with new password
- Old password no longer works
```

### Test 6.2: Expired Token
```
1. Wait > 1 hour (or manually edit database)
2. Try using old reset link

Expected:
- Error: "Link reset telah kadaluarsa"
```

### Test 6.3: Invalid Token
```
URL: /pages/auth/reset-password-form.php?token=INVALID

Expected:
- Error: "Token tidak valid"
```

### Test 6.4: Password Mismatch
```
Input:
- New Password: newpass123
- Confirm Password: newpass456

Expected:
- Error: "Password tidak cocok"
```

---

## 7. Test Logout

### Test 7.1: Simple Logout
```
1. Login successfully
2. Click logout button (or call logout.php)

Expected:
- Session destroyed
- Redirect to login page
- Cannot access protected pages
- remember_token cookie cleared
```

---

## 8. Security Tests

### Test 8.1: SQL Injection
```
Try in email field:
- test@example.com' OR '1'='1
- test@example.com'; DROP TABLE users; --

Expected:
- Normal validation/error (query safe)
- No database affected
```

### Test 8.2: XSS Attack
```
Try in username field:
- <script>alert('XSS')</script>
- <img src=x onerror="alert('XSS')">

Expected:
- Input stored safely
- No JavaScript executed
```

### Test 8.3: CSRF Attack
```
Try submitting form from different origin
(requires CSRF token implementation)

Expected:
- Request rejected (after implementation)
```

---

## 9. Database Verification

### Check Registered Users
```sql
SELECT id, username, email, email_verified, created_at FROM users;
```

### Check User Sessions
```php
// After login, check session:
var_dump($_SESSION);

// Should contain:
// - user_id
// - username
// - email
// - avatar
// - logged_in
```

### Check Password Hash
```sql
SELECT username, password FROM users WHERE username = 'testuser123';

-- Password should be hashed (not plaintext)
-- Example: $2y$10$...
```

### Check Token Storage
```sql
SELECT username, reset_token, reset_expires FROM users WHERE id = 1;

-- reset_token should be NULL (until password reset requested)
-- Should be hashed when stored
```

---

## 10. Log Checking

### Location
- Windows: `C:\xampp\apache\logs\error.log`
- Linux: `/var/log/php-errors.log`

### Example Log Entries
```
[23-May-2026 10:30:45] Verification code for test@example.com: ABC123
[23-May-2026 10:35:12] Password reset link for test@example.com: http://localhost/Typify-App/pages/auth/reset-password-form.php?token=...
[23-May-2026 10:40:30] User 1 logged out at 2026-05-23 10:40:30
```

---

## 11. Browser Testing

### Test Different Browsers
- [ ] Chrome
- [ ] Firefox
- [ ] Safari
- [ ] Edge
- [ ] Mobile browsers

### Check Responsive Design
```
Test viewport sizes:
- Desktop: 1920x1080
- Laptop: 1366x768
- Tablet: 768x1024
- Mobile: 375x667
```

### Check Accessibility
```
- Tab navigation
- Keyboard submission (Enter)
- Screen reader compatibility
- Color contrast
```

---

## 12. Performance Testing

### Load Testing
```
Use tools like:
- Apache JMeter
- LoadRunner
- Gatling

Test scenarios:
- Simultaneous registrations
- Simultaneous logins
- Password reset flood
```

### Database Query Performance
```sql
-- Check slow queries
SELECT * FROM users WHERE email = 'test@example.com';
-- Should use index

-- Verify indexes exist
SHOW INDEXES FROM users;
```

---

## Troubleshooting

### Issue: "Database connection failed"
```
Solution:
1. Check MySQL is running
2. Verify database name: "typify"
3. Check includes/db.php credentials
4. Verify database user has permissions
```

### Issue: "Undefined index: verification_code"
```
Solution:
1. Ensure database table has verification_code column
2. Re-import SQL file
3. Check database schema with:
   DESCRIBE users;
```

### Issue: "Email verification code not found"
```
Solution:
1. Check error.log for verification code
2. Make sure code is copied exactly (case-sensitive)
3. Reset and register again
```

### Issue: "Reset token not working"
```
Solution:
1. Verify token in database: reset_expires > NOW()
2. Check reset_expires timestamp
3. Ensure token is not expired (1 hour limit)
```

### Issue: "Login always fails"
```
Solution:
1. Verify email is verified: email_verified = 1
2. Check password hash with: password_verify()
3. Clear PHP cache if applicable
```

---

## Automated Testing (Optional)

### Unit Tests with PHPUnit
```php
class AuthTest extends TestCase {
    public function testValidRegistration() {
        // Test registration
    }
    
    public function testEmailValidation() {
        // Test email validation
    }
    
    public function testPasswordHash() {
        // Test password hashing
    }
}
```

### Integration Tests
```php
class AuthIntegrationTest {
    public function testFullRegistrationFlow() {
        // Register -> Verify -> Login
    }
    
    public function testPasswordResetFlow() {
        // Forgot -> Reset -> Login with new password
    }
}
```

---

## Checklist for Completion

- [ ] Database created and imported
- [ ] Registration working with all validations
- [ ] Email verification working
- [ ] Login working with unverified email check
- [ ] Forgot password working
- [ ] Password reset working with token expiration
- [ ] Logout working
- [ ] SQL injection tests passed
- [ ] Responsive design verified
- [ ] All error messages displaying correctly
- [ ] Session management working
- [ ] Remember me working
- [ ] Logs generated correctly

