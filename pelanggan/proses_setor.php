<?php
session_start();
include '../koneksi.php';

// Supaya kalau error muncul tulisannya, tidak putih polos
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit_setor'])) {
    // Cek apakah session id_user ada
    if (!isset($_SESSION['id_user'])) {
        die("Error: Session kamu hilang. Silakan Login ulang di index.php");
    }

    $id_user        = $_SESSION['id_user'];
    $volume         = mysqli_real_escape_string($conn, $_POST['volume']);
    $alamat_jemput  = mysqli_real_escape_string($conn, $_POST['alamat_jemput']);
    $catatan        = mysqli_real_escape_string($conn, $_POST['catatan']);
    $tgl_request    = date('Y-m-d');
    $status         = 'menunggu';

    // Query INSERT (Urutan kolom harus pas dengan gambar phpMyAdmin kamu)
    $sql = "INSERT INTO transaksi (id_user, volume, alamat_jemput, tgl_request, catatan, status) 
            VALUES ('$id_user', '$volume', '$alamat_jemput', '$tgl_request', '$catatan', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Berhasil! Setoran minyak telah dicatat.'); window.location='dashboard.php';</script>";
    } else {
        // Tampilkan error MySQL kalau gagal
        echo "Gagal Simpan: " . mysqli_error($conn);
    }
} else {
    echo "Tombol konfirmasi belum diklik!";
}
?>