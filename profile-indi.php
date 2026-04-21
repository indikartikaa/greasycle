<?php 
session_start(); 
include 'koneksi.php'; 
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Masyito Indi Kartika</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#004030',
                        secondary: '#2d6a4f',
                        accent: '#d1e7e0',
                        lightGreen: '#f0f7f4',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        .custom-profile-shadow { 
            box-shadow: 15px 15px 0px 0px #d1e7e0; 
        }
    </style>
</head>

<body class="bg-[#f7faf9] text-gray-800 leading-relaxed font-sans">

    <nav class="bg-white shadow-md py-4 px-[8%] sticky top-0 z-[1000] flex justify-between items-center border-b border-gray-100">
        <a href="index.php" class="text-2xl font-bold text-primary tracking-tight">Greasycle</a>
        <div class="flex gap-8 items-center">
            <a href="index.php" class="text-gray-500 font-medium hover:text-primary transition duration-300">Home</a>
            <a href="about.php" class="text-gray-500 font-medium hover:text-primary transition duration-300">Tentang</a>
            <a href="contact.php" class="text-gray-500 font-medium hover:text-primary transition duration-300">Kontak</a>
            <a href="portofolio.php" class="text-gray-500 font-medium hover:text-primary transition duration-300">Portofolio</a>
   
            <?php if(isset($_SESSION['nama'])): ?>
                <span class="text-primary font-bold text-sm italic border-l pl-4 border-gray-200">Halo, <?= $_SESSION['nama']; ?></span>
            <?php endif; ?>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-12">
        <section class="mb-20">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="relative group">
                    <div class="w-64 h-64 rounded-[2rem] overflow-hidden custom-profile-shadow transition-transform duration-500 group-hover:scale-[1.02]">
                        <img src="assets/images/foto-indi.jpeg" alt="Masyito Indi Kartika" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold text-primary mb-4 leading-tight">
                        Hi, Saya <br><span class="text-secondary">Masyito Indi Kartika</span>
                    </h1>
                    <span class="inline-block bg-accent text-primary px-4 py-1.5 rounded-full text-sm font-bold mb-6">
                        Sistem Informasi | System Analyst Enthusiast
                    </span>
                    <p class="text-lg text-gray-600 leading-relaxed max-w-2xl">
                        Saya memiliki ketertarikan dalam menganalisis sistem, memahami kebutuhan bisnis, serta merancang solusi teknologi yang efektif. Dengan mempelajari proses bisnis, saya berusaha mengubah permasalahan kompleks menjadi solusi yang terstruktur.
                    </p>
                </div>
            </div>
        </section>

        <section class="grid lg:grid-cols-3 gap-8 mb-20">
            <div class="lg:col-span-2 bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-primary mb-6 flex items-center gap-3">
                    <i class="fas fa-user-tag text-secondary"></i> About My Role
                </h2>
                <div class="space-y-4 text-gray-600 text-justify">
                    <p>Sebagai <strong class="text-primary">System Analyst</strong> di Greasycle, saya berperan menjembatani kebutuhan bisnis dengan solusi teknologi yang tepat. Saya melakukan analisis alur kerja sistem, mengidentifikasi kebutuhan pengguna, serta membantu merancang proses yang lebih efektif.</p>
                    <p>Melalui analisis mendalam dan kolaborasi tim, saya memastikan solusi yang dikembangkan memberikan nilai nyata bagi pengembangan bisnis.</p>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-start gap-4">
                    <div class="p-3 bg-lightGreen rounded-2xl text-secondary"><i class="fas fa-network-wired text-xl"></i></div>
                    <div>
                        <h3 class="font-bold text-primary text-sm">System Architecture</h3>
                        <p class="text-[11px] text-gray-500 leading-tight">Merancang struktur sistem yang kokoh dan skalabel.</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-start gap-4">
                    <div class="p-3 bg-lightGreen rounded-2xl text-secondary"><i class="fas fa-list-check text-xl"></i></div>
                    <div>
                        <h3 class="font-bold text-primary text-sm">Project Management</h3>
                        <p class="text-[11px] text-gray-500 leading-tight">Memastikan pengembangan sistem sesuai timeline.</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-start gap-4">
                    <div class="p-3 bg-lightGreen rounded-2xl text-secondary"><i class="fas fa-file-contract text-xl"></i></div>
                    <div>
                        <h3 class="font-bold text-primary text-sm">Requirements Analysis</h3>
                        <p class="text-[11px] text-gray-500 leading-tight">Analisis kebutuhan pengguna secara mendalam.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid md:grid-cols-2 gap-8 items-stretch mb-12">
            <div class="bg-primary text-white p-8 rounded-[2.5rem] shadow-xl">
                <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                    <i class="fas fa-code text-accent"></i> Core Skills
                </h3>
                <div class="flex flex-wrap gap-3">
                    <div class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-xl border border-white/10 hover:bg-white/20 transition cursor-default">
                        <i class="fas fa-database text-[#00758f]"></i> <span class="text-sm font-semibold">SQL</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-xl border border-white/10 hover:bg-white/20 transition cursor-default">
                        <i class="fas fa-sitemap text-[#ff9900]"></i> <span class="text-sm font-semibold">System Design</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-xl border border-white/10 hover:bg-white/20 transition cursor-default">
                        <i class="devicon-visualstudio-plain colored"></i> <span class="text-sm font-semibold">VB.NET</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-xl border border-white/10 hover:bg-white/20 transition cursor-default">
                        <i class="devicon-git-plain colored"></i> <span class="text-sm font-semibold">Git</span>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex flex-col justify-center items-center text-center">
                <h3 class="text-xl font-bold text-primary mb-6">Connect with Me</h3>
                <div class="flex gap-6">
                    <a href="https://linkedin.com/in/masyito-indi-kartika-721418336" target="_blank" 
                       class="w-14 h-14 bg-lightGreen rounded-2xl flex items-center justify-center text-[#0077b5] text-2xl hover:bg-primary hover:text-white transition-all duration-300">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="https://github.com/indikartikaa" target="_blank" 
                       class="w-14 h-14 bg-lightGreen rounded-2xl flex items-center justify-center text-gray-900 text-2xl hover:bg-primary hover:text-white transition-all duration-300">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </div>
        </section>

        <div class="text-center pt-8 border-t border-gray-200">
            <a href="index.php" class="inline-flex items-center gap-2 text-secondary font-bold hover:gap-4 transition-all group">
                Kembali ke Beranda <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-8 text-center mt-20">
        <p class="text-[10px] text-gray-400 uppercase tracking-widest">
            &copy; <?= date('Y'); ?> Greasycle. Profile page by <span class="font-bold text-primary italic">Masyito Indi Kartika</span>.
        </p>
    </footer>

</body>
</html>