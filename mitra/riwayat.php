<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['nama']) || $_SESSION['role'] !== 'mitra') {
    header("location: ../index.php");
    exit();
}

$id_mitra = $_SESSION['id_user'];
$nama_mitra = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penjemputan - Greasycle</title>
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
        #sidebar { transition: transform 0.3s ease-in-out; }
        .sidebar-link:hover { background: rgba(255,255,255,0.1); color: white; }
        .sidebar-active { background: rgba(255,255,255,0.15); color: white !important; }
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
        <a href="dashboard.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 text-sm font-medium">
            <i class="fas fa-th-large w-5 text-center"></i> Dashboard
        </a>
        <a href="tugas-penjemputan.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 text-sm font-medium">
            <i class="fas fa-clipboard-list w-5 text-center"></i> Tugas Penjemputan
        </a>
        <a href="riwayat.php" class="sidebar-link sidebar-active flex items-center gap-3 px-4 py-3 rounded-xl text-white text-sm font-medium">
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

<div class="md:ml-64 min-h-screen">
    <header class="bg-white border-b border-gray-100 px-6 md:px-8 py-4 flex justify-between items-center sticky top-0 z-40">
        <div class="flex items-center gap-4">
            <button id="open-sidebar" class="text-primary md:hidden text-xl"><i class="fas fa-bars"></i></button>
            <div>
                <h1 class="text-lg md:text-xl font-bold text-primary">Riwayat</h1>
                <p class="text-[10px] md:text-xs text-gray-400">Daftar tugas yang telah diselesaikan</p>
            </div>
        </div>
        <div class="text-[10px] md:text-xs text-gray-400 hidden sm:block">
            <?= date('l, d F Y'); ?>
        </div>
    </header>

    <main class="p-4 md:p-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                <h3 class="font-bold text-primary text-sm">Data Selesai</h3>
                <span class="bg-accent text-primary text-[9px] md:text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-wider">Arsip Digital</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-400 uppercase text-[9px] md:text-[10px] font-bold">
                        <tr>
                            <th class="px-6 py-4">Pelanggan & Alamat</th>
                            <th class="px-6 py-4">Volume</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php
                        $q_riwayat = mysqli_query($conn, "SELECT t.*, u.nama FROM transaksi t JOIN users u ON t.id_user = u.id_user WHERE t.status = 'selesai' AND t.id_mitra = '$id_mitra' ORDER BY t.id_transaksi DESC");
                        
                        if(mysqli_num_rows($q_riwayat) > 0){
                            while($row = mysqli_fetch_array($q_riwayat)){
                        ?>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-700 text-xs md:text-sm"><?= $row['nama']; ?></p>
                                <p class="text-[9px] md:text-[10px] text-gray-400 italic line-clamp-1"><?= $row['alamat_jemput']; ?></p>
                            </td>
                            <td class="px-6 py-4 text-primary font-bold text-xs md:text-sm"><?= $row['volume']; ?> L</td>
                            <td class="px-6 py-4 text-gray-500 text-[10px] md:text-xs whitespace-nowrap">
                                <?= date('d M Y', strtotime($row['tgl_request'])); ?>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-green-100 text-green-600 px-2 md:px-3 py-1 rounded-full text-[8px] md:text-[10px] font-bold uppercase flex items-center w-fit">
                                    <i class="fas fa-check-double mr-1 md:mr-2"></i> Berhasil
                                </span>
                            </td>
                        </tr>
                        <?php } } else { ?>
                        <tr>
                            <td colspan="4" class="p-10 text-center text-gray-400 italic text-xs">
                                <i class="fas fa-history text-3xl mb-3 block opacity-10"></i>
                                Belum ada riwayat penjemputan.
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
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