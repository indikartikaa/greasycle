<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $no_telp = mysqli_real_escape_string($conn, $_POST['no_telp']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = 'pelanggan'; // Default role user baru

    // Query Tambah Data (Requirement: CRUD master) [cite: 13, 46]
    $sql = "INSERT INTO users (nama, no_telp, email, password, role) 
            VALUES ('$nama', '$no_telp', '$email', '$password', '$role')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registrasi Berhasil! Silakan Login.'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>