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
