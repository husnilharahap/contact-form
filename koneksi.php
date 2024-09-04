<?php
$host = 'localhost';  // Nama host, biasanya localhost
$user = 'root';       // Username database
$password = '';       // Password database
$database = 'kontak_db';  // Nama database

// Membuat koneksi ke MySQL
$koneksi = mysqli_connect($host, $user, $password, $database);

// Memeriksa apakah koneksi berhasil
if (!$koneksi) {
    die('Koneksi gagal: ' . mysqli_connect_error());
} else {
    echo 'Koneksi berhasil';
}
?>
