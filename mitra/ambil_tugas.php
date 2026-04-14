<?php
session_start();
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];
    $id_mitra     = $_SESSION['id_user']; 
    $tgl_sekarang = date('Y-m-d H:i:s');

    $sql_update_trx = "UPDATE transaksi SET status = 'dijemput' WHERE id_transaksi = '$id_transaksi'";
    
    $sql_penjemputan = "INSERT INTO penjemputan (id_transaksi, id_mitra, status, created_at) 
                        VALUES ('$id_transaksi', '$id_mitra', 'proses', '$tgl_sekarang')";

    if (mysqli_query($conn, $sql_update_trx) && mysqli_query($conn, $sql_penjemputan)) {
        echo "<script>alert('Tugas diambil! Segera meluncur ke lokasi.'); window.location='dashboard.php';</script>";
    } else {
        echo "Error MySQL: " . mysqli_error($conn);
    }
} else {
    header("location: dashboard.php");
}
?>