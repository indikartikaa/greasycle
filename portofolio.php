<?php 
session_start(); 
include 'koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - Greasycle</title>
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
        body { font-family: 'Poppins', sans-serif; scroll-behavior: smooth; }
        .modal-auth { display: none; position: fixed; z-index: 3000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); }
        .modal-content { background: white; padding: 40px; width: 90%; max-width: 450px; border-radius: 30px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); }
        .hidden-form { display: none; }
    </style>
</head>
<body class="bg-[#f7faf9] text-[#333] leading-relaxed overflow-x-hidden">

<nav class="bg-white py-4 px-[8%] sticky top-0 z-[1000] shadow-md">
    <div class="flex justify-between items-center">
        <div class="text-2xl font-bold text-primary tracking-tight">Greasycle</div>
        
        <ul class="hidden md:flex list-none gap-8 items-center">
            <li><a href="index.php" class="text-[#666] font-medium transition duration-300 hover:text-primary">Beranda</a></li>
            <li><a href="about.php" class="text-[#666] font-medium transition duration-300 hover:text-primary">Tentang</a></li>
            <li><a href="contact.php" class="text-[#666] font-medium transition duration-300 hover:text-primary">Kontak</a></li>
            <li><a href="portofolio.php" class="text-primary font-bold border-b-2 border-primary pb-1">Portofolio</a></li>
            
            <li>
                <?php if(isset($_SESSION['nama'])): ?>
                    <div class="flex items-center gap-4 bg-accent/30 px-4 py-2 rounded-full border border-accent">
                        <span class="text-primary font-bold text-sm italic">Halo, <?= $_SESSION['nama']; ?></span>
                        <div class="w-px h-4 bg-primary/20"></div>
                        <a href="logout.php" class="text-red-500 text-[10px] font-extrabold uppercase tracking-widest hover:text-red-700 transition">Keluar</a>
                    </div>
                <?php else: ?>
                    <button onclick="openAuth()" class="bg-primary text-white px-8 py-2.5 rounded-full font-bold hover:bg-secondary transition shadow-lg transform hover:scale-105 active:scale-95">
                        Login
                    </button>
                <?php endif; ?>
            </li>
        </ul>

        <div id="menu-btn" class="md:hidden text-primary text-2xl cursor-pointer p-2">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</nav>

<main>
    <header class="relative bg-cover bg-center text-white py-16 md:py-20 px-[8%] text-center overflow-hidden"
            style="background-image: linear-gradient(rgba(0,64,48,0.85), rgba(0,64,48,0.85))">
        <div class="max-w-4xl mx-auto relative z-10">
            <h1 class="text-3xl md:text-4xl font-bold mb-3 tracking-tight">Portofolio Proyek</h1>
            <p class="text-base md:text-lg opacity-90 font-light">Website Pengelolaan Kembali Minyak Jelantah — Greasycle</p>
        </div>
    </header>

    <section class="container mx-auto px-4 mt-12 max-w-5xl mb-24">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-8 shadow-sm rounded-[30px] border border-gray-100 hover:-translate-y-2 transition duration-300">
                <div class="w-12 h-12 bg-accent rounded-2xl flex items-center justify-center mb-6 text-primary">
                    <i class="fas fa-project-diagram text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-primary mb-4">Deskripsi Proyek</h2>
                <p class="text-gray-600 text-sm leading-relaxed text-justify">
                    Greasycle adalah platform berbasis web yang dirancang untuk membantu masyarakat 
                    dalam mengelola minyak jelantah secara ramah lingkungan. Sistem ini menyediakan 
                    fitur penjadwalan penjemputan minyak bekas serta edukasi mengenai proses daur ulang.
                </p>
            </div>

            <div class="bg-white p-8 shadow-sm rounded-[30px] border border-gray-100 hover:-translate-y-2 transition duration-300">
                <div class="w-12 h-12 bg-accent rounded-2xl flex items-center justify-center mb-6 text-primary">
                    <i class="fas fa-star text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-primary mb-4">Fitur Utama</h2>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-center gap-3"><i class="fas fa-check-circle text-secondary"></i> Registrasi & Login Multilevel</li>
                    <li class="flex items-center gap-3"><i class="fas fa-check-circle text-secondary"></i> Sistem Transaksi & Riwayat</li>
                    <li class="flex items-center gap-3"><i class="fas fa-check-circle text-secondary"></i> Dashboard Pelanggan & Mitra</li>
                    <li class="flex items-center gap-3"><i class="fas fa-check-circle text-secondary"></i> Filter Data Real-time</li>
                </ul>
            </div>
            
            <div class="bg-white p-8 shadow-sm rounded-[30px] border border-gray-100 hover:-translate-y-2 transition duration-300">
                <div class="w-12 h-12 bg-accent rounded-2xl flex items-center justify-center mb-6 text-primary">
                    <i class="fas fa-laptop-code text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-primary mb-4">Teknologi & Tools</h2>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-gray-100 px-4 py-2 rounded-xl text-xs font-bold text-primary border border-gray-200">PHP 8.2</span>
                    <span class="bg-gray-100 px-4 py-2 rounded-xl text-xs font-bold text-primary border border-gray-200">Tailwind CSS</span>
                    <span class="bg-gray-100 px-4 py-2 rounded-xl text-xs font-bold text-primary border border-gray-200">MySQL</span>
                </div>
            </div>

            <div class="bg-white p-8 shadow-sm rounded-[30px] border border-gray-100 hover:-translate-y-2 transition duration-300">
                <div class="w-12 h-12 bg-accent rounded-2xl flex items-center justify-center mb-6 text-primary">
                    <i class="fas fa-bullseye text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-primary mb-4">Tujuan Proyek</h2>
                <p class="text-gray-600 text-sm leading-relaxed text-justify">
                    Proyek ini bertujuan untuk mengurangi pencemaran lingkungan akibat pembuangan 
                    minyak jelantah sembarangan serta mendukung konsep ekonomi sirkular.
                </p>
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
</body>
</html>