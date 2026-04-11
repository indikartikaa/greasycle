<?php
session_start(); // Memulai session untuk menyimpan data login 
include 'koneksi.php'; // Menghubungkan ke database MySQL 

if (isset($_POST['login'])) {
    // Mengambil data dari form di index 
    // mysqli_real_escape_string untuk mencegah SQL Injection (poin plus UTS)
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query mencari data di tabel users sesuai kolom di databasemu
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $data = mysqli_fetch_assoc($query);
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        // Jika data ditemukan, simpan informasi ke session 
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = $data['role'];

        // Redirect sesuai role (Requirement: User single/multi) 
        if ($data['role'] == "admin") {
            header("location:admin/dashboard.php");
        } else {
            header("location:pelanggan/dashboard.php");
        }
    } else {
        // Jika gagal, tampilkan alert JS (Requirement: Interaktivitas JS) [cite: 16]
        echo "<script>alert('Login Gagal! Email atau Password salah.'); window.location='index.php';</script>";
    }
}
?>