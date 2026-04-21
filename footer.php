<div id="authModal" class="modal-auth">
    <div class="modal-content shadow-2xl border border-gray-100 text-left">
        <div id="loginArea">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-primary">Masuk Akun</h2>
                <button onclick="closeAuth()" class="text-gray-400 hover:text-red-500 transition"><i class="fas fa-times text-xl"></i></button>
            </div>
            <form action="login.php" method="POST" class="space-y-5">
                <input type="email" name="email" placeholder="Email" class="w-full p-4 bg-gray-50 border rounded-2xl focus:outline-secondary text-sm" required>
                <input type="password" name="password" placeholder="Password" class="w-full p-4 bg-gray-50 border rounded-2xl focus:outline-secondary text-sm" required>
                <button type="submit" name="login" class="w-full bg-primary text-white py-4 rounded-2xl font-bold hover:bg-secondary transition shadow-lg">Masuk Sekarang</button>
            </form>
            <p class="text-center text-sm mt-8 text-gray-500">Belum punya akun? <a href="javascript:void(0)" onclick="switchForm('register')" class="text-secondary font-bold no-underline hover:underline">Daftar</a></p>
        </div>

        <div id="registerArea" class="hidden-form">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-primary">Daftar Akun</h2>
                <button onclick="closeAuth()" class="text-gray-400 hover:text-red-500 transition"><i class="fas fa-times text-xl"></i></button>
            </div>
            <form action="register.php" method="POST" onsubmit="return validateReg(event)" class="space-y-4">
                <input type="text" id="regNama" name="nama" placeholder="Nama Lengkap" class="w-full p-3 bg-gray-50 border rounded-2xl text-sm" required>
                <input type="text" id="regTelp" name="no_telp" placeholder="No. Telepon" class="w-full p-3 bg-gray-50 border rounded-2xl text-sm" required>
                <input type="email" name="email" placeholder="Email" class="w-full p-3 bg-gray-50 border rounded-2xl text-sm" required>
                <input type="password" id="regPass" name="password" placeholder="Password" class="w-full p-3 bg-gray-50 border rounded-2xl text-sm" required>
                <select name="role" class="w-full p-3 bg-gray-50 border rounded-2xl text-sm focus:outline-secondary" required>
                    <option value="pelanggan">Ibu Rumah Tangga</option>
                    <option value="usaha">Pelaku Usaha (Resto/Cafe)</option>
                    <option value="mitra">Mitra (Pengepul Minyak)</option>
                </select>
                <button type="submit" name="register" class="w-full bg-secondary text-white py-4 rounded-2xl font-bold shadow-lg mt-2">Daftar Sekarang</button>
            </form>
            <p class="text-center text-sm mt-6 text-gray-500">Sudah punya akun? <a href="javascript:void(0)" onclick="switchForm('login')" class="text-primary font-bold no-underline hover:underline">Masuk</a></p>
        </div>
    </div>
</div>

<footer class="bg-primary pt-24 pb-12 mt-20">
    <div class="container mx-auto px-[8%]">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4 mb-12 md:w-1/3">
                <h3 class="font-bold text-xl text-white mb-6 uppercase tracking-wider">Hubungi Kami</h3>
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
                <ul class="text-accent opacity-80 space-y-4 text-sm list-none p-0 m-0">
                    <li>Setor Jelantah</li>
                    <li>Penjemputan Rutin</li>
                    <li>Edukasi Ramah Lingkungan</li>
                    <li>Insentif Ekonomi</li>
                </ul>
            </div>

            <div class="w-full px-4 mb-12 md:w-1/3">
                <h3 class="font-semibold text-xl text-white mb-8 uppercase tracking-wider">Tautan</h3>
                <ul class="text-accent opacity-80 space-y-4 text-sm list-none p-0 m-0">
                    <?php 
                        $path = (basename(dirname($_SERVER['PHP_SELF'])) == 'pelanggan' || basename(dirname($_SERVER['PHP_SELF'])) == 'mitra' || basename(dirname($_SERVER['PHP_SELF'])) == 'admin') ? '../' : '';
                    ?>
                    <li><a href="<?= $path ?>index.php" class="footer-link">Beranda</a></li>
                    <li><a href="<?= $path ?>about.php" class="footer-link">Tentang Kami</a></li>
                    <li><a href="<?= $path ?>contact.php" class="footer-link">Kontak</a></li>
                    <li><a href="<?= $path ?>portofolio.php" class="footer-link">Portofolio</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="text-center mt-20 border-t border-white/10 pt-10 px-4 text-white">
        <p class="text-[10px] uppercase tracking-[0.2em] opacity-40">Pemrograman Website © 2026 Greasycle</p>
    </div>
</footer>

<script>
    // Navigasi Mobile
    const btnMenu = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (btnMenu && mobileMenu) {
        btnMenu.onclick = () => {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('flex');
        };
    }

    // Modal Auth Logic
    const modalAuth = document.getElementById('authModal');
    const loginArea = document.getElementById('loginArea');
    const registerArea = document.getElementById('registerArea');

    function openAuth() { 
        if(modalAuth) modalAuth.style.display = 'block'; 
        switchForm('login'); 
    }
    function closeAuth() { if(modalAuth) modalAuth.style.display = 'none'; }
    function switchForm(type) {
        if(loginArea && registerArea) {
            loginArea.style.display = (type === 'login') ? 'block' : 'none';
            registerArea.style.display = (type === 'register') ? 'block' : 'none';
        }
    }
    function validateReg(e) {
        const nama = document.getElementById('regNama').value;
        const telp = document.getElementById('regTelp').value;
        const pass = document.getElementById('regPass').value;
        if (nama.length < 3 || isNaN(telp) || telp.length < 10 || pass.length < 6) { 
            alert("Data tidak valid!"); return false; 
        }
        return true;
    }
    window.onclick = (e) => { if (e.target == modalAuth) closeAuth(); };
</script>

<style>
    /* CSS Khusus Link yang Bisa Diklik */
    .footer-link {
        color: #d1e7e0 !important;
        text-decoration: none !important;
        border-bottom: none !important;
        transition: all 0.3s ease;
        display: inline-block;
    }
    .footer-link:hover {
        color: white !important;
        transform: translateX(5px); /* Efek geser hanya untuk Tautan */
        text-decoration: none !important;
    }
    /* Mematikan default browser visited style */
    .footer-link:visited, .footer-link:active {
        text-decoration: none !important;
        border-bottom: none !important;
    }
</style>

</body>
</html>