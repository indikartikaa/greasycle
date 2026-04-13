<?php
session_start();
include '../koneksi.php';

// ======================
// AMBIL DATA
// ======================
$query = mysqli_query($conn, "
    SELECT id_user, nama, email, role 
    FROM users 
    WHERE role = 'pelanggan'
    ORDER BY id_user DESC
");

if (!$query) {
    die("Query error: " . mysqli_error($conn));
}

// ======================
// TAMBAH DATA
// ======================
if (isset($_POST['tambah'])) {
    $nama  = $_POST['nama'];
    $email = $_POST['email'];

    mysqli_query($conn, "
        INSERT INTO users (nama, email, role)
        VALUES ('$nama','$email','pelanggan')
    ");

    header("Location: pelanggan.php");
    exit;
}

// ======================
// HAPUS DATA
// ======================
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    mysqli_query($conn, "DELETE FROM users WHERE id_user = $id");

    header("Location: pelanggan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pelanggan - Greasycle</title>

<script src="https://cdn.tailwindcss.com"></script>

<!-- CONFIG WARNA -->
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

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
body { font-family: 'Poppins', sans-serif; }
</style>
</head>

<body class="bg-[#f7faf9]">

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
    class="fixed md:static z-50 top-0 left-0 h-full w-64 bg-primary text-white p-6 
    transform -translate-x-full md:translate-x-0 transition duration-300">

    <h2 class="text-2xl font-bold mb-10">Greasycle</h2>

    <nav class="space-y-4">
        <a href="dashboard.php" class="block hover:underline">Dashboard</a>
        <a href="pelanggan.php" class="block font-bold">Pelanggan</a>
        <a href="mitra.php" class="block hover:underline">Mitra</a>
    </nav>
</aside>

<!-- MAIN -->
<main class="flex-1 p-6 md:p-10">

<!-- HEADER -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
    <div>
        <h2 class="text-2xl md:text-3xl font-bold text-primary">Data Pelanggan</h2>
        <p class="text-gray-500 text-sm">Kelola informasi pelanggan Greasycle</p>
    </div>

    <button onclick="openModal()" 
        class="bg-primary text-white px-6 py-2.5 rounded-full text-sm font-semibold shadow-lg hover:bg-secondary transition">
        + Tambah
    </button>
</div>

<!-- TABLE -->
<div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">

<div class="overflow-x-auto">
<table class="w-full text-sm min-w-[500px]">

<thead class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
<tr>
    <th class="p-4 text-left">Nama</th>
    <th>Email</th>
    <th>Role</th>
    <th class="text-center">Aksi</th>
</tr>
</thead>

<tbody class="divide-y">
<?php if (mysqli_num_rows($query) > 0): ?>
    <?php while($p = mysqli_fetch_assoc($query)): ?>
    <tr class="hover:bg-gray-50 transition">

        <td class="p-4 font-semibold text-gray-800">
            <?= $p['nama'] ?>
        </td>

        <td class="text-gray-500">
            <?= $p['email'] ?>
        </td>

        <td>
            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-semibold">
                <?= $p['role'] ?>
            </span>
        </td>

        <td class="text-center">
            <a href="?hapus=<?= $p['id_user'] ?>"
               onclick="return confirm('Hapus data?')"
               class="text-red-500 hover:text-red-700 text-sm font-medium">
               Hapus
            </a>
        </td>

    </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr>
        <td colspan="4" class="text-center p-6 text-gray-400">
            Tidak ada data
        </td>
    </tr>
<?php endif; ?>
</tbody>

</table>
</div>

</div>

</main>
</div>

<!-- MODAL -->
<div id="modal" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50 backdrop-blur-sm">
<div class="bg-white p-8 rounded-3xl w-[90%] max-w-md shadow-2xl">

<h3 class="text-xl font-bold mb-6 text-primary">Tambah Pelanggan</h3>

<form method="POST" class="space-y-4">

<input name="nama" placeholder="Nama" required 
class="w-full p-3 border rounded-xl bg-gray-50 focus:outline-secondary text-sm">

<input name="email" placeholder="Email" required 
class="w-full p-3 border rounded-xl bg-gray-50 focus:outline-secondary text-sm">

<div class="flex gap-3 pt-2">
<button type="button" onclick="closeModal()" 
class="flex-1 border rounded-xl py-2 hover:bg-gray-100 transition">
Batal
</button>

<button type="submit" name="tambah" 
class="flex-1 bg-primary text-white rounded-xl py-2 font-semibold hover:bg-secondary transition">
Simpan
</button>
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
    document.getElementById('sidebar').classList.toggle('-translate-x-full');
    document.getElementById('overlay').classList.toggle('hidden');
}
</script>

</body>
</html>