<?php
$host = "192.168.110.115";
$user = "root";
$pass = "";
$db   = "greasycle"; // Nama database yang kamu buat tadi

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>