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

// Membuat tabel kontak
$sql_create_table = "CREATE TABLE IF NOT EXISTS kontak (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    nim VARCHAR(255) NOT NULL,
    kelas VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    saran TEXT NOT NULL
)";
$conn->query($sql_create_table);

// Memproses form jika data dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $kelas = $_POST['kelas'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $saran = $_POST['saran'];

    // Menyimpan data ke database
    $stmt = $conn->prepare("INSERT INTO kontak (nama, nim, kelas, email, gender, saran) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nama, $nim, $kelas, $email, $gender, $saran);

    if ($stmt->execute()) {
        // Redirect ke halaman lihat data dengan parameter ID terakhir yang dimasukkan
        $last_id = $stmt->insert_id;
        header("Location: lihat_data.php?id=" . $last_id);
        exit();
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    // Menutup statement
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Form</title>
</head>
<body>
    <h2>Kontak Form</h2>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="nama" required>
        
        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" required>

        <label for="class">Kelas:</label>
        <input type="text" id="class" name="kelas" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label>Gender:</label>
        <input type="radio" id=Laki-Laki name="gender" value="Laki-Laki" required>
        <label for="laki-laki">Laki-laki</label>
        <input type="radio" id="perempuan" name="gender" value="perempuan">
        <label for="perempuan">Perempuan</label>

        <label for="saran">Saran:</label>
        <textarea id="saran" name="saran" rows="4" required></textarea>

        <input type="submit" value="Kirim">
    </form>

</body>
</html>
