<?php
include '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = secure($_POST['username']);
    $password = md5(secure($_POST['password'])); // Simpan password dalam bentuk hash

    // Cek apakah username sudah ada
    $result = $conn->query("SELECT * FROM users WHERE username = '$username'");
    if ($result->num_rows > 0) {
        echo "Username sudah ada! Silakan pilih yang lain.";
    } else {
        // Tambahkan admin baru
        $conn->query("INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'admin')");
        echo "Admin baru berhasil ditambahkan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Admin</title>
</head>
<body>
    <h2>Tambah Admin Baru</h2>
    <form action="" method="post">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br>
        
        <button type="submit">Tambah Admin</button>
    </form>
</body>
</html>
