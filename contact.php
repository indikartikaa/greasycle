<?php 
session_start(); 
include 'koneksi.php'; 

$nama_login = isset($_SESSION['nama']) ? $_SESSION['nama'] : '';
$email_login = isset($_SESSION['email']) ? $_SESSION['email'] : '';

if (isset($_POST['kirim_saran'])) {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $pesan    = mysqli_real_escape_string($conn, $_POST['pesan']);
    $tgl       = date('Y-m-d');

    if (!empty($nama) && !empty($pesan)) {
        $query = "INSERT INTO saran (nama, email, kategori, pesan, tanggal) 
                  VALUES ('$nama', '$email', '$kategori', '$pesan', '$tgl')";
        
        if (mysqli_query($conn, $query)) {
            $success_msg = "Terima kasih, masukan Anda telah terkirim!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kritik & Saran - Greasycle</title>
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
    <li><a href="contact.php" class="text-primary font-bold border-b-2 border-primary pb-1">Kontak</a></li>
    <li><a href="portofolio.php" class="text-[#666] font-medium transition duration-300 hover:text-primary">Portofolio</a></li>
    
    <li> <?php if(isset($_SESSION['nama'])): ?>
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

    <ul id="mobile-menu" class="hidden flex-col absolute top-[100%] left-0 w-full bg-white shadow-lg p-6 space-y-4 md:hidden border-t border-gray-100">
        <li><a href="index.php" class="block text-[#666]">Beranda</a></li>
        <li><a href="about.php" class="block text-[#666]">Tentang</a></li>
        <li><a href="contact.php" class="block text-primary font-bold">Kontak</a></li>
        <li><a href="portofolio.php" class="block text-[#666]">Portofolio</a></li>
    </ul>
</nav>

<main>
    <section class="relative bg-cover bg-center text-white text-center py-16 md:py-20 px-5" 
             style="background-image: linear-gradient(rgba(0,64,48,0.85), rgba(0,64,48,0.85))">
        <h1 class="text-3xl md:text-4xl font-bold mb-3 text-white tracking-tight">Hubungi Kami</h1>
        <p class="text-base md:text-lg opacity-90 text-white max-w-2xl mx-auto font-light">
            Pendapatmu sangat berarti untuk membuat Greasycle lebih baik.
        </p>
    </section>

    <section class="py-12 md:py-20 px-[8%] bg-white">
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            <div class="space-y-6">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-primary mb-3">Suaramu, Perubahan Nyata</h2>
                    <p class="text-gray-500 text-sm leading-relaxed text-justify">Kami percaya bahwa platform yang baik lahir dari masukan yang jujur. Bagikan pengalamanmu baik pujian, kritik, maupun ide segar.</p>
                </div>
                <img src="assets/images/foto-2.jpeg" class="w-full h-48 md:h-auto object-cover rounded-[20px] shadow-[8px_8px_0px_0px_#d1e7e0]" alt="Feedback">
                
                <div class="space-y-4 pt-2">
                    <div class="flex items-center gap-3 text-sm text-gray-500 italic"><i class="fas fa-envelope text-primary"></i> info@greasycle.id</div>
                    <div class="flex items-center gap-3 text-sm text-gray-500 italic"><i class="fas fa-phone-alt text-primary"></i> +62 812-3456-7890</div>
                    <div class="flex items-center gap-3 text-sm text-gray-500 italic"><i class="fas fa-clock text-primary"></i> Senin-Jumat: 08.00 - 16.00 WIB</div>
                </div>
            </div>

            <div class="bg-white p-6 md:p-8 rounded-[25px] shadow-md border border-gray-100">
                <?php if(isset($success_msg)): ?>
                    <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 text-sm font-bold border border-green-200 fade-in text-center">
                        <i class="fas fa-check-circle mr-2"></i> <?= $success_msg; ?>
                    </div>
                <?php endif; ?>

                <form id="contactForm" method="POST" action="" class="space-y-5">
                    <div class="flex flex-col gap-1">
                        <label class="font-bold text-primary text-[10px] md:text-xs uppercase tracking-widest ml-1">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" required value="<?= $nama_login; ?>" placeholder="Nama Anda"
                            class="p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:border-secondary transition text-sm">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-bold text-primary text-[10px] md:text-xs uppercase tracking-widest ml-1">Email</label>
                        <input type="email" name="email" id="email" required value="<?= $email_login; ?>" placeholder="email@contoh.com"
                            class="p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:border-secondary transition text-sm">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-bold text-primary text-[10px] md:text-xs uppercase tracking-widest ml-1">Kategori</label>
                        <select name="kategori" id="kategori" required class="p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:border-secondary transition text-sm text-gray-500">
                            <option value="" disabled selected>Pilih kategori</option>
                            <option value="Layanan">Layanan Penjemputan</option>
                            <option value="Aplikasi">Tampilan Website</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-bold text-primary text-[10px] md:text-xs uppercase tracking-widest ml-1">Pesan</label>
                        <textarea name="pesan" id="pesan" rows="4" required placeholder="Tuliskan masukan kamu..."
                            class="p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:border-secondary transition text-sm resize-none"></textarea>
                    </div>
                    <button type="submit" name="kirim_saran" class="w-full bg-primary text-white py-4 rounded-2xl font-bold hover:bg-secondary transition duration-300 shadow-md text-sm">
                        Kirim Masukan
                    </button>
                </form>
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
</body>
</html>