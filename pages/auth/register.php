<?php include '../../includes/header.php'; ?>

<div class="page-center fade-in">
    <div class="card auth-card">
        <h1>Buat Akun</h1>
        <p class="subtitle">Bergabunglah dengan komunitas Typify</p>

        <form method="POST" action="/Typify-App-ellen/auth/register-process.php">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Pilih username" required>
                <small class="error-message"></small>
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email" required>
                <small class="error-message"></small>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Buat password (min 6 karakter)" required>
                <small class="error-message"></small>
            </div>

            <div class="input-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="confirm-password" placeholder="Ketik ulang password" required>
                <small class="error-message"></small>
            </div>

            <label style="display: flex; align-items: flex-start; gap: 8px; font-size: 12px; margin-bottom: 16px;">
                <input type="checkbox" name="agree_terms" required style="margin-top: 2px;">
                <span>Saya setuju dengan <a href="#" style="color: var(--primary-color); text-decoration: none;">Syarat & Ketentuan</a> dan <a href="#" style="color: var(--primary-color); text-decoration: none;">Kebijakan Privasi</a></span>
            </label>

            <button type="submit" class="primary-btn">Daftar</button>
        </form>

        <div class="auth-divider">atau</div>

        <div class="social-auth">
            <button type="button" class="social-btn" title="Daftar dengan Google">🔵</button>
            <button type="button" class="social-btn" title="Daftar dengan Facebook">👤</button>
            <button type="button" class="social-btn" title="Daftar dengan GitHub">⭐</button>
        </div>

        <p style="text-align: center; font-size: 13px; margin-top: 20px; color: rgba(31, 41, 55, 0.7);">
            Sudah punya akun? <a href="/Typify-App-ellen/pages/auth/login.php" class="auth-switch-link">Login di sini</a>
        </p>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>