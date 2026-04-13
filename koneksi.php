<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "greasycle"; 
$conn = mysqli_connect("192.168.110.115","root","", "greasycle");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>