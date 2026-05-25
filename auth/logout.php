<?php
// auth/logout.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hapus semua data session
$_SESSION = array();

// Hapus cookie session jika ada
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Destroy session
session_destroy();

// Redirect ke login
header('Location: /Typify-App/pages/login.php');
exit();
?>