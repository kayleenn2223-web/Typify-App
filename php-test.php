<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect('localhost', 'root', '');
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
echo "Koneksi berhasil!";
mysqli_close($conn);

echo "PHP version: " . phpversion();
echo "\nExtensions loaded: ";
echo extension_loaded('mysqli') ? "✅ mysqli" : "❌ mysqli";
?>
