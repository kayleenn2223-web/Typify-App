<?php
// 1. Start Session
session_start();

// Jika sudah login, langsung ke dashboard (Cegah Loop)
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

// 2. KONEKSI DATABASE LANGSUNG DISINI
// Supaya tidak ada error "file not found"
$host = "localhost";
$user = "root";
$pass = "";       // Biarkan kosong jika pakai XAMPP default
$db   = "typify_app"; // Pastikan nama database ini SAMA persis di phpMyAdmin

$conn = new mysqli($host, $user, $pass, $db);

// Cek Koneksi (Penting!)
if ($conn->connect_error) {
    // Jika error muncul di sini, BERARTI:
    // 1. MySQL belum distart di XAMPP
    // 2. Database 'typify_app' belum dibuat di phpMyAdmin
    die("❌ GAGAL KONEKSI DATABASE: " . $conn->connect_error . "<br><br>
         <b>CARA MEMBENERIN:</b><br>
         1. Buka XAMPP Control Panel -> Klik Start pada MySQL.<br>
         2. Buka phpMyAdmin (http://localhost/phpmyadmin).<br>
         3. Klik 'New' -> Buat database bernama: <b>typify_app</b>.");
}

// 3. LOGIKA LOGIN
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek apakah form kosong
    if (empty($email) || empty($password)) {
        $error_msg = "Email dan password harus diisi!";
    } else {
        // Query ambil data user
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Cek Password (Verifikasi Hash)
            if (password_verify($password, $user['password'])) {
                // JIKA BENAR: Simpan Session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                
                // Redirect ke dashboard
                header('Location: dashboard.php');
                exit();
            } else {
                $error_msg = "Password salah!";
            }
        } else {
            $error_msg = "Email tidak ditemukan!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Typify App</title>
    
    <!-- ✅ CSS UTAMA (Path naik 1 folder karena login.php ada di pages/) -->
    <link rel="stylesheet" href="../css/components.css">
    
    <!-- Jika ada file CSS lain, tambahkan dengan pola yang sama -->
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
</head>
<body>
    <div class="box">
        <h2>Login</h2>
        <?php if($error_msg): ?>
            <div class="error"><?= $error_msg ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>