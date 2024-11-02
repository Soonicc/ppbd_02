<?php
include '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard Admin</title>
</head>
<body>
    <h2>Selamat datang, Admin!</h2>
    <ul>
        <li><a href="manage_siswa.php">Kelola Data Siswa</a></li>
        <li><a href="settings.php">Pengaturan Sekolah</a></li>
        <li><a href="add_admin.php">Tambah Admin Baru</a></li> 
    </ul>
</body>
</html>
