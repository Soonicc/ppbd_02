<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = secure($_POST['username']);
    $password = md5(secure($_POST['password']));
    $nama = secure($_POST['nama']);
    $nisn = secure($_POST['nisn']);
    $alamat = secure($_POST['alamat']);
    $tanggal_lahir = secure($_POST['tanggal_lahir']);
    $email = secure($_POST['email']);
    $telepon = secure($_POST['telepon']);

    // File upload handling
    $foto = $_FILES['foto'];
    $kk = $_FILES['kk'];
    $ijazah = $_FILES['ijazah'];

    $foto_new = 'foto_' . time() . '_' . $foto['name'];
    $kk_new = 'kk_' . time() . '_' . $kk['name'];
    $ijazah_new = 'ijazah_' . time() . '_' . $ijazah['name'];

    move_uploaded_file($foto['tmp_name'], 'uploads/foto/' . $foto_new);
    move_uploaded_file($kk['tmp_name'], 'uploads/kk/' . $kk_new);
    move_uploaded_file($ijazah['tmp_name'], 'uploads/ijazah/' . $ijazah_new);

    // Insert user
    $conn->query("INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'siswa')");
    $user_id = $conn->insert_id;

    // Insert calon_siswa data
    $conn->query("INSERT INTO calon_siswa (user_id, nama, nisn, alamat, tanggal_lahir, email, telepon, foto, kk, ijazah) 
                  VALUES ('$user_id', '$nama', '$nisn', '$alamat', '$tanggal_lahir', '$email', '$telepon', '$foto_new', '$kk_new', '$ijazah_new')");

    echo "Pendaftaran berhasil! Silakan login.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Calon Siswa</title>
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

        .form-container {
            background-color: #fff;
            padding: 50px;
            margin-top: 30px;
            margin-bottom: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
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
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
            margin-right: 20px;

        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 0.9em;
        }

        input[type="text"],
        input[type="password"],
        input[type="date"],
        input[type="email"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1em;
            background-color: #f9f9f9;
            transition: border 0.3s, box-shadow 0.3s;
        }

        input:focus,
        textarea:focus {
            border-color: #9b59b6;
            box-shadow: 0px 0px 5px rgba(155, 89, 182, 0.5);
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #9b59b6;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #8e44ad;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Form Registrasi Calon Siswa</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Nama Lengkap:</label>
                <input type="text" name="nama" required>
            </div>
            <div class="form-group">
                <label>NISN:</label>
                <input type="text" name="nisn" required>
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <textarea name="alamat" required></textarea>
            </div>
            <div class="form-group">
                <label>Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Telepon:</label>
                <input type="text" name="telepon" required>
            </div>
            <div class="form-group">
                <label>Foto:</label>
                <input type="file" name="foto" required>
            </div>
            <div class="form-group">
                <label>File KK:</label>
                <input type="file" name="kk" required>
            </div>
            <div class="form-group">
                <label>Ijazah:</label>
                <input type="file" name="ijazah" required>
            </div>
            <button type="submit">Daftar</button>
        </form>
    </div>
</body>

</html>