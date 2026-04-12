<?php
session_start();
include '../koneksi.php';

// Pastikan hanya user login yang bisa akses
if (!isset($_SESSION['id_user'])) {
    header("location: ../index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];
    $id_user = $_SESSION['id_user'];

    // Keamanan: Pastikan transaksi ini milik user yang login 
    // dan statusnya masih 'menunggu' (agar tidak menghapus data yang sudah selesai)
    $query = "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi' AND id_user = '$id_user' AND status = 'menunggu'";
    
    if (mysqli_query($conn, $query)) {
        // Jika berhasil, beri alert dan balik ke dashboard
        echo "<script>
                alert('Laporan setoran berhasil dihapus!');
                window.location='dashboard.php';
              </script>";
    } else {
        // Jika gagal karena masalah database
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
} else {
    // Jika akses file tanpa kirim ID
    header("location: dashboard.php");
}
?>