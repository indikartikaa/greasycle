<?php
session_start();
include '../koneksi.php';

// 1. PROTEKSI HALAMAN
if (!isset($_SESSION['nama']) || $_SESSION['role'] !== 'pelanggan') {
    header("location: ../index.php");
    exit();
}

// 2. AMBIL DATA USER
$id_user = $_SESSION['id_user'];
$nama_user = $_SESSION['nama'];

// 3. HITUNG RINGKASAN DATA
// Perbaikan: Pakai 'selesai' huruf kecil sesuai database
$query_vol = mysqli_query($conn, "SELECT SUM(volume) as total FROM transaksi WHERE id_user = '$id_user' AND status = 'selesai'");
$data_vol = mysqli_fetch_assoc($query_vol);
$total_volume = $data_vol['total'] ?? 0;

// Hitung Saldo
$saldo = $total_volume * 5000;

// Cek Penjemputan Aktif (status selain 'selesai')
$query_aktif = mysqli_query($conn, "SELECT status FROM transaksi WHERE id_user = '$id_user' AND status != 'selesai' LIMIT 1");
$status_aktif = mysqli_num_rows($query_aktif) > 0 ? "Ada Penjemputan" : "Tidak Ada Penjemputan";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - Greasycle</title>
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
                        accent: '#d1e7e0',
                        lightGreen: '#f0f7f4',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .fade-in { animation: fadeIn 0.5s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-[#fcfdfd] text-[#333]">

    <nav class="bg-white shadow-sm py-4 px-[8%] flex justify-between items-center sticky top-0 z-50 border-b border-gray-100">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                <i class="fas fa-recycle text-white text-xs"></i>
            </div>
            <h1 class="text-xl font-bold text-primary tracking-tight">Greasycle</h1>
        </div>
        <div class="flex items-center gap-6 text-sm">
            <div class="hidden md:flex items-center gap-2 border-r pr-6 border-gray-200">
                <div class="w-8 h-8 bg-accent rounded-full flex items-center justify-center text-primary font-bold uppercase">
                    <?= substr($nama_user, 0, 1); ?>
                </div>
                <span class="font-semibold text-gray-700 italic"><?= $nama_user; ?></span>
            </div>
            <a href="../logout.php" class="text-red-500 font-bold hover:text-red-700 transition">Keluar</a>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-6 py-10">
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, <?= $nama_user; ?>!</h2>
                <p class="text-gray-600 text-sm">Berikut adalah ringkasan aktivitas jelantahmu.</p>
            </div>
            <a href="transaksi.php" class="bg-primary text-white px-6 py-3 rounded-xl text-sm font-bold hover:bg-secondary transition-all shadow-lg flex items-center gap-2">
                <i class="fas fa-plus-circle"></i> Setor Minyak
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 fade-in">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 group">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-gray-400 text-[10px] font-bold uppercase tracking-[0.2em]">Volume Terkumpul</p>
                    <i class="fas fa-tint text-accent group-hover:text-secondary transition-colors"></i>
                </div>
                <h3 class="text-3xl font-bold text-primary"><?= $total_volume; ?> <span class="text-sm font-normal text-gray-400">Liter</span></h3>
            </div>
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 group">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-gray-400 text-[10px] font-bold uppercase tracking-[0.2em]">Saldo Digital</p>
                    <i class="fas fa-wallet text-accent group-hover:text-secondary transition-colors"></i>
                </div>
                <h3 class="text-3xl font-bold text-primary">Rp <?= number_format($saldo, 0, ',', '.'); ?></h3>
            </div>

            <div class="<?= $status_aktif == 'Ada Penjemputan' ? 'bg-secondary' : 'bg-primary'; ?> p-6 rounded-2xl shadow-lg text-white">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-accent/60 text-[10px] font-bold uppercase tracking-[0.2em]">Status Terkini</p>
                    <i class="fas fa-info-circle text-accent"></i>
                </div>
                <h3 class="text-lg font-bold"><?= $status_aktif; ?></h3>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden fade-in">
            <div class="px-6 py-5 border-b border-gray-50 flex justify-between items-center bg-lightGreen/30">
                <h4 class="font-bold text-primary text-sm tracking-wide">RIWAYAT TRANSAKSI</h4>
                <span class="bg-white px-3 py-1 rounded-full border border-gray-100 text-gray-400 italic text-[10px]">
                    Hari ini: <?= date('d M Y'); ?>
                </span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/50 text-gray-500 text-[10px] uppercase font-bold tracking-widest">
                        <tr>
                            <th class="p-5 border-b">ID</th>
                            <th class="p-5 border-b">Tanggal</th>
                            <th class="p-5 border-b">Volume (L)</th>
                            <th class="p-5 border-b">Status</th>
                            <th class="p-5 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-600">
                        <?php
                        $tampil = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_user = '$id_user' ORDER BY id_transaksi DESC");
                        
                        if (mysqli_num_rows($tampil) > 0) {
                            while ($row = mysqli_fetch_array($tampil)) {
                                // Logika Warna Status (Huruf Kecil)
                                $status_db = strtolower($row['status']);
                                if($status_db == 'selesai') {
                                    $statusColor = 'bg-green-100 text-green-600';
                                } elseif($status_db == 'dijemput') {
                                    $statusColor = 'bg-blue-100 text-blue-600';
                                } else {
                                    $statusColor = 'bg-yellow-100 text-yellow-600';
                                }
                        ?>
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition">
                                <td class="p-5 font-mono text-xs">#TRX-<?= $row['id_transaksi']; ?></td>
                                <td class="p-5"><?= date('d/m/Y', strtotime($row['tgl_request'])); ?></td>
                                <td class="p-5 font-bold text-primary"><?= $row['volume']; ?> L</td>
                                <td class="p-5">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase <?= $statusColor; ?>">
                                        <?= $row['status']; ?>
                                    </span>
                                </td>
                                <td class="p-5 text-center">
                                    <button class="text-primary hover:text-secondary transition"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                        <?php 
                            } 
                        } else { ?>
                            <tr>
                                <td colspan="5" class="p-20 text-center">
                                    <div class="max-w-xs mx-auto">
                                        <div class="w-16 h-16 bg-lightGreen rounded-full flex items-center justify-center mx-auto mb-4">
                                            <i class="fas fa-database text-accent text-xl"></i>
                                        </div>
                                        <p class="font-bold text-primary text-base">Belum ada data</p>
                                        <p class="text-xs text-gray-400 mt-2">Database masih kosong. Yuk, setor minyak jelantah pertamamu!</p>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="text-center py-10 text-gray-400 text-[10px] uppercase tracking-widest">
        Pemrograman Website &copy; 2026 Greasycle — <?= $nama_user; ?>
    </footer>

</body>
</html>