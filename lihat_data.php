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
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #555;
            margin: 10px 0;
        }

        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-back:hover {
            background-color: #45a049;
        }

        .error {
            color: #D8000C;
            background-color: #FFBABA;
            padding: 10px;
            border-radius: 4px;
        }
    </style>
    </head>
<body>

<div class="container">
    <?php if ($data_found): ?>
        <h2>Data yang Telah Dimasukkan</h2>
        <p><strong>ID:</strong> <?php echo $row["id"]; ?></p>
        <p><strong>Nama:</strong> <?php echo $row["nama"]; ?></p>
        <p><strong>NIM:</strong> <?php echo $row["nim"]; ?></p>
        <p><strong>Kelas:</strong> <?php echo $row["kelas"]; ?></p>
        <p><strong>Email:</strong> <?php echo $row["email"]; ?></p>
        <p><strong>Gender:</strong> <?php echo $row["gender"]; ?></p>
        <p><strong>Saran:</strong> <?php echo $row["saran"]; ?></p>
        <a href="form_input.php" class="btn-back">Kembali</a>
    <?php else: ?>
        <div class="error">Data tidak ditemukan atau ID tidak diberikan.</div>
        <a href="form_input.php" class="btn-back">Kembali</a>
    <?php endif; ?>
</div>

</body>
</html>
