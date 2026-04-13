<?php
session_start();
include '../koneksi.php';

// ================== QUERY ==================
$query = mysqli_query($conn, "
    SELECT id_user, nama, email, role 
    FROM users 
    WHERE role = 'pelanggan'
    ORDER BY id_user DESC
");

if (!$query) {
    die("Query error: " . mysqli_error($conn));
}

// ================== TAMBAH ==================
if (isset($_POST['tambah'])) {
    $nama  = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    mysqli_query($conn, "
        INSERT INTO users (nama, email, role)
        VALUES ('$nama','$email','pelanggan')
    ");

    header("Location: pelanggan.php");
    exit;
}

// ================== HAPUS ==================
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];

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

<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: '#004030',
                secondary: '#2d6a4f',
                accent: '#d1e7e0'
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

<body class="bg-gray-50 flex">

<!-- OVERLAY -->
<div id="overlay" onclick="toggleSidebar()" 
class="fixed inset-0 bg-black/50 hidden z-40 md:hidden"></div>

<!-- SIDEBAR -->
<aside id="sidebar"
class="fixed top-16 md:top-0 left-[-100%] md:left-0 
w-64 h-[calc(100%-4rem)] md:h-screen
bg-primary text-white p-6 
transition-all duration-300 z-50">

    <h2 class="text-2xl font-bold mb-10 flex items-center gap-2">
        <i class="fas fa-recycle"></i> Greasycle
    </h2>

    <nav class="space-y-4">
        <a href="dashboard.php" class="block p-3 rounded-lg hover:bg-white/10 text-white/70">
            <i class="fas fa-th-large mr-2"></i> Dashboard
        </a>

        <a href="pelanggan.php" class="block bg-white/10 p-3 rounded-lg font-semibold">
            <i class="fas fa-users mr-2"></i> Pelanggan
        </a>

        <a href="mitra.php" class="block p-3 hover:bg-white/10 rounded-lg text-white/70">
            <i class="fas fa-truck mr-2"></i> Mitra
        </a>
    </nav>

    <div class="mt-20 border-t border-white/10 pt-4">
        <a href="../logout.php" class="text-xs text-red-300 uppercase font-bold">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
    </div>
</aside>

<!-- MAIN -->
<main class="flex-1 w-full overflow-x-hidden md:ml-64">

<!-- HEADER MOBILE -->
<div class="md:hidden flex justify-between items-center h-16 px-4 bg-white shadow fixed top-0 left-0 right-0 z-[60]">
    <button onclick="toggleSidebar()" class="text-xl">
        <i class="fas fa-bars"></i>
    </button>
    <h1 class="font-bold text-primary">Greasycle</h1>
</div>

<div class="p-4 md:p-8 mt-16 md:mt-0">

<!-- HEADER -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
    <div>
        <h2 class="text-xl md:text-2xl font-bold text-primary">Data Pelanggan</h2>
        <p class="text-sm text-gray-400">Kelola data pelanggan</p>
    </div>

    <button onclick="openModal()" 
    class="bg-primary text-white px-5 py-2 rounded-lg text-sm">
        + Tambah
    </button>
</div>

<!-- TABLE -->
<div class="bg-white rounded-2xl shadow overflow-x-auto">
<table class="w-full text-sm min-w-[500px]">

<thead class="bg-gray-100 text-gray-600">
<tr>
    <th class="p-3 text-left">Nama</th>
    <th>Email</th>
    <th>Role</th>
    <th class="text-center">Aksi</th>
</tr>
</thead>

<tbody>
<?php if (mysqli_num_rows($query) > 0): ?>
<?php while($p = mysqli_fetch_assoc($query)): ?>
<tr class="border-t hover:bg-gray-50">

    <td class="p-3 font-semibold"><?= htmlspecialchars($p['nama']) ?></td>
    <td><?= htmlspecialchars($p['email']) ?></td>

    <td>
        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-600">
            <?= $p['role'] ?>
        </span>
    </td>

    <td class="text-center">
        <a href="?hapus=<?= $p['id_user'] ?>"
           onclick="return confirm('Hapus data?')"
           class="text-red-500 text-xs">
           Hapus
        </a>
    </td>

</tr>
<?php endwhile; ?>
<?php else: ?>
<tr>
    <td colspan="4" class="text-center p-5 text-gray-400">
        Tidak ada data
    </td>
</tr>
<?php endif; ?>
</tbody>

</table>
</div>

</div>
</main>

<!-- MODAL -->
<div id="modal" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50">
<div class="bg-white p-6 rounded-xl w-[90%] max-w-md">

<h3 class="font-bold mb-4">Tambah Pelanggan</h3>

<form method="POST" class="space-y-3">

<input name="nama" placeholder="Nama" required class="w-full p-2 border rounded">
<input name="email" placeholder="Email" required class="w-full p-2 border rounded">

<div class="flex gap-2">
<button type="button" onclick="closeModal()" class="flex-1 border rounded">
Batal
</button>

<button type="submit" name="tambah" class="flex-1 bg-primary text-white rounded">
Simpan
</button>
</div>

</form>

</div>
</div>

<!-- SCRIPT -->
<script>
function toggleSidebar(){
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    sidebar.classList.toggle('left-[-100%]');
    sidebar.classList.toggle('left-0');
    overlay.classList.toggle('hidden');
}

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