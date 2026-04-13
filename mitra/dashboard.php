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

// 2. AMBIL DATA STATISTIK
$q_aktif = mysqli_query($conn, "SELECT id_transaksi FROM transaksi WHERE status IN ('menunggu', 'dijemput')");
$total_aktif = mysqli_num_rows($q_aktif);

$bulan_ini = date('m');
$q_selesai = mysqli_query($conn, "SELECT id_transaksi FROM transaksi WHERE status = 'selesai' AND MONTH(tgl_request) = '$bulan_ini'");
$total_selesai = mysqli_num_rows($q_selesai);

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
        .sidebar-link:hover { background: rgba(255,255,255,0.1); color: white; }
        .sidebar-active { background: rgba(255,255,255,0.15); color: white !important; }
        /* Transisi Sidebar */
        #sidebar { transition: transform 0.3s ease-in-out; }
    </style>
</head>
<body class="bg-[#f4f7f6] text-[#333]">

<div id="overlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>

<aside id="sidebar" class="fixed top-0 left-0 h-screen w-64 bg-primary flex flex-col z-50 -translate-x-full md:translate-x-0">
    <div class="px-6 py-5 border-b border-white/10 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-white/20 rounded-xl flex items-center justify-center">
                <i class="fas fa-recycle text-white text-sm"></i>
            </div>
            <span class="text-white font-bold text-lg">Greasycle</span>
        </div>
        <button id="close-sidebar" class="text-white md:hidden"><i class="fas fa-times"></i></button>
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
            <div class="w-10 h-10 bg-secondary rounded-full flex items-center justify-center shrink-0 font-bold text-white text-sm">
                <?= substr($nama_mitra, 0, 1); ?>
            </div>
            <p class="text-white text-xs font-semibold truncate"><?= $nama_mitra; ?></p>
        </div>
        <a href="../logout.php" class="mt-3 flex items-center gap-2 px-4 py-2 text-white/50 hover:text-red-300 transition text-xs">
            <i class="fas fa-sign-out-alt"></i> Keluar
        </a>
    </div>
</aside>

<div class="md:ml-64 min-h-screen">
    <header class="bg-white border-b border-gray-100 px-6 md:px-8 py-4 flex justify-between items-center sticky top-0 z-40">
        <div class="flex items-center gap-4">
            <button id="open-sidebar" class="text-primary md:hidden text-xl"><i class="fas fa-bars"></i></button>
            <div>
                <h1 class="text-lg md:text-xl font-bold text-primary">Dashboard</h1>
                <p class="text-[10px] md:text-xs text-gray-400">Selamat datang, <?= $nama_mitra; ?> 👋</p>
            </div>
        </div>
        <div class="text-[10px] md:text-xs text-gray-400 text-right">
            <?= date('d M Y'); ?>
        </div>
    </header>

    <main class="p-5 md:p-8 space-y-6 md:space-y-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5">
            <div class="bg-white rounded-2xl p-5 md:p-6 shadow-sm border border-gray-100">
                <p class="text-[10px] text-gray-400 uppercase tracking-wider">Tugas Aktif</p>
                <h3 class="text-2xl md:text-3xl font-bold text-orange-500 mt-1"><?= $total_aktif; ?></h3>
            </div>
            <div class="bg-white rounded-2xl p-5 md:p-6 shadow-sm border border-gray-100">
                <p class="text-[10px] text-gray-400 uppercase tracking-wider">Selesai</p>
                <h3 class="text-2xl md:text-3xl font-bold text-primary mt-1"><?= $total_selesai; ?></h3>
            </div>
            <div class="bg-white rounded-2xl p-5 md:p-6 shadow-sm border border-gray-100">
                <p class="text-[10px] text-gray-400 uppercase tracking-wider">Total Liter</p>
                <h3 class="text-2xl md:text-3xl font-bold text-primary mt-1"><?= $total_liter; ?></h3>
            </div>
            <div class="bg-primary rounded-2xl p-5 md:p-6 shadow-sm text-white col-span-1">
                <p class="text-[10px] text-white/60 uppercase tracking-wider">Status</p>
                <h3 class="text-sm md:text-lg font-bold mt-1 uppercase">Aktif</h3>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/50">
                <h3 class="font-bold text-primary text-sm">Permintaan Penjemputan Baru</h3>
            </div>
            <div class="divide-y divide-gray-50">
                <?php
                $q_tugas = mysqli_query($conn, "SELECT t.*, u.nama FROM transaksi t JOIN users u ON t.id_user = u.id_user WHERE t.status = 'menunggu' ORDER BY t.id_transaksi DESC LIMIT 3");
                if(mysqli_num_rows($q_tugas) > 0){
                    while($row = mysqli_fetch_array($q_tugas)){ ?>
                    <div class="px-6 py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-slate-50 transition">
                        <div>
                            <p class="font-semibold text-gray-700 text-sm"><?= $row['nama']; ?></p>
                            <p class="text-[11px] text-gray-400"><i class="fas fa-map-marker-alt mr-1 text-primary"></i><?= $row['alamat_jemput']; ?></p>
                            <p class="text-[11px] font-bold text-primary mt-1"><?= $row['volume']; ?> L</p>
                        </div>
                        <a href="tugas-penjemputan.php?aksi=ambil&id=<?= $row['id_transaksi']; ?>" 
                            class="bg-primary text-white text-[11px] px-4 py-2 rounded-xl text-center shadow-md">
                            Ambil Tugas
                        </a>
                    </div>
                <?php } } else { ?>
                    <div class="p-10 text-center"><p class="text-gray-400 text-xs italic">Belum ada tugas baru.</p></div>
                <?php } ?>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50">
                <h3 class="font-bold text-primary text-sm">Riwayat Terakhir</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-400 uppercase text-[9px] font-bold">
                        <tr>
                            <th class="px-6 py-4">Pelanggan</th>
                            <th class="px-6 py-4">Vol</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_history = mysqli_query($conn, "SELECT t.*, u.nama FROM transaksi t JOIN users u ON t.id_user = u.id_user WHERE t.status = 'selesai' ORDER BY t.id_transaksi DESC LIMIT 5");
                        while($h = mysqli_fetch_array($q_history)){ ?>
                        <tr class="border-b border-gray-50 text-xs">
                            <td class="px-6 py-4 font-medium"><?= $h['nama']; ?></td>
                            <td class="px-6 py-4 text-primary font-bold"><?= $h['volume']; ?>L</td>
                            <td class="px-6 py-4 text-green-600 font-bold uppercase text-[9px]">Selesai</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
    // Logika Sidebar Mobile
    const sidebar = document.getElementById('sidebar');
    const openBtn = document.getElementById('open-sidebar');
    const closeBtn = document.getElementById('close-sidebar');
    const overlay = document.getElementById('overlay');

    function toggleSidebar() {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    openBtn.addEventListener('click', toggleSidebar);
    closeBtn.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);
</script>
</body>
</html>