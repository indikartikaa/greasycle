<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Greasycle</title>
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
        /* Style Modal Login & Register sesuai kriteria interaktivitas JS */
        .modal-auth { display: none; position: fixed; z-index: 3000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); }
        .modal-content { background: white; padding: 40px; width: 90%; max-width: 450px; border-radius: 30px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); }
        .hidden-form { display: none; }
    </style>
</head>
<body class="bg-[#f7faf9] text-[#333] leading-relaxed overflow-x-hidden">

<nav class="bg-white flex justify-between items-center py-4 px-[8%] sticky top-0 z-[1000] shadow-md">
    <div class="text-2xl font-bold text-primary">Greasycle</div>
    <ul class="flex list-none gap-6 items-center">
        <li><a href="index.html" class="text-primary font-bold border-b-2 border-primary">Beranda</a></li>
        <li><a href="about.html" class="text-[#666] font-medium transition duration-300 hover:text-primary">Tentang</a></li>
        <li><a href="contact.html" class="text-[#666] font-medium transition duration-300 hover:text-primary">Kontak</a></li>
        <li><a href="portofolio.html" class="text-[#666] font-medium transition duration-300 hover:text-primary">Portfolio</a></li>
        <li><button onclick="openAuth()" class="bg-primary text-white px-6 py-2 rounded-full font-bold hover:bg-secondary transition ml-4 shadow-md">Login</button></li>
    </ul>
</nav>

<header class="relative bg-cover bg-center text-white py-20 px-[8%] text-center overflow-hidden"
        style="background-image: linear-gradient(rgba(0,64,48,0.85), rgba(0,64,48,0.85)), url('assets/foto-2.jpeg')">
    <div class="max-w-4xl mx-auto relative z-10">
        <h1 class="text-4xl md:text-5xl font-bold mb-6 tracking-tight leading-tight">
            Ubah Limbah Jadi <span class="text-accent italic">Energi Hijau</span>
        </h1>
        <p class="text-base md:text-lg opacity-90 mb-10 font-light max-w-2xl mx-auto leading-relaxed">
            Kelola minyak jelantah Anda secara cerdas bersama Greasycle. Ciptakan lingkungan bersih dan dapatkan manfaat ekonominya.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <button onclick="openAuth()" class="bg-white text-primary px-8 py-3 rounded-full font-bold hover:bg-accent transition shadow-xl text-sm">Mulai Sekarang</button>
            <a href="about.html" class="border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-white/10 transition text-sm">Pelajari Lebih Lanjut</a>
        </div>
    </div>
</header>

<section class="py-24 px-[8%] bg-white text-center">
    <div class="max-w-6xl mx-auto">
        <div class="mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Layanan Kami</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">Memberikan solusi pengelolaan limbah yang mudah dan terintegrasi untuk masyarakat.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-10 bg-[#fcfdfd] border border-gray-100 rounded-[30px] shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300 group">
                <div class="w-16 h-16 bg-accent rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-primary transition duration-300">
                    <i class="fas fa-truck-loading text-2xl text-primary group-hover:text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-primary mb-4">Penjemputan Rutin</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Kami menjemput minyak jelantah langsung dari dapur Anda secara terjadwal.</p>
            </div>
            <div class="p-10 bg-[#fcfdfd] border border-gray-100 rounded-[30px] shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300 group">
                <div class="w-16 h-16 bg-accent rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-primary transition duration-300">
                    <i class="fas fa-seedling text-2xl text-primary group-hover:text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-primary mb-4">Ramah Lingkungan</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Limbah yang dikumpulkan diolah menjadi biofuel untuk masa depan yang lebih hijau.</p>
            </div>
            <div class="p-10 bg-[#fcfdfd] border border-gray-100 rounded-[30px] shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300 group">
                <div class="w-16 h-16 bg-accent rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-primary transition duration-300">
                    <i class="fas fa-wallet text-2xl text-primary group-hover:text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-primary mb-4">Insentif Ekonomi</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Dapatkan nilai ekonomi atau poin untuk setiap liter jelantah yang Anda salurkan.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-24 px-[8%] bg-accent/20 text-center">
    <div class="max-w-6xl mx-auto">
        <div class="mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Our Founders</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">Kenali tim mahasiswa Sistem Informasi di balik layar Greasycle.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <a href="profile-elvina.html" class="bg-white p-8 rounded-[40px] shadow-sm hover:shadow-2xl transition duration-500 group overflow-hidden block">
                <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 text-primary group-hover:scale-110 transition duration-500">
                    <i class="fas fa-user-circle text-5xl"></i> 
                </div>
                <h3 class="text-lg font-bold text-primary">Elvina Meisya Azzahra</h3>
                <span class="text-xs text-secondary font-semibold tracking-widest uppercase">UI/UX Designer</span>
            </a>
            <a href="profile-zahlul.html" class="bg-white p-8 rounded-[40px] shadow-sm hover:shadow-2xl transition duration-500 group overflow-hidden block">
                <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 text-primary group-hover:scale-110 transition duration-500">
                    <i class="fas fa-user-circle text-5xl"></i>
                </div>
                <h3 class="text-lg font-bold text-primary">Zahlul Noer Laily</h3>
                <span class="text-xs text-secondary font-semibold tracking-widest uppercase">Lead Developer</span>
            </a>
            <a href="profile-indi.html" class="bg-white p-8 rounded-[40px] shadow-sm hover:shadow-2xl transition duration-500 group overflow-hidden block">
                <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 text-primary group-hover:scale-110 transition duration-500">
                    <i class="fas fa-user-circle text-5xl"></i>
                </div>
                <h3 class="text-lg font-bold text-primary">Masyito Indi Kartika</h3>
                <span class="text-xs text-secondary font-semibold tracking-widest uppercase">System Analyst</span>
            </a>
        </div>
    </div>
</section>

<div id="authModal" class="modal-auth">
    <div class="modal-content shadow-2xl border border-gray-100">
        <div id="loginArea">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-primary">Masuk Akun</h2>
                <button onclick="closeAuth()" class="text-gray-400 hover:text-red-500 transition"><i class="fas fa-times text-xl"></i></button>
            </div>
            <form action="proses_login.php" method="POST" class="space-y-5">
                <input type="email" name="email" placeholder="Email" class="w-full p-4 bg-gray-50 border rounded-2xl focus:outline-secondary text-sm" required>
                <input type="password" name="password" placeholder="Password" class="w-full p-4 bg-gray-50 border rounded-2xl focus:outline-secondary text-sm" required>
                <button type="submit" name="login" class="w-full bg-primary text-white py-4 rounded-2xl font-bold hover:bg-secondary transition shadow-lg">Masuk Sekarang</button>
            </form>
            <p class="text-center text-sm mt-8 text-gray-500">Belum punya akun? <a href="javascript:void(0)" onclick="switchForm('register')" class="text-secondary font-bold hover:underline">Daftar</a></p>
        </div>

        <div id="registerArea" class="hidden-form">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-primary">Daftar Pelanggan</h2>
                <button onclick="closeAuth()" class="text-gray-400 hover:text-red-500 transition"><i class="fas fa-times text-xl"></i></button>
            </div>
            <form id="regForm" action="proses_register.php" method="POST" onsubmit="return validateReg(event)" class="space-y-4">
                <input type="text" id="regNama" name="nama" placeholder="Nama Lengkap" class="w-full p-3 bg-gray-50 border rounded-2xl text-sm" required>
                <input type="text" id="regTelp" name="no_telp" placeholder="No. Telepon" class="w-full p-3 bg-gray-50 border rounded-2xl text-sm" required>
                <input type="email" name="email" placeholder="Email" class="w-full p-3 bg-gray-50 border rounded-2xl text-sm" required>
                <input type="password" id="regPass" name="password" placeholder="Password" class="w-full p-3 bg-gray-50 border rounded-2xl text-sm" required>
                <button type="submit" name="register" class="w-full bg-secondary text-white py-4 rounded-2xl font-bold shadow-lg">Daftar Sekarang</button>
            </form>
            <p class="text-center text-sm mt-6 text-gray-500">Sudah punya akun? <a href="javascript:void(0)" onclick="switchForm('login')" class="text-primary font-bold hover:underline">Masuk</a></p>
        </div>
    </div>
</div>

<!-- Footer -->
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
                    <li><a href="index.html" class="text-base hover:text-white transition duration-300 underline">Beranda</a></li>
                    <li><a href="about.html" class="text-base hover:text-white transition duration-300">Tentang Kami</a></li>
                    <li><a href="contact.html" class="text-base hover:text-white transition duration-300">Kontak</a></li>
                    <li><a href="portofolio.html" class="text-base hover:text-white transition duration-300">Portofolio</a></li>
                </ul>
            </div>
        </div>

        <div class="w-full pt-10 border-t border-white/10 mt-10 text-center px-4">
            <div class="flex flex-col items-center">
                <p class="font-medium text-[11px] sm:text-xs text-white uppercase tracking-[0.25em] mb-2 leading-relaxed">
                    Masa Depan Bumi yang Lebih Hijau Kini dalam Genggamanmu.
                </p>
                <p class="font-normal text-[10px] sm:text-[11px] text-white/40 uppercase tracking-[0.2em]">
                    Pemrograman Website © 2026 Greasycle
                </p>
            </div>
        </div>
    </div>
</footer>

<script>
    // JS Interaktivitas Modal [cite: 16, 29]
    function openAuth() { 
        document.getElementById('authModal').style.display = 'block'; 
        switchForm('login'); 
    }
    function closeAuth() { document.getElementById('authModal').style.display = 'none'; }
    
    function switchForm(type) {
        document.getElementById('loginArea').style.display = (type === 'login') ? 'block' : 'none';
        document.getElementById('registerArea').style.display = (type === 'register') ? 'block' : 'none';
    }

    // Validasi Client-Side JS (Requirement UTS Dosen) 
    function validateReg(e) {
        const nama = document.getElementById('regNama').value;
        const telp = document.getElementById('regTelp').value;
        const pass = document.getElementById('regPass').value;

        if (nama.length < 3) {
            alert("Nama harus lebih dari 3 karakter!");
            e.preventDefault();
            return false;
        }
        if (isNaN(telp) || telp.length < 10) {
            alert("Nomor telepon tidak valid!");
            e.preventDefault();
            return false;
        }
        if (pass.length < 6) {
            alert("Password minimal 6 karakter!");
            e.preventDefault();
            return false;
        }
        return true;
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('authModal')) closeAuth();
    }
</script>
</body>
</html>