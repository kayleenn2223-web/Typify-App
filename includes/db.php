<?php
<<<<<<< HEAD
require_once 'config.php';

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    // Jangan tampilkan detail error $e->getMessage() di produksi demi keamanan
    error_log($e->getMessage());
    header('Content-Type: application/json', true, 500);
    echo json_encode(["error" => "Koneksi database gagal."]);
    exit;
=======
$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'typify';

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die(json_encode(['status' => 'error', 'message' => 'Koneksi gagal: ' . mysqli_connect_error()]));
>>>>>>> 227492b400b34885969d477f5bfe1f7ecf683f10
}
?>