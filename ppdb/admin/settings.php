<?php
include '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_sekolah = secure($_POST['nama_sekolah']);
    $alamat_sekolah = secure($_POST['alamat_sekolah']);
    $telepon = secure($_POST['telepon']);
    $email = secure($_POST['email']);
    $pembukaan_pendaftaran = secure($_POST['pembukaan_pendaftaran']);
    $penutupan_pendaftaran = secure($_POST['penutupan_pendaftaran']);

    $conn->query("UPDATE pengaturan SET 
        nama_sekolah = '$nama_sekolah', 
        alamat_sekolah = '$alamat_sekolah',
        telepon = '$telepon', 
        email = '$email', 
        pembukaan_pendaftaran = '$pembukaan_pendaftaran',
        penutupan_pendaftaran = '$penutupan_pendaftaran' 
        WHERE id = 1");

    echo "Pengaturan berhasil diperbarui!";
}

$settings = $conn->query("SELECT * FROM pengaturan WHERE id = 1")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pengaturan Sekolah</title>
</head>
<body>
    <h2>Pengaturan Sekolah</h2>
    <form action="" method="post">
        <label>Nama Sekolah:</label>
        <input type="text" name="nama_sekolah" value="<?php echo $settings['nama_sekolah']; ?>" required><br>
        
        <label>Alamat Sekolah:</label>
        <textarea name="alamat_sekolah" required><?php echo $settings['alamat_sekolah']; ?></textarea><br>
        
        <label>Telepon:</label>
        <input type="text" name="telepon" value="<?php echo $settings['telepon']; ?>" required><br>
        
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $settings['email']; ?>" required><br>
        
        <label>Pembukaan Pendaftaran:</label>
        <input type="date" name="pembukaan_pendaftaran" value="<?php echo $settings['pembukaan_pendaftaran']; ?>" required><br>
        
        <label>Penutupan Pendaftaran:</label>
        <input type="date" name="penutupan_pendaftaran" value="<?php echo $settings['penutupan_pendaftaran']; ?>" required><br>
        
        <button type="submit">Perbarui Pengaturan</button>
    </form>
</body>
</html>
