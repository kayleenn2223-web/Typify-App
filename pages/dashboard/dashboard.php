<?php
// pages/dashboard.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek login - jika belum, tendang ke login page
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: /Typify-App/pages/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Typify App</title>
    <style>
        body { font-family: sans-serif; padding: 40px; background: #f9fafb; }
        .card { max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .btn-logout { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #dc2626; color: white; text-decoration: none; border-radius: 5px; }
        .btn-logout:hover { background: #b91c1c; }
    </style>
</head>
<body>
    <div class="card">
        <h1>🎉 Selamat Datang!</h1>
        <p><strong>Nama:</strong> <?= htmlspecialchars($_SESSION['user_name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['user_email']) ?></p>
        
        <a href="/Typify-App/auth/logout.php" class="btn-logout">Logout</a>
    </div>
</body>
</html>