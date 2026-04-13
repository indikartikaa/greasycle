<?php
session_start();
include '../koneksi.php';

// 1. PROTEKSI HALAMAN
if (!isset($_SESSION['nama']) || $_SESSION['role'] !== 'mitra') {
    header("location: ../index.php");
    exit();
}

$id_mitra = $_SESSION['id_user'];
$nama_mitra = $_SESSION['nama'];

// 2. AMBIL DATA STATISTIK DARI DATABASE
// Tugas Aktif (Status: menunggu atau dijemput)
$q_aktif = mysqli_query($conn, "SELECT id_transaksi FROM transaksi WHERE status IN ('menunggu', 'dijemput')");
$total_aktif = mysqli_num_rows($q_aktif);

// Selesai Bulan Ini
$bulan_ini = date('m');
$q_selesai = mysqli_query($conn, "SELECT id_transaksi FROM transaksi WHERE status = 'selesai' AND MONTH(tgl_request) = '$bulan_ini'");
$total_selesai = mysqli_num_rows($q_selesai);

// Total Liter Dijemput
$q_liter = mysqli_query($conn, "SELECT SUM(volume) as total FROM transaksi WHERE status = 'selesai'");
$res_liter = mysqli_fetch_assoc($q_liter);
$total_liter = $res_liter['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mitra - Greasycle</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#004030',
                        secondary: '#2d6a4f',
                        accent: '#d1e7e0',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .sidebar-link { transition: all 0.2s; }
        .sidebar-link:hover { background: rgba(255,255,255,0.1); color: white; }
        .sidebar-active { background: rgba(255,255,255,0.15); color: white !important; }
    </style>
</head>
<body class="bg-[#f4f7f6] text-[#333]">

<aside class="fixed top-0 left-0 h-screen w-64 bg-primary flex flex-col z-50">
    <div class="px-6 py-5 border-b border-white/10">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-white/20 rounded-xl flex items-center justify-center">
                <i class="fas fa-recycle text-white text-sm"></i>
            </div>
            <span class="text-white font-bold text-lg">Greasycle</span>
        </div>
        <p class="text-white/40 text-[10px] mt-1 ml-12 uppercase tracking-widest">Portal Mitra</p>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1">
        <a href="dashboard.php" class="sidebar-link sidebar-active flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 text-sm font-medium">
            <i class="fas fa-th-large w-5 text-center"></i> Dashboard
        </a>
        <a href="tugas-penjemputan.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 text-sm font-medium">
            <i class="fas fa-clipboard-list w-5 text-center"></i> Tugas Penjemputan
        </a>
        <a href="riwayat.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 text-sm font-medium">
            <i class="fas fa-history w-5 text-center"></i> Riwayat
        </a>
    </nav>

    <div class="px-4 py-4 border-t border-white/10">
        <div class="flex items-center gap-3 px-3 py-3 rounded-xl bg-white/10">
            <div class="w-10 h-10 bg-secondary rounded-full flex items-center justify-center shrink-0 font-bold text-white text-sm uppercase">
                <?= substr($nama_mitra, 0, 1); ?>
            </div>
            <p class="text-white text-xs font-semibold truncate"><?= $nama_mitra; ?></p>
        </div>
        <a href="../logout.php" class="mt-3 flex items-center gap-2 px-4 py-2 text-white/50 hover:text-red-300 transition text-xs">
            <i class="fas fa-sign-out-alt"></i> Keluar
        </a>
    </div>
</aside>

<div class="ml-64 min-h-screen">
    <header class="bg-white border-b border-gray-100 px-8 py-4 flex justify-between items-center sticky top-0 z-40">
        <div>
            <h1 class="text-xl font-bold text-primary">Dashboard</h1>
            <p class="text-xs text-gray-400">Selamat datang, <?= $nama_mitra; ?> 👋</p>
        </div>
        <div class="text-xs text-gray-400 hidden sm:block">
            <?= date('l, d F Y'); ?>
        </div>
    </header>

    <main class="p-8 space-y-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <p class="text-xs text-gray-400 uppercase tracking-wider">Tugas Aktif</p>
                <h3 class="text-3xl font-bold text-orange-500 mt-1"><?= $total_aktif; ?></h3>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <p class="text-xs text-gray-400 uppercase tracking-wider">Selesai (Bulan Ini)</p>
                <h3 class="text-3xl font-bold text-primary mt-1"><?= $total_selesai; ?></h3>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <p class="text-xs text-gray-400 uppercase tracking-wider">Total Liter</p>
                <h3 class="text-3xl font-bold text-primary mt-1"><?= $total_liter; ?></h3>
            </div>
            <div class="bg-primary rounded-2xl p-6 shadow-sm text-white">
                <p class="text-xs text-white/60 uppercase tracking-wider">Status Mitra</p>
                <h3 class="text-lg font-bold mt-1 uppercase ">Aktif</h3>
            </div>
        </div>

        <div class="grid lg:grid-cols-1 gap-6">
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center">
                    <h3 class="font-bold text-primary text-sm">Permintaan Penjemputan Baru</h3>
                </div>
                <div class="divide-y divide-gray-50">
                    <?php
                    // Query tetap sama, mengambil status 'menunggu'
                    $q_tugas = mysqli_query($conn, "SELECT t.*, u.nama FROM transaksi t JOIN users u ON t.id_user = u.id_user WHERE t.status = 'menunggu' ORDER BY t.id_transaksi DESC");
    
                    if(mysqli_num_rows($q_tugas) > 0){
                        while($row = mysqli_fetch_array($q_tugas)){
                    ?>
                    <div class="px-6 py-5 flex items-center justify-between hover:bg-slate-50 transition">
                        <div>
                            <p class="font-semibold text-gray-700 text-sm"><?= $row['nama']; ?></p>
                            <p class="text-xs text-gray-400"><i class="fas fa-map-marker-alt mr-1"></i><?= $row['alamat_jemput']; ?></p>
                            <p class="text-[11px] text-primary font-bold mt-1"><?= $row['volume']; ?> Liter</p>
                        </div>
        
                       <a href="tugas-penjemputan.php?aksi=ambil&id=<?= $row['id_transaksi']; ?>" 
                            class="bg-primary text-white text-xs px-4 py-2 rounded-xl hover:bg-secondary transition shadow-md inline-block">
                            Ambil Tugas
                        </a>
                    </div>
                    <?php 
                        } 
                    } else { 
                    ?>
                        <div class="p-10 text-center">
                            <i class="fas fa-check-circle text-gray-100 text-4xl mb-2"></i>
                            <p class="text-gray-400 text-xs italic">Semua tugas sudah terambil.</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50">
                <h3 class="font-bold text-primary text-sm">Riwayat Penjemputan Terakhir</h3>
            </div>
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-400 uppercase text-[10px] font-bold">
                    <tr>
                        <th class="px-6 py-3">Pelanggan</th>
                        <th class="px-6 py-3">Volume</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q_history = mysqli_query($conn, "SELECT t.*, u.nama FROM transaksi t JOIN users u ON t.id_user = u.id_user WHERE t.status = 'selesai' ORDER BY t.id_transaksi DESC LIMIT 5");
                    while($h = mysqli_fetch_array($q_history)){
                    ?>
                    <tr class="border-b border-gray-50">
                        <td class="px-6 py-4 font-medium"><?= $h['nama']; ?></td>
                        <td class="px-6 py-4 text-primary font-bold"><?= $h['volume']; ?> L</td>
                        <td class="px-6 py-4 text-gray-400"><?= date('d M Y', strtotime($h['tgl_request'])); ?></td>
                        <td class="px-6 py-4"><span class="bg-green-100 text-green-600 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase">Selesai</span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
</script>
</body>
</html>