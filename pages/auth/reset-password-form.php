<?php include '../../includes/header.php'; ?>

<div class="page-center fade-in">
    <div class="card auth-card">
        <h1>Atur Ulang Password</h1>
        <p class="subtitle">Masukkan password baru Anda</p>

        <form id="resetPasswordForm" method="POST" action="../../auth/update-password.php">
            <?php
            $token = $_GET['token'] ?? '';
            if (empty($token)) {
                echo '<p style="color: #ef4444; text-align: center; margin-bottom: 20px;">❌ Token tidak valid</p>';
            }
            ?>
            <input type="hidden" name="reset_token" value="<?php echo htmlspecialchars($token); ?>">

            <div class="input-group">
                <label>Password Baru</label>
                <input type="password" name="password" placeholder="Masukkan password baru (min 6 karakter)" required>
                <small class="error-message"></small>
            </div>

            <div class="input-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="confirm-password" placeholder="Ketik ulang password" required>
                <small class="error-message"></small>
            </div>

            <button type="submit" class="primary-btn" <?php echo empty($token) ? 'disabled' : ''; ?>>
                Perbarui Password
            </button>
        </form>

        <p style="text-align: center; font-size: 13px; margin-top: 20px; color: rgba(31, 41, 55, 0.7);">
            <a href="/Typify-App-ellen/pages/auth/login.php" class="auth-switch-link">← Kembali ke Login</a>
        </p>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
