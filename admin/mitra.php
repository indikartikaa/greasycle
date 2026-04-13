<?php
session_start();
include '../koneksi.php';

// ================== QUERY ==================
$query = mysqli_query($conn, "
    SELECT 
        mitra.id_mitra,
        users.nama,
        users.email,
        mitra.wilayah,
        mitra.no_kendaraan,
        mitra.status
    FROM mitra
    INNER JOIN users ON mitra.id_user = id_user
    ORDER BY mitra.id_mitra DESC
");

// DEBUG (WAJIB BIAR TAU ERROR)
if (!$query) {
    die("Query Error: " . mysqli_error($conn));
}

// ================== TAMBAH ==================
if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $wilayah = mysqli_real_escape_string($conn, $_POST['wilayah']);
    $kendaraan = mysqli_real_escape_string($conn, $_POST['kendaraan']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Insert user
    $insertUser = mysqli_query($conn, "
        INSERT INTO users (nama, email, role)
        VALUES ('$nama','$email','mitra')
    ");

    if (!$insertUser) {
        die("Insert User Error: " . mysqli_error($conn));
    }

    $user_id = mysqli_insert_id($conn);

    // Insert mitra
    $insertMitra = mysqli_query($conn, "
        INSERT INTO mitra (user_id, wilayah, kendaraan, status)
        VALUES ('$user_id','$wilayah','$kendaraan','$status')
    ");

    if (!$insertMitra) {
        die("Insert Mitra Error: " . mysqli_error($conn));
    }

    header("Location: mitra.php");
    exit;
}

// ================== HAPUS ==================
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];

    $get = mysqli_query($conn, "SELECT user_id FROM mitra WHERE id=$id");
    $d = mysqli_fetch_assoc($get);

    if ($d) {
        mysqli_query($conn, "DELETE FROM mitra WHERE id=$id");
        mysqli_query($conn, "DELETE FROM users WHERE id=".$d['user_id']);
    }

    header("Location: mitra.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mitra - Greasycle</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
body { font-family: 'Poppins', sans-serif; }
</style>
</head>

<body class="bg-gray-50">

<!-- HEADER MOBILE -->
<div class="md:hidden flex justify-between items-center p-4 bg-primary text-white">
    <h1 class="font-bold">Greasycle</h1>
    <button onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
</div>

<!-- OVERLAY -->
<div id="overlay" onclick="toggleSidebar()" 
     class="fixed inset-0 bg-black/50 hidden z-40"></div>

<div class="flex">

<!-- SIDEBAR -->
<aside id="sidebar"
    class="fixed md:static z-50 top-0 left-0 h-full w-64 bg-green-900 text-white p-6 transform -translate-x-full md:translate-x-0 transition duration-300">

    <h2 class="text-2xl font-bold mb-10">Greasycle</h2>

    <nav class="space-y-4">
        <a href="dashboard.php" class="block">Dashboard</a>
        <a href="pelanggan.php" class="block">Pelanggan</a>
        <a href="mitra.php" class="block font-bold">Mitra</a>
    </nav>
</aside>

<!-- MAIN -->
<main class="flex-1 p-6 md:p-8">

<!-- HEADER -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <h2 class="text-xl md:text-2xl font-bold">Data Mitra</h2>

    <button onclick="openModal()" 
        class="bg-green-800 text-white px-4 py-2 rounded-lg text-sm">
        + Tambah
    </button>
</div>

<!-- TABLE -->
<div class="bg-white rounded-xl shadow overflow-x-auto">
<table class="w-full text-sm min-w-[600px]">

<thead class="bg-gray-100">
<tr>
    <th class="p-3 text-left">Nama</th>
    <th>Email</th>
    <th>Wilayah</th>
    <th>Kendaraan</th>
    <th>Status</th>
    <th class="text-center">Aksi</th>
</tr>
</thead>

<tbody>
<?php while($m = mysqli_fetch_assoc($query)) : ?>
<tr class="border-t hover:bg-gray-50">
    <td class="p-3 font-semibold"><?= $m['nama'] ?></td>
    <td><?= $m['email'] ?></td>
    <td><?= $m['wilayah'] ?></td>
    <td><?= $m['kendaraan'] ?></td>

    <td>
        <span class="px-2 py-1 text-xs rounded 
        <?= $m['status'] == 'Aktif' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' ?>">
        <?= $m['status'] ?>
        </span>
    </td>

    <td class="text-center">
        <a href="mitra.php?hapus=<?= $m['id'] ?>" 
           onclick="return confirm('Hapus data?')" 
           class="text-red-500 text-xs">
           Hapus
        </a>
    </td>
</tr>
<?php endwhile; ?>
</tbody>

</table>
</div>

</main>
</div>

<!-- MODAL -->
<div id="modal" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50">
<div class="bg-white p-6 rounded-xl w-80">

<h3 class="font-bold mb-4">Tambah Mitra</h3>

<form method="POST" class="space-y-2">

<input name="nama" placeholder="Nama" class="w-full p-2 border rounded">
<input name="email" placeholder="Email" class="w-full p-2 border rounded">
<input name="wilayah" placeholder="Wilayah" class="w-full p-2 border rounded">
<input name="kendaraan" placeholder="Kendaraan" class="w-full p-2 border rounded">

<select name="status" class="w-full p-2 border rounded">
<option value="Aktif">Aktif</option>
<option value="Nonaktif">Nonaktif</option>
</select>

<div class="flex gap-2 pt-2">
<button type="button" onclick="closeModal()" class="flex-1 border rounded">Batal</button>
<button type="submit" name="tambah" class="flex-1 bg-green-800 text-white rounded">Simpan</button>
</div>

</form>

</div>
</div>

<!-- SCRIPT -->
<script>
function openModal(){
    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('modal').classList.add('flex');
}

function closeModal(){
    document.getElementById('modal').classList.add('hidden');
}

function toggleSidebar(){
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}
</script>

</body>
</html>