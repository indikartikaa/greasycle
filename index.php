<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $no_telp  = mysqli_real_escape_string($conn, $_POST['no_telp']); // Tambahan Baru
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role     = $_POST['role'];

    // Update Query INSERT dengan kolom no_telp
    $query = "INSERT INTO users (nama, no_telp, email, password, role) 
              VALUES ('$nama', '$no_telp', '$email', '$password', '$role')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registrasi Berhasil!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Greasycle</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-green': '#335f4b',
                        'secondary-green': '#00a878',
                        'bg-light': '#f8fafc',
                    },
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                }
            }
        }
    </script>
    <style> html { scroll-behavior: smooth; } </style>
</head>

<body class="bg-slate-50 text-slate-800 font-sans">

    <nav class="flex justify-between items-center px-[8%] py-5 bg-white sticky top-0 z-50 shadow-sm">
        <a href="index.php" class="text-2xl font-extrabold text-primary-green tracking-tight">Greasycle</a>
        <div class="hidden md:flex gap-8 font-medium text-slate-500">
            <a href="index.php" class="text-primary-green border-b-2 border-primary-green">Home</a>
            <a href="about.html" class="hover:text-primary-green transition">Tentang</a>
            <a href="contact.html" class="hover:text-primary-green transition">Kontak</a>
            <a href="portofolio.html" class="hover:text-primary-green transition">Portofolio</a>
        </div>
        <button onclick="document.getElementById('modalRegister').classList.remove('hidden')" class="bg-primary-green text-white px-6 py-2 rounded-full text-sm font-bold shadow-md">Login/Register</button>
    </nav>

    <header class="h-[80vh] flex items-center justify-center text-center text-white px-5 bg-cover bg-center relative"
        style="background-image: linear-gradient(rgba(51, 95, 75, 0.8), rgba(51, 95, 75, 0.8)), url('https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=1350&q=80');">
        <div class="max-w-3xl z-10">
            <h1 class="text-4xl md:text-6xl font-bold mb-5 leading-tight">Ubah Limbah Jadi <span class="text-secondary-green">Energi Hijau</span></h1>
            <p class="max-w-2xl mx-auto mb-10 opacity-90 text-lg">Kelola minyak jelantah Anda secara cerdas bersama Greasycle.</p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="penjemputan.php" class="w-full sm:w-auto px-10 py-4 bg-secondary-green rounded-full font-bold hover:bg-[#008f66] transition shadow-lg text-center transform hover:-translate-y-1">Mulai Sekarang</a>
            </div>
        </div>
    </header>

    <div id="modalRegister" class="fixed inset-0 bg-black bg-opacity-50 z-[60] flex items-center justify-center hidden p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8 relative">
        <button onclick="document.getElementById('modalRegister').classList.add('hidden')" class="absolute top-4 right-4 text-slate-400 hover:text-red-500 text-xl">&times;</button>
        
        <h2 class="text-2xl font-bold text-primary-green text-center mb-6">Register</h2>
        
        <form action="" method="POST" class="space-y-4">
            <input type="text" name="nama" placeholder="Nama Lengkap" required class="w-full px-4 py-3 rounded-xl bg-slate-100 border-transparent focus:bg-white focus:border-secondary-green outline-none transition">
            
            <input type="text" name="no_telp" placeholder="Nomor Telepon (Contoh: 08123456789)" required class="w-full px-4 py-3 rounded-xl bg-slate-100 border-transparent focus:bg-white focus:border-secondary-green outline-none transition">
            
            <select name="role" required class="w-full px-4 py-3 rounded-xl bg-slate-100 border-transparent focus:bg-white focus:border-secondary-green outline-none transition">
                <option value="" disabled selected>Pilih Role</option>
                <option value="pelanggan">Pelanggan</option>
                <option value="mitra">Mitra</option>
            </select>

            <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-3 rounded-xl bg-slate-100 border-transparent focus:bg-white focus:border-secondary-green outline-none transition">
            
            <input type="password" name="password" placeholder="Password" required class="w-full px-4 py-3 rounded-xl bg-slate-100 border-transparent focus:bg-white focus:border-secondary-green outline-none transition">

            <button type="submit" name="register" class="w-full py-3 bg-secondary-green text-white font-bold rounded-xl hover:bg-primary-green transition duration-300 shadow-lg">
                Register
            </button>
        </form>

        <p class="text-center mt-4 text-sm text-slate-500">Sudah punya akun? <a href="#" class="text-secondary-green font-bold">Login</a></p>
    </div>

    </body>
</html>
