<?php
session_start();
include '../koneksi.php'; 

// Proteksi halaman
if (!isset($_SESSION['nama']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// ================== DATA ==================
$qLiter = mysqli_query($conn, "SELECT SUM(volume) as total FROM transaksi WHERE status='selesai'");
$dLiter = mysqli_fetch_assoc($qLiter);
$totalLiter = $dLiter['total'] ?? 0;

$qUser = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role='pelanggan'");
$dUser = mysqli_fetch_assoc($qUser);
$totalPelanggan = $dUser['total'] ?? 0;

$qMitra = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role='mitra'");
$dMitra = mysqli_fetch_assoc($qMitra);
$totalMitra = $dMitra['total'] ?? 0;

$qTransaksi = mysqli_query($conn, "SELECT COUNT(*) as total FROM transaksi");
$dTransaksi = mysqli_fetch_assoc($qTransaksi);
$totalTransaksi = $dTransaksi['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - Greasycle</title>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: '#004030',
                secondary: '#2d6a4f',
                accent: '#d1e7e0'
            }
        }
    }
}
</script>

<style>
body { font-family: 'Poppins', sans-serif; }
</style>
</head>

<body class="bg-gray-50 flex">

<!-- Overlay -->
<div id="overlay" onclick="toggleSidebar()" 
class="fixed inset-0 bg-black/50 hidden z-40 md:hidden"></div>

<!-- Sidebar -->
<aside id="sidebar"
class="fixed md:fixed top-16 md:top-0 left-[-100%] md:left-0 
w-64 h-[calc(100%-4rem)] md:h-screen 
bg-primary text-white p-6 
transition-all duration-300 ease-in-out z-50">

    <h2 class="text-2xl font-bold mb-10 flex items-center gap-2">
        <i class="fas fa-recycle"></i> Greasycle
    </h2>

    <nav class="space-y-4">
        <a href="dashboard.php" class="block bg-white/10 p-3 rounded-lg font-semibold">
            <i class="fas fa-th-large mr-2"></i> Dashboard
        </a>

        <a href="pelanggan.php" class="block p-3 hover:bg-white/10 rounded-lg text-white/60">
            <i class="fas fa-users mr-2"></i> Pelanggan
        </a>

        <a href="mitra.php" class="block p-3 hover:bg-white/10 rounded-lg text-white/60">
            <i class="fas fa-truck mr-2"></i> Mitra
        </a>
    </nav>

    <div class="mt-20 border-t border-white/10 pt-4">
        <a href="../logout.php" class="text-xs text-red-300 hover:underline uppercase font-bold">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
    </div>
</aside>

<!-- Main -->
<main class="flex-1 w-full overflow-x-hidden md:ml-64">

<!-- Header Mobile -->
<div class="md:hidden flex justify-between items-center h-16 px-4 bg-white shadow fixed top-0 left-0 right-0 z-[60]">
    <button onclick="toggleSidebar()" class="text-xl">
        <i class="fas fa-bars"></i>
    </button>
    <h1 class="font-bold text-primary">Greasycle</h1>
</div>

<div class="p-4 md:p-8 mt-16 md:mt-0">

<!-- Header -->
<header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div>
        <h1 class="text-xl md:text-2xl font-bold text-primary">Ringkasan Sistem</h1>
        <p class="text-xs md:text-sm text-gray-400" id="currentDate"></p>
    </div>
</header>

<!-- Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 md:gap-6 mb-8">

    <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-primary">
        <p class="text-xs text-gray-400 uppercase">Total Liter</p>
        <h3 class="text-2xl font-bold"><?= $totalLiter ?> L</h3>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-yellow-400">
        <p class="text-xs text-gray-400 uppercase">Pelanggan</p>
        <h3 class="text-2xl font-bold"><?= $totalPelanggan ?></h3>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-secondary">
        <p class="text-xs text-gray-400 uppercase">Mitra</p>
        <h3 class="text-2xl font-bold"><?= $totalMitra ?></h3>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow border-l-4 border-blue-400">
        <p class="text-xs text-gray-400 uppercase">Transaksi</p>
        <h3 class="text-2xl font-bold"><?= $totalTransaksi ?></h3>
    </div>

    <div class="bg-primary p-6 rounded-2xl shadow text-white">
        <p class="text-xs uppercase">Status Sistem</p>
        <h3 class="text-lg font-bold">Aktif / Normal</h3>
    </div>

</div>

<!-- Charts -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow">
        <h3 class="font-bold mb-4">Tren Pengumpulan</h3>
        <canvas id="lineChart"></canvas>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow">
        <h3 class="font-bold mb-4">Distribusi User</h3>
        <canvas id="donutChart"></canvas>
    </div>

</div>

</div>
</main>

<script>
// Toggle Sidebar
function toggleSidebar(){
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    if(sidebar.classList.contains('left-0')){
        sidebar.classList.remove('left-0');
        sidebar.classList.add('left-[-100%]');
        overlay.classList.add('hidden');
    } else {
        sidebar.classList.remove('left-[-100%]');
        sidebar.classList.add('left-0');
        overlay.classList.remove('hidden');
    }
}
// Tanggal
document.getElementById('currentDate').textContent =
    new Date().toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });

// Chart Line
new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr'],
        datasets: [{
            label: 'Liter',
            data: [80,95,110,130],
            borderColor: '#004030',
            backgroundColor: 'rgba(0,64,48,0.1)',
            fill: true
        }]
    }
});

// Chart Donut
new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
        labels: ['Pelanggan','Mitra'],
        datasets: [{
            data: [<?= $totalPelanggan ?>, <?= $totalMitra ?>],
            backgroundColor: ['#004030','#2d6a4f']
        }]
    }
});
</script>

</body>
</html>