<?php include '../../includes/header.php'; ?>

<div class="page-center fade-in">
    <div class="card auth-card">
        <h1>Lupa Password?</h1>
        <p class="subtitle">Kami akan membantu Anda mengatur ulang password</p>

        <form id="forgotPasswordForm" method="POST" action="../../auth/reset-password.php">
            <p style="font-size: 13px; color: rgba(31, 41, 55, 0.7); margin-bottom: 20px;">
                Masukkan email yang terdaftar di akun Anda. Kami akan mengirimkan link untuk mengatur ulang password.
            </p>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email Anda" required>
                <small class="error-message"></small>
            </div>

            <button type="submit" class="primary-btn">Kirim Link Reset</button>
        </form>

        <p style="text-align: center; font-size: 13px; margin-top: 20px; color: rgba(31, 41, 55, 0.7);">
            <a href="/Typify-App-ellen/pages/auth/login.php" class="auth-switch-link">← Kembali ke Login</a>
        </p>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
