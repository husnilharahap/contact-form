<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "kontak_db";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Memeriksa apakah ID diberikan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data yang baru saja dimasukkan berdasarkan ID
    $sql = "SELECT id, nama, nim, kelas, email, gender, saran FROM kontak WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Menampilkan data
        $row = $result->fetch_assoc();
        $data_found = true;
    } else {
        $data_found = false;
    }

    $stmt->close();
} else {
    $data_found = false;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>