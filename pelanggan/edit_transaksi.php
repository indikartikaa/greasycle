<?php
session_start();
include '../koneksi.php';

// 1. PROTEKSI & AMBIL DATA LAMA
if (!isset($_GET['id'])) { header("location: dashboard.php"); exit(); }
$id_trx = $_GET['id'];
$id_user = $_SESSION['id_user'];

$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi = '$id_trx' AND id_user = '$id_user'");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ketemu atau status sudah bukan 'menunggu', tendang balik
if (!$data || $data['status'] !== 'menunggu') {
    echo "<script>alert('Data tidak dapat diubah!'); window.location='dashboard.php';</script>";
    exit();
}

// 2. PROSES UPDATE (SERVER-SIDE VALIDATION)
if (isset($_POST['update'])) {
    $volume = mysqli_real_escape_string($conn, $_POST['volume']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    // Validasi Server-side: Pastikan volume adalah angka dan tidak kosong
    if (empty($volume) || !is_numeric($volume) || $volume <= 0) {
        $error = "Volume harus berupa angka lebih dari 0!";
    } else {
        $sql = "UPDATE transaksi SET volume = '$volume', alamat_jemput = '$alamat' WHERE id_transaksi = '$id_trx'";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Data berhasil diperbarui!'); window.location='dashboard.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Setoran - Greasycle</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-10">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-3xl shadow-md">
        <h2 class="text-2xl font-bold text-[#004030] mb-6">Edit Laporan Setoran</h2>

        <?php if(isset($error)): ?>
            <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 text-sm"><?= $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST" onsubmit="return validateForm()" class="space-y-4">
            <div>
                <label class="block text-sm font-bold mb-1">Volume (Liter)</label>
                <input type="number" name="volume" id="volume" value="<?= $data['volume']; ?>" 
                    class="w-full p-3 border rounded-xl focus:outline-green-600">
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">Alamat Penjemputan</label>
                <textarea name="alamat" id="alamat" class="w-full p-3 border rounded-xl focus:outline-green-600"><?= $data['alamat_jemput']; ?></textarea>
            </div>
            <div class="flex gap-3 pt-4">
                <a href="dashboard.php" class="flex-1 text-center py-3 border rounded-xl text-gray-400">Batal</a>
                <button type="submit" name="update" class="flex-1 bg-[#004030] text-white py-3 rounded-xl font-bold">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <script>
    function validateForm() {
        const volume = document.getElementById('volume').value;
        const alamat = document.getElementById('alamat').value;

        if (volume === "" || volume <= 0) {
            alert("Harap masukkan volume yang valid!");
            return false;
        }
        if (alamat.length < 10) {
            alert("Alamat harus lebih detail (minimal 10 karakter)!");
            return false;
        }
        return true;
    }
    </script>
</body>
</html>