<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwalkan Penjemputan - Greasycle</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800">

    <nav class="flex justify-between items-center px-[8%] py-5 bg-white shadow-sm">
        <a href="index.html" class="text-2xl font-extrabold text-[#335f4b]">Greasycle</a>
        <a href="index.html" class="text-sm font-semibold text-[#335f4b] hover:underline">Kembali ke Home</a>
    </nav>

    <main class="flex items-center justify-center min-h-[80vh] px-5 py-10">
        <div class="bg-white p-8 md:p-10 rounded-3xl shadow-xl shadow-slate-200 w-full max-w-lg border border-slate-100">
            <div class="text-center mb-8">
                <i class="fas fa-truck-pickup text-4xl text-[#00a878] mb-3"></i>
                <h2 class="text-2xl font-bold text-[#335f4b]">Form Penjemputan</h2>
                <p class="text-sm text-slate-500">Isi data di bawah untuk jadwal pengambilan minyak.</p>
            </div>

            <form action="" method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold mb-2">Alamat Lengkap</label>
                    <textarea name="alamat" required placeholder="Jl. Semampir No. 123, Surabaya" 
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-[#00a878] focus:ring-1 focus:ring-[#00a878] outline-none transition"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Jumlah (Liter)</label>
                    <input type="number" step="0.01" name="liter" required placeholder="Contoh: 5.5"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-[#00a878] focus:ring-1 focus:ring-[#00a878] outline-none transition">
                </div>

                <button type="submit" name="submit" 
                    class="w-full py-4 bg-[#335f4b] text-white font-bold rounded-xl hover:bg-[#00a878] transform hover:-translate-y-1 transition duration-300 shadow-lg">
                    Kirim Jadwal Penjemputan
                </button>
            </form>

            <?php
            if (isset($_POST['submit'])) {
                $id_user = 1; // ID User dummy (Syarat Master-Transaksi)
                $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
                $liter = $_POST['liter'];

                $query = "INSERT INTO penjemputan (id_user, alamat, liter) VALUES ('$id_user', '$alamat', '$liter')";

                if (mysqli_query($conn, $query)) {
                    echo "
                    <div class='mt-6 p-4 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl text-center text-sm'>
                        <i class='fas fa-check-circle mr-1'></i> ✅ Data berhasil dikirim ke database!
                    </div>";
                } else {
                    echo "
                    <div class='mt-6 p-4 bg-red-50 text-red-700 border border-red-200 rounded-xl text-center text-sm'>
                        ❌ Gagal: " . mysqli_error($conn) . "
                    </div>";
                }
            }
            ?>
        </div>
    </main>

</body>
</html>