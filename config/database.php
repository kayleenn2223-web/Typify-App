<?php
// config/database.php

// 1. SETTING DATABASE (Sesuai XAMPP/Laragon kamu)
$host = 'localhost';
$user = 'root';
$pass = ''; // Kalo ada password, isi sini. Kalo kosong, biarkan ''
$dbname = 'typify_app'; // PASTIKAN INI BENAR NAMANYA

// 2. SAMBUNG
$conn = new mysqli($host, $user, $pass, $dbname);

// 3. CEK KONEKSI
if ($conn->connect_error) {
    // INI AKAN MATI DI SINI JIKA ERROR, BIKIN KAMU TAU PENYEBABNYA
    die("❌ KONEKSI GAGAL! <br>
         Database: <b>$dbname</b><br>
         Pesan Error: " . $conn->connect_error . "<br><br>
         <i>Cek: Apakah nama database 'typify_app' sudah dibuat di phpMyAdmin?</i>");
}
?>