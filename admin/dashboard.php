<?php
session_start();
include '../koneksi.php'; 

// Proteksi Admin
if (!isset($_SESSION['nama']) || $_SESSION['role'] !== 'admin') {
    header("location: ../index.php");
    exit();
}

// Ganti $koneksi menjadi $conn di semua baris di bawah ini:

// Total liter
$qLiter = mysqli_query($conn, "SELECT SUM(volume) as total FROM transaksi WHERE status = 'selesai'");
$dLiter = mysqli_fetch_assoc($qLiter);
$totalLiter = $dLiter['total'] ?? 0;

// Total pelanggan
$qUser = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role = 'pelanggan'");
$dUser = mysqli_fetch_assoc($qUser);
$totalPelanggan = $dUser['total'] ?? 0;

// Total mitra
$qMitra = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role = 'mitra'");
$dMitra = mysqli_fetch_assoc($qMitra);
$totalMitra = $dMitra['total'] ?? 0;

// Total transaksi
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

<!-- Sidebar -->
<aside class="w-64 bg-primary min-h-screen p-6 text-white hidden md:block sticky top-0">
    <h2 class="text-2xl font-bold mb-10 flex items-center gap-2">
        <i class="fas fa-recycle"></i> Greasycle
    </h2>

    <nav class="space-y-4">
        <a href="dashboard.php" class="block bg-white/10 p-3 rounded-lg font-semibold">
            <i class="fas fa-th-large mr-2"></i> Dashboard
        </a>

        <a href="pelanggan.php" class="block p-3 hover:bg-white/10 rounded-lg text-white/60 transition">
            <i class="fas fa-users mr-2"></i> Pelanggan
        </a>

        <a href="mitra.php" class="block p-3 hover:bg-white/10 rounded-lg text-white/60 transition">
            <i class="fas fa-truck mr-2"></i> Mitra
        </a>
    </nav>

    <div class="mt-20 border-t border-white/10 pt-4">
        <a href="../logout.php" class="text-xs text-red-300 hover:underline uppercase font-bold tracking-widest">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
    </div>
</aside>

<!-- Main -->
<main class="flex-1 p-8 overflow-x-hidden">

<!-- Header -->
<header class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-2xl font-bold text-primary">Ringkasan Sistem</h1>
        <p class="text-sm text-gray-400" id="currentDate"></p>
    </div>

    <div class="flex items-center gap-3 bg-white p-2 rounded-xl shadow-sm border">
        <div class="w-10 h-10 bg-accent rounded-full flex items-center justify-center text-primary font-bold">
            A
        </div>
        <div class="hidden sm:block">
            <p class="text-xs font-bold text-gray-700">Super Admin</p>
            <p class="text-[10px] text-gray-400 italic">admin@greasycle.id</p>
        </div>
    </div>
</header>

<!-- Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-10">

    <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-primary">
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Total Liter</p>
        <h3 class="text-2xl font-bold text-gray-800"><?= $totalLiter ?> L</h3>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-yellow-400">
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Pelanggan</p>
        <h3 class="text-2xl font-bold text-gray-800"><?= $totalPelanggan ?></h3>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-secondary">
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Mitra</p>
        <h3 class="text-2xl font-bold text-gray-800"><?= $totalMitra ?></h3>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-blue-400">
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Transaksi</p>
        <h3 class="text-2xl font-bold text-gray-800"><?= $totalTransaksi ?></h3>
    </div>

    <div class="bg-primary p-6 rounded-2xl shadow-lg text-white">
        <p class="text-accent/60 text-[10px] font-bold uppercase tracking-widest">Status Sistem</p>
        <h3 class="text-lg font-bold">Aktif / Normal</h3>
    </div>

</div>

<!-- Charts -->
<div class="grid lg:grid-cols-3 gap-8 mb-10">

    <div class="lg:col-span-2 bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
        <h3 class="font-bold text-primary mb-6 flex items-center gap-2">
            <i class="fas fa-chart-line"></i> Tren Pengumpulan Limbah
        </h3>
        <canvas id="lineChart" height="120"></canvas>
    </div>

    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
        <h3 class="font-bold text-primary mb-6">Distribusi User</h3>
        <canvas id="donutChart"></canvas>
    </div>

</div>

</main>

<script>
// Tanggal
document.getElementById('currentDate').textContent =
    new Date().toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });

// Chart dummy (bisa nanti diganti dari database)
new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr'],
        datasets: [{
            data: [80, 95, 110, 130],
            borderColor: '#004030',
            backgroundColor: 'rgba(0,64,48,0.1)',
            fill: true
        }]
    }
});

new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
        labels: ['Pelanggan', 'Mitra'],
        datasets: [{
            data: [<?= $totalPelanggan ?>, <?= $totalMitra ?>],
            backgroundColor: ['#004030', '#2d6a4f']
        }]
    }
});
</script>

</body>
</html>

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

<!-- Sidebar -->
<aside class="w-64 bg-primary min-h-screen p-6 text-white hidden md:block sticky top-0">
    <h2 class="text-2xl font-bold mb-10 flex items-center gap-2">
        <i class="fas fa-recycle"></i> Greasycle
    </h2>

    <nav class="space-y-4">
        <a href="dashboard.php" class="block bg-white/10 p-3 rounded-lg font-semibold">
            <i class="fas fa-th-large mr-2"></i> Dashboard
        </a>

        <a href="pelanggan.php" class="block p-3 hover:bg-white/10 rounded-lg text-white/60 transition">
            <i class="fas fa-users mr-2"></i> Pelanggan
        </a>

        <a href="mitra.php" class="block p-3 hover:bg-white/10 rounded-lg text-white/60 transition">
            <i class="fas fa-truck mr-2"></i> Mitra
        </a>
    </nav>

    <div class="mt-20 border-t border-white/10 pt-4">
        <a href="../logout.php" class="text-xs text-red-300 hover:underline uppercase font-bold tracking-widest">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
    </div>
</aside>

<!-- Main -->
<main class="flex-1 p-8 overflow-x-hidden">

<!-- Header -->
<header class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-2xl font-bold text-primary">Ringkasan Sistem</h1>
        <p class="text-sm text-gray-400" id="currentDate"></p>
    </div>

    <div class="flex items-center gap-3 bg-white p-2 rounded-xl shadow-sm border">
        <div class="w-10 h-10 bg-accent rounded-full flex items-center justify-center text-primary font-bold">
            A
        </div>
        <div class="hidden sm:block">
            <p class="text-xs font-bold text-gray-700">Super Admin</p>
            <p class="text-[10px] text-gray-400 italic">admin@greasycle.id</p>
        </div>
    </div>
</header>

<!-- Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-10">

    <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-primary">
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Total Liter</p>
        <h3 class="text-2xl font-bold text-gray-800"><?= $totalLiter ?> L</h3>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-yellow-400">
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Pelanggan</p>
        <h3 class="text-2xl font-bold text-gray-800"><?= $totalPelanggan ?></h3>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-secondary">
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Mitra</p>
        <h3 class="text-2xl font-bold text-gray-800"><?= $totalMitra ?></h3>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-blue-400">
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Transaksi</p>
        <h3 class="text-2xl font-bold text-gray-800"><?= $totalTransaksi ?></h3>
    </div>

    <div class="bg-primary p-6 rounded-2xl shadow-lg text-white">
        <p class="text-accent/60 text-[10px] font-bold uppercase tracking-widest">Status Sistem</p>
        <h3 class="text-lg font-bold">Aktif / Normal</h3>
    </div>

</div>

<!-- Charts -->
<div class="grid lg:grid-cols-3 gap-8 mb-10">

    <div class="lg:col-span-2 bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
        <h3 class="font-bold text-primary mb-6 flex items-center gap-2">
            <i class="fas fa-chart-line"></i> Tren Pengumpulan Limbah
        </h3>
        <canvas id="lineChart" height="120"></canvas>
    </div>

    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
        <h3 class="font-bold text-primary mb-6">Distribusi User</h3>
        <canvas id="donutChart"></canvas>
    </div>

</div>

</main>

<script>
// Tanggal
document.getElementById('currentDate').textContent =
    new Date().toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });

// Chart dummy (bisa nanti diganti dari database)
new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr'],
        datasets: [{
            data: [80, 95, 110, 130],
            borderColor: '#004030',
            backgroundColor: 'rgba(0,64,48,0.1)',
            fill: true
        }]
    }
});

new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
        labels: ['Pelanggan', 'Mitra'],
        datasets: [{
            data: [<?= $totalPelanggan ?>, <?= $totalMitra ?>],
            backgroundColor: ['#004030', '#2d6a4f']
        }]
    }
});
</script>

</body>
</html>