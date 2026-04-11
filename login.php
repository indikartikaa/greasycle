<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query mencari data user
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $data = mysqli_fetch_assoc($query);
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        // Simpan data penting ke SESSION
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = $data['role'];

        // LOGIKA PENGALIHAN BERDASARKAN ROLE
        if ($data['role'] == "admin") {
            header("location:admin/dashboard.php");
        } else if ($data['role'] == "mitra") {
            header("location:mitra/dashboard.php");
        } else if ($data['role'] == "usaha") {
            header("location:pelanggan/dashboard_usaha.php"); // Atau folder khusus usaha jika ada
        } else {
            header("location:pelanggan/dashboard.php");
        }
        exit(); // Wajib ada exit setelah header
    } else {
        echo "<script>alert('Login Gagal! Email atau Password salah.'); window.location='index.php';</script>";
    }
}
?>