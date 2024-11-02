<?php
include '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$siswa = $conn->query("SELECT * FROM calon_siswa WHERE user_id = $user_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            background-color: #f44336;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #d32f2f;
        }

        .dashboard-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            text-align: center;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .status {
            font-size: 1.1em;
            margin: 10px 0;
            color: #555;
        }

        .info-section {
            margin-top: 20px;
            text-align: left;
            font-size: 1em;
            color: #555;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .info-section p {
            margin: 10px 0;
        }

        .info-section strong {
            color: #333;
        }

        a.cetak-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4071e3;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        a.cetak-button:hover {
            background-color: #8e44ad;
        }
    </style>
</head>

<body>
    <a href="../login.php" class="back-button">Kembali ke Halaman Login</a>

    <div class="dashboard-container">
        <h2>Selamat datang, <?php echo $siswa['nama']; ?>!</h2>
        <div class="status">Status Verifikasi: <?php echo $siswa['status_verifikasi']; ?></div>
        <div class="status">Status Kelulusan: <?php echo $siswa['status_kelulusan']; ?></div>

        <div class="info-section">
            <h3>Informasi Pendaftaran</h3>
            <p><strong>Nama:</strong> <?php echo $siswa['nama']; ?></p>
            <p><strong>NISN:</strong> <?php echo $siswa['nisn']; ?></p>
            <p><strong>Email:</strong> <?php echo $siswa['email']; ?></p>
        </div>

        <a href="cetak.php" target="_blank" class="cetak-button">Cetak Bukti Pendaftaran</a>
    </div>
</body>

</html>