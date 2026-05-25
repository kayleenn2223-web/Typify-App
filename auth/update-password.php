<?php
require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reset_token = trim($_POST['reset_token'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm-password'] ?? '';

    // Validation
    if (empty($reset_token)) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Token tidak valid'
        ]);
        exit;
    }

    if (empty($password) || empty($confirm_password)) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Password harus diisi'
        ]);
        exit;
    }

    if (strlen($password) < 6) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Password minimal 6 karakter'
        ]);
        exit;
    }

    if ($password !== $confirm_password) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Password tidak cocok'
        ]);
        exit;
    }

    // Get all users with valid reset tokens (check if token exists and not expired)
    $query = "SELECT id, reset_token FROM users WHERE reset_token IS NOT NULL AND reset_expires > NOW()";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Terjadi kesalahan server'
        ]);
        exit;
    }

    if (mysqli_num_rows($result) === 0) {
        http_response_code(404);
        echo json_encode([
            'status' => 'error',
            'message' => 'Link reset telah kadaluarsa'
        ]);
        exit;
    }

    // Find user with matching token
    $user_found = null;
    while ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($reset_token, $user['reset_token'])) {
            $user_found = $user;
            break;
        }
    }

    if (!$user_found) {
        http_response_code(401);
        echo json_encode([
            'status' => 'error',
            'message' => 'Token tidak valid'
        ]);
        exit;
    }

    // Hash new password
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Update password and clear reset token using prepared statement
    $update_query = "UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE id = ?";
    $stmt = mysqli_prepare($conn, $update_query);

    if (!$stmt) {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Terjadi kesalahan saat memperbarui password'
        ]);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "si", $password_hash, $user_found['id']);
    $update_result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($update_result) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Password berhasil diperbarui. Silakan login.',
            'redirect' => '/Typify-App-ellen/pages/auth/login.php'
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Gagal memperbarui password'
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
