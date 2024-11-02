<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'ppdb';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

function secure($data) {
    global $conn;
    return htmlspecialchars(mysqli_real_escape_string($conn, $data));
}
?>
