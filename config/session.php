<?php
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_samesite', 'Lax');
    session_start();
}

// Fungsi helper untuk cek login
function isLoggedIn() {
    return isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0;
}

// Fungsi untuk require login
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /Typify-App/pages/login.php');
        exit();
    }
}

// Fungsi untuk redirect jika sudah login
function redirectIfLoggedIn() {
    if (isLoggedIn()) {
        header('Location: /Typify-App/pages/dashboard.php');
        exit();
    }
}
?>