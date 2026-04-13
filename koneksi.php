<?php
$host = "192.168.110.115";
$user = "root";
$pass = "";
$db   = "greasycle"; // Nama database yang kamu buat tadi

$conn = mysqli_connect("192.168.110.115", "root", "", "greasycle");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>