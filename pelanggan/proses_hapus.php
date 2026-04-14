<?php
session_start();
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id_user = $_SESSION['id_user']; // Keamanan: Pastikan hanya pemilik yang bisa hapus

    // Hapus hanya jika status masih menunggu
    $query = "DELETE FROM transaksi WHERE id_transaksi = '$id' AND id_user = '$id_user' AND status = 'menunggu'";
    
    if (mysqli_query($conn, $query)) {
        header("location: dashboard.php?pesan=hapus_berhasil");
    } else {
        echo "Gagal menghapus: " . mysqli_error($conn);
    }
}
?>