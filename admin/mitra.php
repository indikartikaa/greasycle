<?php
session_start();
include '../koneksi.php';

// Ambil data mitra + users
$query = mysqli_query($koneksi, "
    SELECT 
        mitra.id,
        users.nama,
        users.email,
        mitra.wilayah,
        mitra.kendaraan,
        mitra.status
    FROM mitra
    JOIN users ON mitra.user_id = users.id
    ORDER BY mitra.id DESC
");

// Tambah mitra
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $wilayah = $_POST['wilayah'];
    $kendaraan = $_POST['kendaraan'];
    $status = $_POST['status'];

    // Insert ke users dulu
    mysqli_query($koneksi, "
        INSERT INTO users (nama, email, role)
        VALUES ('$nama','$email','mitra')
    ");

    $user_id = mysqli_insert_id($koneksi);

    // Insert ke mitra
    mysqli_query($koneksi, "
        INSERT INTO mitra (user_id, wilayah, kendaraan, status)
        VALUES ('$user_id','$wilayah','$kendaraan','$status')
    ");

    header("Location: mitra.php");
}

// Hapus mitra
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // Ambil user_id dulu
    $get = mysqli_query($koneksi, "SELECT user_id FROM mitra WHERE id=$id");
    $d = mysqli_fetch_assoc($get);

    // Hapus dari mitra
    mysqli_query($koneksi, "DELETE FROM mitra WHERE id=$id");

    // Hapus dari users
    mysqli_query($koneksi, "DELETE FROM users WHERE id=".$d['user_id']);

    header("Location: mitra.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Mitra - Admin Greasycle</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body { font-family: 'Poppins', sans-serif; }
</style>
</head>

<body class="bg-gray-50 flex">

<!-- Sidebar -->
<aside class="w-64 bg-green-900 min-h-screen p-6 text-white">
    <h2 class="text-2xl font-bold mb-10">Greasycle</h2>

    <a href="dashboard.php" class="block mb-3">Dashboard</a>
    <a href="pelanggan.php" class="block mb-3">Pelanggan</a>
    <a href="mitra.php" class="block font-bold">Mitra</a>
</aside>

<!-- Main -->
<main class="flex-1 p-8">

<div class="flex justify-between mb-6">
    <h2 class="text-2xl font-bold">Data Mitra</h2>
    <button onclick="openModal()" class="bg-green-800 text-white px-4 py-2 rounded">
        + Tambah
    </button>
</div>

<!-- Table -->
<div class="bg-white rounded shadow">
<table class="w-full text-sm">
<thead class="bg-gray-100">
<tr>
    <th class="p-3">Nama</th>
    <th>Email</th>
    <th>Wilayah</th>
    <th>Kendaraan</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php while($m = mysqli_fetch_assoc($query)) : ?>
<tr class="border-t">
    <td class="p-3"><?= $m['nama'] ?></td>
    <td><?= $m['email'] ?></td>
    <td><?= $m['wilayah'] ?></td>
    <td><?= $m['kendaraan'] ?></td>
    <td><?= $m['status'] ?></td>
    <td>
        <a href="mitra.php?hapus=<?= $m['id'] ?>" 
           onclick="return confirm('Hapus?')" 
           class="text-red-500">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

</main>

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-black/50 hidden justify-center items-center">
<div class="bg-white p-6 rounded w-96">

<h3 class="font-bold mb-4">Tambah Mitra</h3>

<form method="POST">
<input name="nama" placeholder="Nama" class="w-full mb-2 p-2 border">
<input name="email" placeholder="Email" class="w-full mb-2 p-2 border">
<input name="wilayah" placeholder="Wilayah" class="w-full mb-2 p-2 border">
<input name="kendaraan" placeholder="Kendaraan" class="w-full mb-2 p-2 border">

<select name="status" class="w-full mb-3 p-2 border">
<option value="Aktif">Aktif</option>
<option value="Nonaktif">Nonaktif</option>
</select>

<div class="flex gap-2">
<button type="button" onclick="closeModal()" class="flex-1 border">Batal</button>
<button type="submit" name="tambah" class="flex-1 bg-green-800 text-white">Simpan</button>
</div>
</form>

</div>
</div>

<script>
function openModal(){
    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('modal').classList.add('flex');
}

function closeModal(){
    document.getElementById('modal').classList.add('hidden');
}
</script>

</body>
</html>