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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto 20px;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
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
