<?php
require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Parse JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if ($input === null) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Format request tidak valid'
        ]);
        exit;
    }

    $email = trim($input['email'] ?? '');

    // Validation
    if (empty($email)) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Email harus diisi'
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

    // Check if email exists using prepared statement
    $query = "SELECT id FROM users WHERE email = ? LIMIT 1";
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
        // For security, return same message as if email exists
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'message' => 'Jika email terdaftar, link reset akan dikirim'
        ]);
        exit;
    }

    $user = mysqli_fetch_assoc($result);

    // Generate reset token
    $reset_token = bin2hex(random_bytes(32));
    $token_hash = password_hash($reset_token, PASSWORD_BCRYPT);
    $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // Update user with reset token using prepared statement
    $update_query = "UPDATE users SET reset_token = ?, reset_expires = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $update_query);
    
    if (!$stmt) {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Terjadi kesalahan saat memperbarui data'
        ]);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "ssi", $token_hash, $expires_at, $user['id']);
    $update_result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if (!$update_result) {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Gagal menyimpan token reset'
        ]);
        exit;
    }

    // Send reset email (implement actual email sending)
    // For now, we'll just log it
    $reset_link = "http://localhost/Typify-App-ellen/pages/auth/reset-password-form.php?token=" . urlencode($reset_token);
    error_log("Password reset link for $email: $reset_link");

    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'message' => 'Jika email terdaftar, link reset akan dikirim'
    ]);
} else {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Method tidak diizinkan'
    ]);
}
?>
