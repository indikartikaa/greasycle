<?php 
session_start(); 
include 'koneksi.php'; 

// Ambil nama file untuk logika active menu
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greasycle - Ubah Limbah Jadi Energi Hijau</title>
    
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
        /* Global Styles */
        * { 
            font-family: 'Poppins', sans-serif !important; 
        }
        
        body { 
            background-color: #f7faf9;
            color: #333;
            line-height: 1.625;
            font-size: 16px; /* Ukuran font standar Index */
            scroll-behavior: smooth; 
        }

        /* Hilangkan underline link secara global kecuali yang di-set manual */
        a { text-decoration: none !important; }

        /* Modal Styles */
        .modal-auth { 
            display: none; 
            position: fixed; 
            z-index: 3000; 
            left: 0; top: 0; 
            width: 100%; height: 100%; 
            background: rgba(0,0,0,0.6); 
            backdrop-filter: blur(5px); 
        }
        .modal-content { 
            background: white; 
            padding: 40px; 
            width: 90%; 
            max-width: 450px; 
            border-radius: 30px; 
            position: absolute; 
            top: 50%; left: 50%; 
            transform: translate(-50%, -50%); 
        }
        .hidden-form { display: none; }

        /* FAQ Styles (Agar About.php lancar) */
        .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; }
        .faq-item.active .faq-answer { max-height: 500px; transition: max-height 0.5s ease-in; }
        .faq-item.active .faq-chevron { transform: rotate(180deg); }
    </style>
</head>
<body class="overflow-x-hidden">

<nav class="bg-white py-4 px-[8%] sticky top-0 z-[1000] shadow-md">
    <div class="flex justify-between items-center">
        <div class="text-2xl font-bold text-primary tracking-tight">Greasycle</div>
        
        <ul class="hidden md:flex list-none gap-8 items-center m-0 p-0">
            <li>
                <a href="index.php" class="<?= ($current_page == 'index.php') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-[#666] font-medium hover:text-primary'; ?> transition duration-300">
                    Beranda
                </a>
            </li>

            <li>
                <a href="about.php" class="<?= ($current_page == 'about.php') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-[#666] font-medium hover:text-primary'; ?> transition duration-300">
                    Tentang
                </a>
            </li>

            <li>
                <a href="contact.php" class="<?= ($current_page == 'contact.php') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-[#666] font-medium hover:text-primary'; ?> transition duration-300">
                    Kontak
                </a>
            </li>

            <li>
                <a href="portofolio.php" class="<?= ($current_page == 'portofolio.php') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-[#666] font-medium hover:text-primary'; ?> transition duration-300">
                    Portofolio
                </a>
            </li>
            
            <li class="ml-4">
                <?php if(isset($_SESSION['nama'])): ?>
                    <div class="flex items-center gap-4 bg-accent/30 px-4 py-2 rounded-full border border-accent">
                        <span class="text-primary font-bold text-sm italic">Halo, <?= $_SESSION['nama']; ?></span>
                        <div class="w-px h-4 bg-primary/20"></div>
                        <a href="logout.php" class="text-red-500 text-[10px] font-extrabold uppercase tracking-widest hover:text-red-700 transition">Keluar</a>
                    </div>
                <?php else: ?>
                    <button onclick="openAuth()" class="bg-primary text-white px-8 py-2.5 rounded-full font-bold hover:bg-secondary transition shadow-lg shadow-primary/20 transform hover:scale-105 active:scale-95">
                        Login
                    </button>
                <?php endif; ?>
            </li>
        </ul>

        <div id="menu-btn" class="md:hidden text-primary text-2xl cursor-pointer p-2">
            <i class="fas fa-bars"></i>
        </div>
    </div>

    <ul id="mobile-menu" class="hidden flex-col absolute top-[100%] left-0 w-full bg-white shadow-lg p-6 space-y-4 md:hidden border-t border-gray-100 list-none">
        <li><a href="index.php" class="<?= ($current_page == 'index.php') ? 'text-primary font-bold' : 'text-[#666]'; ?>">Beranda</a></li>
        <li><a href="about.php" class="<?= ($current_page == 'about.php') ? 'text-primary font-bold' : 'text-[#666]'; ?>">Tentang</a></li>
        <li><a href="contact.php" class="<?= ($current_page == 'contact.php') ? 'text-primary font-bold' : 'text-[#666]'; ?>">Kontak</a></li>
        <li><a href="portofolio.php" class="<?= ($current_page == 'portofolio.php') ? 'text-primary font-bold' : 'text-[#666]'; ?>">Portofolio</a></li>
        <?php if(!isset($_SESSION['nama'])): ?>
            <li><button onclick="openAuth()" class="w-full bg-primary text-white py-3 rounded-xl font-bold">Login</button></li>
        <?php endif; ?>
    </ul>
</nav>