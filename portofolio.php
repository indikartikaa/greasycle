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
        .fade-in { animation: fadeIn 0.4s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
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
            
            <?php if(isset($_SESSION['nama'])): ?>
                <li class="flex items-center gap-4 bg-accent/30 px-4 py-2 rounded-full border border-accent">
                    <span class="text-primary font-bold text-sm italic">Halo, <?= $_SESSION['nama']; ?></span>
                    <div class="w-px h-4 bg-primary/20"></div>
                    <a href="logout.php" class="text-red-500 text-[10px] font-extrabold uppercase tracking-widest hover:text-red-700 transition">Keluar</a>
                </li>
            <?php endif; ?>
        </ul>

        <div id="menu-btn" class="md:hidden text-primary text-2xl cursor-pointer p-2">
            <i class="fas fa-bars"></i>
        </div>
    </div>

    <ul id="mobile-menu" class="hidden flex-col absolute top-[100%] left-0 w-full bg-white shadow-lg p-6 space-y-4 md:hidden border-t border-gray-100">
        <li><a href="index.php" class="block text-[#666]">Beranda</a></li>
        <li><a href="about.php" class="block text-[#666]">Tentang</a></li>
        <li><a href="contact.php" class="block text-[#666]">Kontak</a></li>
        <li><a href="portofolio.php" class="block text-primary font-bold">Portofolio</a></li>
    </ul>
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
                    <span class="bg-gray-100 px-4 py-2 rounded-xl text-xs font-bold text-primary border border-gray-200">XAMPP</span>
                </div>
            </div>

            <div class="bg-white p-8 shadow-sm rounded-[30px] border border-gray-100 hover:-translate-y-2 transition duration-300">
                <div class="w-12 h-12 bg-accent rounded-2xl flex items-center justify-center mb-6 text-primary">
                    <i class="fas fa-bullseye text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-primary mb-4">Tujuan Proyek</h2>
                <p class="text-gray-600 text-sm leading-relaxed text-justify">
                    Proyek ini bertujuan untuk mengurangi pencemaran lingkungan akibat pembuangan 
                    minyak jelantah sembarangan serta mendukung konsep ekonomi sirkular melalui konversi limbah menjadi saldo digital.
                </p>
            </div>
        </div>
    </section>

    <section class="mx-auto px-4 mt-20 max-w-3xl mb-12">
        <div class="bg-white p-10 rounded-[40px] shadow-sm border border-gray-100">
            <h2 class="text-2xl font-bold text-primary text-center mb-8">Feedback Proyek</h2>
            <form id="feedbackForm" class="space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="flex flex-col">
                        <label class="text-xs font-bold text-primary uppercase tracking-widest mb-2">Nama</label>
                        <input type="text" id="nama" placeholder="Nama Anda" class="p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:border-secondary transition text-sm" required>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xs font-bold text-primary uppercase tracking-widest mb-2">Email</label>
                        <input type="email" id="email" placeholder="Email Anda" class="p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:border-secondary transition text-sm" required>
                    </div>
                </div>
                <div class="flex flex-col">
                    <label class="text-xs font-bold text-primary uppercase tracking-widest mb-2">Jenis Feedback</label>
                    <select id="jenis" class="p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:border-secondary transition text-sm" required>
                        <option value="">Pilih Kategori</option>
                        <option value="review">Review Proyek</option>
                        <option value="saran">Saran Pengembangan</option>
                        <option value="kolaborasi">Kolaborasi</option>
                    </select>
                </div>
                <div class="flex flex-col">
                    <label class="text-xs font-bold text-primary uppercase tracking-widest mb-2">Pesan</label>
                    <textarea id="pesan" rows="4" placeholder="Tulis masukan..." class="p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:border-secondary transition text-sm" required></textarea>
                </div>
                <button type="submit" class="w-full bg-primary text-white font-bold py-4 rounded-2xl hover:bg-secondary transition shadow-lg">Kirim Feedback</button>
            </form>
            <div class="mt-12 space-y-4" id="feedbackList"></div>
        </div>
    </section>
</main>

<footer class="bg-primary pt-24 pb-12 mt-20">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap">
            <div class="w-full px-4 mb-12 md:w-1/3">
                <h3 class="font-bold text-xl text-white mb-4 uppercase tracking-wider">Hubungi Kami</h3>
                <div class="space-y-3">
                    <p class="text-white font-semibold text-lg">PT Greasycle Indonesia</p>
                    <p class="text-accent opacity-80 leading-relaxed text-sm">
                        JL. Semampir Tengah VIII Blok B No 18 RT. 10 RW. 01,<br>
                        Kec. Sukolilo, Kota Surabaya, Prov. Jawa Timur 60119
                    </p>
                    <p class="text-accent opacity-80 text-sm">info@greasycle.id</p>
                    <p class="text-accent opacity-80 text-sm">+62 812-3456-7890</p>
                    <p class="text-accent opacity-80 text-sm">Senin-Jumat: 08.00 - 16.00 WIB</p>
                </div>
            </div>
            
            <div class="w-full px-4 mb-12 md:w-1/3">
                <h3 class="font-semibold text-xl text-white mb-8 uppercase tracking-wider">Layanan Kami</h3>
                <ul class="text-accent opacity-80 space-y-4">
                    <li><a href="#" class="text-base hover:text-white transition duration-300">Setor Jelantah</a></li>
                    <li><a href="#" class="text-base hover:text-white transition duration-300">Penjemputan Rutin</a></li>
                    <li><a href="#" class="text-base hover:text-white transition duration-300">Edukasi Ramah Lingkungan</a></li>
                    <li><a href="#" class="text-base hover:text-white transition duration-300">Insentif Ekonomi</a></li>
                </ul>
            </div>

            <div class="w-full px-4 mb-12 md:w-1/3">
                <h3 class="font-semibold text-xl text-white mb-8 uppercase tracking-wider">Tautan</h3>
                <ul class="text-accent opacity-80 space-y-4">
                    <li><a href="index.php" class="text-base hover:text-white transition duration-300">Beranda</a></li>
                    <li><a href="about.php" class="text-base hover:text-white transition duration-300">Tentang Kami</a></li>
                    <li><a href="contact.php" class="text-base hover:text-white transition duration-300">Kontak</a></li>
                    <li><a href="portofolio.php" class="text-base hover:text-white transition duration-300 underline">Portofolio</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="text-center mt-20 border-t border-white/10 pt-10 px-4">
        <p class="text-[10px] uppercase tracking-[0.2em] opacity-40">Pemrograman Website © 2026 Greasycle</p>
    </div>
</footer>

<script>
    // JS Feedback List
    const form = document.getElementById("feedbackForm");
    const list = document.getElementById("feedbackList");

    form.addEventListener("submit", function(e){
        e.preventDefault();
        let nama = document.getElementById("nama").value;
        let jenis = document.getElementById("jenis").value;
        let pesan = document.getElementById("pesan").value;

        const data = `
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 border-l-4 border-primary fade-in">
            <h4 class="font-bold text-primary text-sm">${nama} <span class="text-[10px] font-normal text-gray-400 uppercase tracking-widest ml-2">${jenis}</span></h4>
            <p class="text-gray-600 mt-2 text-sm italic">"${pesan}"</p>
        </div>`;
        list.insertAdjacentHTML('afterbegin', data);
        form.reset();
    });
</script>
</body>
</html>