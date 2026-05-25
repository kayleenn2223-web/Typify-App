<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']) ? 1 : 0;

    // Validation
    if (empty($email) || empty($password)) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Email dan password harus diisi'
        ]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Format email tidak valid'
        ]);
        exit;
    }

    // Check user in database using prepared statement
    $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $query);
    
    if (!$stmt) {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Terjadi kesalahan server'
        ]);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (!$result || mysqli_num_rows($result) === 0) {
        http_response_code(401);
        echo json_encode([
            'status' => 'error',
            'message' => 'Email atau password salah'
        ]);
        exit;
    }

    $user = mysqli_fetch_assoc($result);

    // Verify password
    if (!password_verify($password, $user['password'])) {
        http_response_code(401);
        echo json_encode([
            'status' => 'error',
            'message' => 'Email atau password salah'
        ]);
        exit;
    }

    // Set session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['avatar'] = $user['avatar'] ?? 'default.jpg';
    $_SESSION['logged_in'] = true;

    // Set remember me cookie
    if ($remember) {
        $token = bin2hex(random_bytes(32));
        setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/', '', false, true);
        
        // Store token in database using prepared statement
        $token_hash = password_hash($token, PASSWORD_BCRYPT);
        $update_query = "UPDATE users SET remember_token = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $update_query);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $token_hash, $user['id']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    // Update last login
    $last_login_query = "UPDATE users SET last_login = NOW() WHERE id = ?";
    $stmt = mysqli_prepare($conn, $last_login_query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user['id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Login berhasil',
        'redirect' => '/Typify-App-ellen/'
    ]);
} else {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Method tidak diizinkan'
    ]);
}
?>