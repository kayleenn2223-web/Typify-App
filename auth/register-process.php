<?php
// Set headers BEFORE any output
header('Content-Type: application/json');

// Disable error display in output, use error logging instead
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

session_start();
require_once __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm-password'] ?? '';

    // Validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Semua field harus diisi'
        ]);
        exit;
    }

    // Validate username
    if (strlen($username) < 3 || strlen($username) > 20) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Username harus 3-20 karakter'
        ]);
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Format email tidak valid'
        ]);
        exit;
    }

    // Validate password
    if (strlen($password) < 6) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Password minimal 6 karakter'
        ]);
        exit;
    }

    // Check password match
    if ($password !== $confirm_password) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Password tidak cocok'
        ]);
        exit;
    }

    // Check if username exists using prepared statement
    $check_username_query = "SELECT id FROM users WHERE username = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $check_username_query);
    
    if (!$stmt) {
        error_log("MySQL Prepare Error (username check): " . mysqli_error($conn));
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Terjadi kesalahan server'
        ]);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    if (!mysqli_stmt_execute($stmt)) {
        error_log("MySQL Execute Error (username check): " . mysqli_stmt_error($stmt));
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Terjadi kesalahan server'
        ]);
        exit;
    }
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        http_response_code(409);
        echo json_encode([
            'status' => 'error',
            'message' => 'Username sudah digunakan'
        ]);
        exit;
    }

    // Check if email exists using prepared statement
    $check_email_query = "SELECT id FROM users WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $check_email_query);
    
    if (!$stmt) {
        error_log("MySQL Prepare Error (email check): " . mysqli_error($conn));
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Terjadi kesalahan server'
        ]);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    if (!mysqli_stmt_execute($stmt)) {
        error_log("MySQL Execute Error (email check): " . mysqli_stmt_error($stmt));
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Terjadi kesalahan server'
        ]);
        exit;
    }
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        http_response_code(409);
        echo json_encode([
            'status' => 'error',
            'message' => 'Email sudah terdaftar'
        ]);
        exit;
    }

    // Hash password
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Insert user using prepared statement (email auto-verified)
    $insert_query = "INSERT INTO users (username, email, password, email_verified, created_at) 
                     VALUES (?, ?, ?, 1, NOW())";
    $stmt = mysqli_prepare($conn, $insert_query);

    if (!$stmt) {
        error_log("MySQL Prepare Error (insert): " . mysqli_error($conn));
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Terjadi kesalahan saat registrasi'
        ]);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password_hash);
    $insert_result = mysqli_stmt_execute($stmt);
    
    if (!$insert_result) {
        error_log("MySQL Execute Error (insert): " . mysqli_stmt_error($stmt));
    }
    
    mysqli_stmt_close($stmt);

    if ($insert_result) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Registrasi berhasil! Silakan login dengan akun Anda.',
            'redirect' => '/Typify-App-ellen/pages/auth/login.php'
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Terjadi kesalahan saat registrasi'
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Method tidak diizinkan'
    ]);
}
?>