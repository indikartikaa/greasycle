<?php
session_start();
include '../koneksi.php';

if (isset($_POST['update_volume'])) {
    $id_trx = $_POST['id_transaksi'];
    $vol_baru = $_POST['volume_baru'];
    
    $update = mysqli_query($conn, "UPDATE transaksi SET volume='$vol_baru' WHERE id_transaksi='$id_trx'");
    
    if($update) {
        echo "<script>alert('Volume berhasil divalidasi!'); window.location='tugas-penjemputan.php';</script>";
    }
}

// 1. PROTEKSI HALAMAN
if (!isset($_SESSION['nama']) || $_SESSION['role'] !== 'mitra') {
    header("location: ../index.php");
    exit();
}

$id_mitra = $_SESSION['id_user'];
$nama_mitra = $_SESSION['nama'];

// 2. LOGIKA PROSES (Ambil, Selesai, Batal)
if (isset($_GET['aksi']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $aksi = $_GET['aksi'];

    if ($aksi == 'ambil') {
        mysqli_query($conn, "UPDATE transaksi SET status='dijemput', id_mitra='$id_mitra' WHERE id_transaksi='$id'");
        echo "<script>alert('Tugas berhasil diambil!'); window.location='tugas-penjemputan.php';</script>";
   } elseif ($aksi == 'selesai') {
    // Tambahkan WHERE id_mitra agar yang bisa menyelesaikan cuma yang mengambil
        mysqli_query($conn, "UPDATE transaksi SET status='selesai' WHERE id_transaksi='$id' AND id_mitra='$id_mitra'");
        echo "<script>alert('Tugas selesai! Cek di menu Riwayat.'); window.location='riwayat.php';</script>";
    } elseif ($aksi == 'batal') {
        mysqli_query($conn, "UPDATE transaksi SET status='menunggu', id_mitra=NULL WHERE id_transaksi='$id'");
        echo "<script>alert('Tugas dibatalkan.'); window.location='dashboard.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Penjemputan - Greasycle</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: '#004030', secondary: '#2d6a4f', accent: '#d1e7e0' }
                }
            }
        }
    </script>
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-[#f4f7f6] text-[#333]">

<aside class="fixed top-0 left-0 h-screen w-64 bg-primary flex flex-col z-50">
    <div class="px-6 py-5 border-b border-white/10">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-white/20 rounded-xl flex items-center justify-center">
                <i class="fas fa-recycle text-white text-sm"></i>
            </div>
            <span class="text-white font-bold text-lg">Greasycle</span>
        </div>
        <p class="text-white/40 text-[10px] mt-1 ml-12 uppercase tracking-widest">Portal Mitra</p>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1">
        <a href="dashboard.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 text-sm font-medium hover:bg-white/10 transition">
            <i class="fas fa-th-large w-5 text-center"></i> Dashboard
        </a>
        <a href="tugas-penjemputan.php" class="sidebar-link bg-white/15 flex items-center gap-3 px-4 py-3 rounded-xl text-white text-sm font-medium">
            <i class="fas fa-clipboard-list w-5 text-center"></i> Tugas Penjemputan
        </a>
        <a href="riwayat.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 text-sm font-medium hover:bg-white/10 transition">
            <i class="fas fa-history w-5 text-center"></i> Riwayat
        </a>
    </nav>

    <div class="px-4 py-4 border-t border-white/10">
        <div class="flex items-center gap-3 px-3 py-3 rounded-xl bg-white/10">
            <div class="w-10 h-10 bg-secondary rounded-full flex items-center justify-center font-bold text-white text-sm uppercase">
                <?= substr($nama_mitra, 0, 1); ?>
            </div>
            <p class="text-white text-xs font-semibold truncate"><?= $nama_mitra; ?></p>
        </div>
        <a href="../logout.php" class="mt-3 flex items-center gap-2 px-4 py-2 text-white/50 hover:text-red-300 transition text-xs">
            <i class="fas fa-sign-out-alt"></i> Keluar
        </a>
    </div>
</aside>

<div class="ml-64 min-h-screen">
    <header class="bg-white border-b border-gray-100 px-8 py-4 flex justify-between items-center sticky top-0 z-40">
        <div>
            <h1 class="text-xl font-bold text-primary">Tugas Penjemputan</h1>
            <p class="text-xs text-gray-400">Daftar tugas yang sedang kamu tangani</p>
        </div>
        <div class="text-xs text-gray-400 hidden sm:block">
            <?= date('l, d F Y'); ?>
        </div>
    </header>

    <main class="p-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-400 uppercase text-[10px] font-bold">
                    <tr>
                        <th class="px-6 py-4">Aksi</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Alamat & Volume</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php
                    $q_tugas = mysqli_query($conn, "SELECT t.*, u.nama FROM transaksi t JOIN users u ON t.id_user = u.id_user WHERE t.status = 'dijemput' AND t.id_mitra = '$id_mitra'");
                    if(mysqli_num_rows($q_tugas) > 0){
                        while($row = mysqli_fetch_array($q_tugas)){
                    ?>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 flex gap-2">
                            <button onclick="openModal(<?= $row['id_transaksi']; ?>, '<?= $row['volume']; ?>')" 
                            class="bg-amber-500 text-white px-3 py-2 rounded-lg hover:bg-amber-600 transition flex items-center text-xs font-bold">
                                <i class="fas fa-edit mr-2"></i> Validasi
                            </button>

                            <a href="tugas-penjemputan.php?aksi=selesai&id=<?= $row['id_transaksi']; ?>" 
                                class="bg-primary text-white px-3 py-2 rounded-lg hover:bg-secondary transition flex items-center text-xs font-bold">
                                    <i class="fas fa-check mr-2"></i> Selesai
                            </a>
                
                            <a href="tugas-penjemputan.php?aksi=batal&id=<?= $row['id_transaksi']; ?>" 
                               onclick="return confirm('Batalkan penjemputan ini?')"
                               class="bg-white border border-red-100 text-red-500 w-9 h-9 flex items-center justify-center rounded-lg hover:bg-red-50 transition">
                                <i class="fas fa-times"></i>
                            </a>
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-700"><?= $row['nama']; ?></td>
                        <td class="px-6 py-4 text-xs text-gray-500">
                            <p><?= $row['alamat_jemput']; ?></p>
                            <p class="text-primary font-bold mt-1"><?= $row['volume']; ?> L</p>
                        </td>
                    </tr>
                    <?php } } else { ?>
                    <tr>
                        <td colspan="3" class="p-10 text-center text-gray-400 italic">Belum ada tugas yang diambil.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
<div id="modalValidasi" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-[60]">
    <div class="bg-white rounded-[32px] p-8 w-full max-w-md shadow-2xl mx-4">
        <h2 class="text-xl font-bold text-primary mb-6">Validasi Penjemputan</h2>
        
        <form action="tugas-penjemputan.php" method="POST">
            <input type="hidden" name="id_transaksi" id="modal_id">
            
            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Volume Aktual (Liter)</label>
                <input type="number" step="0.01" name="volume_baru" id="modal_volume" 
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/20 text-lg font-semibold" required>
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closeModal()" 
                        class="flex-1 py-3 border border-gray-100 rounded-xl font-bold text-gray-400 hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit" name="update_volume" 
                        class="flex-1 py-3 bg-primary text-white rounded-xl font-bold hover:bg-secondary transition shadow-lg shadow-primary/20">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    function openModal(id, volume) {
        document.getElementById('modal_id').value = id;
        document.getElementById('modal_volume').value = volume;
        document.getElementById('modalValidasi').classList.remove('hidden');
        document.getElementById('modalValidasi').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('modalValidasi').classList.add('hidden');
        document.getElementById('modalValidasi').classList.remove('flex');
    }
</script>
</body>
</html>
