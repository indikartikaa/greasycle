<?php include 'header.php'; ?>

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
            <a href="about.php" class="border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-white/10 transition text-sm">Pelajari Lebih Lanjut</a>
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
            <a href="profile-elvina.php" class="bg-white p-8 rounded-[40px] shadow-sm hover:shadow-2xl transition duration-500 group block">
                <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 text-primary group-hover:scale-110 transition duration-500">
                    <i class="fas fa-user-circle text-5xl"></i> 
                </div>
                <h3 class="text-lg font-bold text-primary">Elvina Meisya Azzahra</h3>
                <span class="text-xs text-secondary font-semibold tracking-widest uppercase">UI/UX Designer</span>
            </a>
            <a href="profile-zahlul.php" class="bg-white p-8 rounded-[40px] shadow-sm hover:shadow-2xl transition duration-500 group block">
                <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 text-primary group-hover:scale-110 transition duration-500">
                    <i class="fas fa-user-circle text-5xl"></i>
                </div>
                <h3 class="text-lg font-bold text-primary">Zahlul Noer Laily</h3>
                <span class="text-xs text-secondary font-semibold tracking-widest uppercase">Lead Developer</span>
            </a>
            <a href="profile-indi.php" class="bg-white p-8 rounded-[40px] shadow-sm hover:shadow-2xl transition duration-500 group block">
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
            <form action="login.php" method="POST" class="space-y-5">
                <input type="email" name="email" placeholder="Email" class="w-full p-4 bg-gray-50 border rounded-2xl focus:outline-secondary text-sm" required>
                <input type="password" name="password" placeholder="Password" class="w-full p-4 bg-gray-50 border rounded-2xl focus:outline-secondary text-sm" required>
                <button type="submit" name="login" class="w-full bg-primary text-white py-4 rounded-2xl font-bold hover:bg-secondary transition shadow-lg">Masuk Sekarang</button>
            </form>
            <p class="text-center text-sm mt-8 text-gray-500">Belum punya akun? <a href="javascript:void(0)" onclick="switchForm('register')" class="text-secondary font-bold hover:underline">Daftar</a></p>
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
            <p class="text-center text-sm mt-6 text-gray-500">Sudah punya akun? <a href="javascript:void(0)" onclick="switchForm('login')" class="text-primary font-bold hover:underline">Masuk</a></p>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>