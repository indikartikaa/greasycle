<?php 
session_start(); 
include 'koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Greasycle</title>
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
        .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; }
        .faq-item.active .faq-answer { max-height: 500px; transition: max-height 0.5s ease-in; }
        .faq-item.active .faq-chevron { transform: rotate(180deg); }
    </style>
</head>
<body class="bg-[#f7faf9] text-[#333] leading-relaxed overflow-x-hidden">

<nav class="bg-white py-4 px-[8%] sticky top-0 z-[1000] shadow-md">
    <div class="flex justify-between items-center">
        <div class="text-2xl font-bold text-primary">Greasycle</div>
        
        <ul class="hidden md:flex list-none gap-8 items-center">
            <li><a href="index.php" class="text-[#666] font-medium transition duration-300 hover:text-primary">Beranda</a></li>
            <li><a href="about.php" class="text-primary font-bold border-b-2 border-primary pb-1">Tentang</a></li>
            <li><a href="contact.php" class="text-[#666] font-medium transition duration-300 hover:text-primary">Kontak</a></li>
            <li><a href="portofolio.php" class="text-[#666] font-medium transition duration-300 hover:text-primary">Portofolio</a></li>
        </ul>

        <div id="menu-btn" class="md:hidden text-primary text-2xl cursor-pointer p-2">
            <i class="fas fa-bars"></i>
        </div>
    </div>

    <ul id="mobile-menu" class="hidden flex-col absolute top-[100%] left-0 w-full bg-white shadow-lg p-6 space-y-4 md:hidden border-t border-gray-100">
        <li><a href="index.php" class="block text-[#666]">Beranda</a></li>
        <li><a href="about.php" class="block text-primary font-bold">Tentang</a></li>
        <li><a href="contact.php" class="block text-[#666]">Kontak</a></li>
        <li><a href="portofolio.php" class="block text-[#666]">Portofolio</a></li>
    </ul>
</nav>

<main>
    <section class="relative bg-cover bg-center text-white text-center py-20 md:py-32 px-5" 
             style="background-image: linear-gradient(rgba(0,64,48,0.8), rgba(0,64,48,0.8)), url('assets/images/foto-2.jpeg')">
        <h1 class="text-3xl md:text-5xl font-bold mb-3">Tentang Kami</h1>
        <p class="text-base md:text-lg opacity-90 max-w-2xl mx-auto">Mengenal lebih jauh visi kami untuk lingkungan yang lebih bersih melalui pengelolaan limbah minyak.</p>
    </section>

    <section class="py-20 px-[8%] bg-white">
        <div class="grid md:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
            <div class="w-full">
                <img src="assets/images/foto-2.jpeg" alt="Greasycle Vision"
                     class="w-full rounded-[30px] shadow-[15px_15px_0px_0px_#d1e7e0] object-cover h-[300px] md:h-[400px]">
            </div>
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-primary">Apa itu Greasycle?</h2>
                <div class="space-y-4 text-justify text-gray-700 leading-relaxed text-sm md:text-base">
                    <p>Greasycle adalah platform digital yang membantu masyarakat mengelola limbah minyak jelantah dengan cara yang lebih mudah, aman, dan bermanfaat. Kami menghubungkan rumah tangga dengan mitra pengumpul dan industri biofuel untuk mengubah limbah dapur menjadi energi terbarukan.</p>
                    <p>Kami percaya bahwa perubahan besar bisa dimulai dari langkah kecil di rumah. Dengan menyalurkan minyak jelantah melalui Greasycle, Anda ikut menjaga lingkungan, mengurangi pencemaran air, serta mendukung sistem ekonomi sirkular yang berkelanjutan.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 px-[8%] bg-white border-t border-gray-50">
        <h2 class="text-center text-3xl font-bold text-primary mb-12 relative after:content-[''] after:block after:w-16 after:h-1 after:bg-secondary after:mx-auto after:mt-2">Kenapa Greasycle?</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <div class="bg-white p-8 rounded-[30px] shadow-sm border border-gray-100 hover:-translate-y-2 transition duration-300 text-center">
                <img src="https://cdn-icons-png.flaticon.com/128/2913/2913454.png" class="w-16 mx-auto mb-6" alt="Eco">
                <h3 class="text-xl font-bold text-primary mb-3">Eco-Friendly</h3>
                <p class="text-gray-500 text-sm">Membantu mengurangi pencemaran dengan mengelola limbah secara bertanggung jawab.</p>
            </div>
            <div class="bg-white p-8 rounded-[30px] shadow-sm border border-gray-100 hover:-translate-y-2 transition duration-300 text-center">
                <img src="https://cdn-icons-png.flaticon.com/128/2966/2966327.png" class="w-16 mx-auto mb-6" alt="Health">
                <h3 class="text-xl font-bold text-primary mb-3">Sehat & Aman</h3>
                <p class="text-gray-500 text-sm">Mencegah penyalahgunaan minyak jelantah ilegal yang membahayakan kesehatan.</p>
            </div>
            <div class="bg-white p-8 rounded-[30px] shadow-sm border border-gray-100 hover:-translate-y-2 transition duration-300 text-center">
                <img src="https://cdn-icons-png.flaticon.com/128/2454/2454282.png" class="w-16 mx-auto mb-6" alt="Economy">
                <h3 class="text-xl font-bold text-primary mb-3">Manfaat Ekonomi</h3>
                <p class="text-gray-500 text-sm">Mengubah limbah dapur menjadi nilai ekonomi tambahan melalui sistem insentif digital.</p>
            </div>
        </div>
    </section>

    <section class="py-16 px-[8%] bg-white border-t border-gray-50">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-6xl mx-auto">
            <div class="p-6 bg-[#f0f7f4] rounded-3xl text-center">
                <h4 class="text-2xl md:text-3xl font-bold text-primary">1.250+</h4>
                <p class="text-[10px] text-gray-500 uppercase tracking-wider mt-2">Liter Terkumpul</p>
            </div>
            <div class="p-6 bg-[#f0f7f4] rounded-3xl text-center">
                <h4 class="text-2xl md:text-3xl font-bold text-primary">850+</h4>
                <p class="text-[10px] text-gray-500 uppercase tracking-wider mt-2">Penyetor Aktif</p>
            </div>
            <div class="p-6 bg-[#f0f7f4] rounded-3xl text-center">
                <h4 class="text-2xl md:text-3xl font-bold text-primary">1.2M</h4>
                <p class="text-[10px] text-gray-500 uppercase tracking-wider mt-2">Liter Air Terjaga</p>
            </div>
            <div class="p-6 bg-[#f0f7f4] rounded-3xl text-center">
                <h4 class="text-2xl md:text-3xl font-bold text-primary">Surabaya</h4>
                <p class="text-[10px] text-gray-500 uppercase tracking-wider mt-2">Wilayah Operasional</p>
            </div>
        </div>
    </section>

    <section class="py-20 px-[8%] bg-white">
        <div class="bg-accent/40 rounded-[40px] grid md:grid-cols-2 gap-10 p-10 max-w-6xl mx-auto">
            <div class="space-y-4">
                <h3 class="text-xl font-bold text-primary italic underline decoration-secondary decoration-2 underline-offset-8">Visi Kami</h3>
                <p class="text-gray-700 text-sm md:text-base">Menjadi platform digital terdepan di Indonesia dalam pengelolaan dan transformasi limbah minyak jelantah menjadi energi terbarukan yang berkelanjutan serta bernilai ekonomi bagi masyarakat.</p>
            </div>
            <div class="space-y-4">
                <h3 class="text-xl font-bold text-primary italic underline decoration-secondary decoration-2 underline-offset-8">Misi Kami</h3>
                <ul class="list-disc pl-5 space-y-2 text-gray-700 text-sm md:text-base">
                    <li>Meningkatkan kesadaran masyarakat mengenai dampak limbah minyak jelantah.</li>
                    <li>Menyediakan sistem digital yang memudahkan proses pengumpulan minyak jelantah.</li>
                    <li>Mendukung terciptanya ekosistem ekonomi sirkular yang ramah lingkungan.</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="py-24 px-[8%] bg-white border-t border-gray-50">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-16 items-start">
            <div class="space-y-6">
                <div>
                    <h2 class="text-3xl font-bold text-primary mb-4">FAQ Edukasi</h2>
                    <p class="text-gray-500 text-sm italic mb-8">Pelajari mengapa pengelolaan jelantah sangat penting bagi bumi kita.</p>
                </div>
                
               <div class="space-y-3">
                <?php 
                $faqs = [
                    ["Apa itu minyak jelantah?", "Minyak goreng yang sudah digunakan berulang kali. Biasanya warna menjadi lebih gelap, berbau, dan kualitasnya sudah menurun."],
                    ["Mengapa tidak boleh dibuang sembarangan?", "Dapat menyebabkan penyumbatan saluran air (clogging), pencemaran tanah, dan merusak ekosistem air bersih."],
                    ["Bolehkah digunakan kembali untuk memasak?", "Sangat tidak disarankan. Penggunaan berulang memicu zat karsinogenik yang berbahaya bagi kesehatan jantung dan pembuluh darah."],
                    ["Bagaimana cara menyimpan sebelum disetor?", "Tunggu minyak hingga dingin, saring dari sisa kotoran, lalu simpan dalam wadah plastik atau jerigen yang tertutup rapat."],
                    ["Apa syarat minimal volume penjemputan?", "Untuk layanan penjemputan langsung ke rumah, minimal volume adalah 5 liter. Jika kurang, Anda bisa menyetorkannya ke drop point terdekat."],
                    ["Apakah saya akan mendapatkan uang dari setoran ini?", "Ya, setiap liter minyak jelantah yang divalidasi akan dikonversi menjadi saldo digital di dashboard akun Greasycle Anda."],
                    ["Bagaimana cara mencairkan saldo Greasycle?", "Saldo dapat dicairkan melalui menu 'Tarik Saldo' di dashboard ke berbagai e-wallet atau transfer bank yang tersedia."],
                    ["Berapa lama waktu penjemputan setelah saya request?", "Mitra kurir kami akan menjemput dalam waktu 1-2 hari kerja sesuai dengan jadwal yang Anda pilih di aplikasi."],
                    ["Minyak jelantah ini akan diolah menjadi apa?", "Greasycle bekerja sama dengan pengolah limbah untuk mengubah jelantah menjadi Biodiesel (Energi Terbarukan) yang ramah lingkungan."],
                    ["Apakah layanan penjemputan ini dipungut biaya?", "Tidak, layanan penjemputan Greasycle sepenuhnya gratis. Anda justru mendapatkan insentif dari limbah yang Anda salurkan."]
                ];

                foreach($faqs as $i => $faq): ?>
                <div class="faq-item border border-gray-200 rounded-2xl bg-[#fcfdfd] transition duration-300">
                    <button class="w-full p-5 flex justify-between items-center text-left focus:outline-none" onclick="toggleFaq(<?= $i ?>)">
                        <span class="font-bold text-primary text-sm"><?= ($i+1) . ". " . $faq[0] ?></span>
                        <i class="faq-chevron fas fa-chevron-down text-secondary text-xs transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-5">
                        <p class="pb-5 text-gray-500 text-sm italic text-left"><?= $faq[1] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            </div>

            <div class="sticky top-32 hidden md:block">
                <img src="assets/images/foto-1.jpeg" class="w-full h-[500px] object-cover rounded-[40px] shadow-2xl transition hover:scale-[1.02] duration-500">
            </div>
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
    // Navbar Mobile Toggle
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('mobile-menu');
    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
        menu.classList.toggle('flex');
    });

    // FAQ Toggle
    function toggleFaq(index) {
        const items = document.querySelectorAll('.faq-item');
        items.forEach((item, i) => {
            if (i === index) item.classList.toggle('active');
            else item.classList.remove('active');
        });
    }
</script>
</body>
</html>