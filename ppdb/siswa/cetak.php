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
    <title>Bukti Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            padding: 20px;
            margin: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #000000;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 3px solid #000000;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
        }

        @media print {

            body,
            .container {
                box-shadow: none;
                border: none;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <h2>Bukti Pendaftaran</h2>
        <table>
            <tr>
                <th>Nama</th>
                <td><?php echo $siswa['nama']; ?></td>
            </tr>
            <tr>
                <th>NISN</th>
                <td><?php echo $siswa['nisn']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $siswa['email']; ?></td>
            </tr>
            <tr>
                <th>Status Verifikasi</th>
                <td><?php echo $siswa['status_verifikasi']; ?></td>
            </tr>
            <tr>
                <th>Status Kelulusan</th>
                <td><?php echo $siswa['status_kelulusan']; ?></td>
            </tr>
        </table>
    </div>
</body>

</html>