<?php
include '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($_GET['action'] == 'verify') {
        $conn->query("UPDATE calon_siswa SET status_verifikasi = 'Verified' WHERE id = $id");
    } elseif ($_GET['action'] == 'reject') {
        $conn->query("UPDATE calon_siswa SET status_verifikasi = 'Rejected' WHERE id = $id");
    } elseif ($_GET['action'] == 'delete') {
        $conn->query("DELETE FROM calon_siswa WHERE id = $id");
    }
    header("Location: manage_siswa.php");
}

$siswa = $conn->query("SELECT * FROM calon_siswa");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manajemen Data Siswa</title>
    <style>
        img {
            width: 100px;
            height: auto;
            margin: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Data Siswa</h2>
    <table>
        <tr>
            <th>Nama</th>
            <th>NISN</th>
            <th>Email</th>
            <th>Status Verifikasi</th>
            <th>Foto</th>
            <th>File KK</th>
            <th>File Ijazah</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $siswa->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['nisn']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['status_verifikasi']; ?></td>
            <td>
                <?php if ($row['foto']): ?>
                    <img src="../uploads/foto/<?php echo $row['foto']; ?>" alt="Foto Siswa">
                <?php else: ?>
                    <p>Tidak ada foto</p>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($row['kk']): ?>
                    <a href="../uploads/kk/<?php echo $row['kk']; ?>" target="_blank">Lihat KK</a>
                <?php else: ?>
                    <p>Tidak ada KK</p>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($row['ijazah']): ?>
                    <a href="../uploads/ijazah/<?php echo $row['ijazah']; ?>" target="_blank">Lihat Ijazah</a>
                <?php else: ?>
                    <p>Tidak ada ijazah</p>
                <?php endif; ?>
            </td>
            <td>
                <a href="?action=verify&id=<?php echo $row['id']; ?>">Verifikasi</a> |
                <a href="?action=reject&id=<?php echo $row['id']; ?>">Tolak</a> |
                <a href="?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
