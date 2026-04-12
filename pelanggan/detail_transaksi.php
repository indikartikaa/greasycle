<?php
session_start();
include '../koneksi.php';

// 1. PROTEKSI HALAMAN
if (!isset($_SESSION['nama']) || $_SESSION['role'] !== 'pelanggan') {
    header("location: ../index.php");
    exit();
}

// 2. CEK ID TRANSAKSI
if (!isset($_GET['id'])) {
    header("location: dashboard.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$id_user = $_SESSION['id_user'];

// 3. QUERY DATA (Tanpa JOIN karena limbah_kategori sudah dihapus)
$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi = '$id' AND id_user = '$id_user'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='dashboard.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Setoran - Greasycle</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#004030',
                        secondary: '#2d6a4f',
                    }
                }
            }
        }
    </script>
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-[#fcfdfd] p-6">

    <div class="max-w-md mx-auto bg-white p-8 rounded-[30px] shadow-xl border border-gray-100 mt-10">
        <div class="flex items-center gap-3 mb-8">
            <a href="dashboard.php" class="text-gray-400 hover:text-primary transition"><i class="fas fa-arrow-left text-xl"></i></a>
            <h2 class="text-2xl font-bold text-primary italic">Detail Setoran</h2>
        </div>

        <div class="space-y-4">
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-400">ID Transaksi</span>
                <span class="font-bold">#TRX-<?= $data['id_transaksi']; ?></span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-400">Volume</span>
                <span class="font-bold text-primary"><?= $data['volume']; ?> Liter</span>
            </div>
            <div class="flex justify-between border-b pb-2 text-sm">
                <span class="text-gray-400">Alamat Jemput</span>
                <span class="font-semibold text-right max-w-[200px]"><?= $data['alamat_jemput']; ?></span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-400">Status</span>
                <span class="uppercase font-bold text-secondary"><?= $data['status']; ?></span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-400">Catatan</span>
                <span class="italic text-gray-500"><?= $data['catatan'] ?: '-'; ?></span>
            </div>
        </div>

        <div class="mt-8 space-y-3">
            <a href="dashboard.php" class="block w-full text-center bg-primary text-white py-4 rounded-2xl font-bold shadow-lg transition hover:bg-secondary">
                Kembali ke Dashboard
            </a>
        </div>
    </div>

</body>
</html>