<?php
session_start();
include '../koneksi.php';

// Supaya kalau error muncul tulisannya (Penting buat demo di depan dosen)
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit_setor'])) {
    // 1. Cek keamanan session
    if (!isset($_SESSION['id_user'])) {
        echo "<script>alert('Sesi habis, silakan login ulang'); window.location='../index.php';</script>";
        exit();
    }

    // 2. Ambil data dari Form transaksi.php
    $id_user        = $_SESSION['id_user'];
    $volume         = mysqli_real_escape_string($conn, $_POST['volume']);
    $alamat_jemput  = mysqli_real_escape_string($conn, $_POST['alamat_jemput']);
    $catatan        = mysqli_real_escape_string($conn, $_POST['catatan']);
    $tgl_request    = date('Y-m-d');
    $status         = 'menunggu';

    // 3. Query INSERT (Sudah tanpa id_kategori sesuai update database kita tadi)
    // Pastikan nama kolom 'alamat_jemput' di tabel transaksi sudah sesuai di phpMyAdmin
    $sql = "INSERT INTO transaksi (id_user, volume, alamat_jemput, tgl_request, catatan, status) 
            VALUES ('$id_user', '$volume', '$alamat_jemput', '$tgl_request', '$catatan', '$status')";

    if (mysqli_query($conn, $sql)) {
        // Jika berhasil, langsung lempar ke dashboard
        echo "<script>
                alert('Berhasil! Setoran minyak telah dicatat. Tim Greasycle akan segera menuju lokasi.'); 
                window.location='dashboard.php';
              </script>";
    } else {
        // Jika gagal, tampilkan pesan error yang jelas untuk debugging
        echo "<h3>Waduh, ada masalah teknis:</h3>";
        echo "Error: " . mysqli_error($conn);
        echo "<br><br><a href='transaksi.php'>Kembali ke Form</a>";
    }
} else {
    // Jika mencoba akses file ini tanpa lewat form
    header("location: transaksi.php");
    exit();
}
?>