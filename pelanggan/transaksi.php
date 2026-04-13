<?php
session_start();
include '../koneksi.php';

// Proteksi: Hanya pelanggan yang boleh masuk
if (!isset($_SESSION['nama']) || $_SESSION['role'] !== 'pelanggan') {
    header("location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setor Minyak - Greasycle</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-[#fcfdfd] text-[#333] p-6">

    <div class="max-w-md mx-auto bg-white p-8 rounded-[30px] shadow-xl border border-gray-100 mt-10">
        <div class="flex items-center gap-3 mb-8">
            <a href="dashboard.php" class="text-gray-400 hover:text-primary transition"><i class="fas fa-arrow-left text-xl"></i></a>
            <h2 class="text-2xl font-bold text-primary ">Setor Minyak</h2>
        </div>

        <form action="proses_setor.php" method="POST" class="space-y-6">
            <div>
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-2">Estimasi Volume (Liter)</label>
                <input type="number" name="volume" step="0.1" min="0.1" placeholder="Contoh: 2.5" 
                       class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-secondary transition-all" required>
            </div>

            <div>
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-2">Alamat Lengkap Penjemputan</label>
                <textarea name="alamat_jemput" placeholder="Jl. Semolowaru No. XX..." rows="3"
                          class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-secondary transition-all" required></textarea>
            </div>

            <div>
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-2">Catatan (Opsional)</label>
                <input type="text" name="catatan" placeholder="Contoh: Pagar warna hitam" 
                       class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-secondary transition-all">
            </div>

            <button type="submit" name="submit_setor" 
        class="w-full bg-[#004030] hover:bg-[#2d6a4f] text-white py-4 rounded-2xl font-bold shadow-lg transition-all duration-300 block">
    Konfirmasi Setoran
</button>
        </form>
    </div>

</body>
</html>