<?php
// Test endpoint untuk debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/includes/db.php';

echo "<pre>";
echo "🔍 Debug Info:\n";
echo "================================\n";

// Check database connection
if ($conn) {
    echo "✅ Database connected\n";
} else {
    echo "❌ Database NOT connected: " . mysqli_connect_error() . "\n";
    exit;
}

// Check if table exists
$result = mysqli_query($conn, "SHOW TABLES LIKE 'users'");
if (mysqli_num_rows($result) > 0) {
    echo "✅ Users table exists\n";
} else {
    echo "❌ Users table does NOT exist\n";
}

// Check table structure
echo "\nTable Structure:\n";
$result = mysqli_query($conn, "DESCRIBE users");
while ($row = mysqli_fetch_assoc($result)) {
    echo "  - " . $row['Field'] . " (" . $row['Type'] . ")\n";
}

echo "\n================================\n";
echo "Test: Insert dummy user\n";

$test_username = "test_" . time();
$test_email = "test_" . time() . "@example.com";
$test_password = password_hash("test123456", PASSWORD_BCRYPT);
$test_code = "ABC123";

$insert_query = "INSERT INTO users (username, email, password, verification_code, email_verified, created_at) 
                 VALUES (?, ?, ?, ?, 0, NOW())";
$stmt = mysqli_prepare($conn, $insert_query);

if (!$stmt) {
    echo "❌ Prepare failed: " . mysqli_error($conn) . "\n";
} else {
    mysqli_stmt_bind_param($stmt, "ssss", $test_username, $test_email, $test_password, $test_code);
    if (mysqli_stmt_execute($stmt)) {
        echo "✅ Test user inserted successfully\n";
        echo "   Username: $test_username\n";
        echo "   Email: $test_email\n";
    } else {
        echo "❌ Execute failed: " . mysqli_stmt_error($stmt) . "\n";
    }
    mysqli_stmt_close($stmt);
}

// Show all users
echo "\nAll Users in Database:\n";
$result = mysqli_query($conn, "SELECT id, username, email, email_verified FROM users");
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $verified = $row['email_verified'] ? '✅' : '❌';
        echo "  [$verified] #{$row['id']} - {$row['username']} ({$row['email']})\n";
    }
} else {
    echo "  (No users)\n";
}

echo "\n================================\n";
echo "</pre>";
?>
