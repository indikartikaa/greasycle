<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $no_telp  = mysqli_real_escape_string($conn, $_POST['no_telp']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role     = mysqli_real_escape_string($conn, $_POST['role']); 

    // 1. Simpan ke tabel users
    $sql = "INSERT INTO users (nama, no_telp, email, password, role) 
            VALUES ('$nama', '$no_telp', '$email', '$password', '$role')";

    if (mysqli_query($conn, $sql)) {
        // Ambil ID yang baru saja dibuat
        $id_terakhir = mysqli_insert_id($conn);

        // 2. JIKA ROLE MITRA, OTOMATIS ISI TABEL MITRA
        if ($role == 'mitra') {
            $sql_mitra = "INSERT INTO mitra (id_user) VALUES ('$id_terakhir')";
            mysqli_query($conn, $sql_mitra);
        }

        echo "<script>alert('Registrasi Berhasil sebagai $role!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} // Tutup if isset post
?>