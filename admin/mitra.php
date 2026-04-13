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
        mitra.no_kendaraan AS kendaraan,
        mitra.status
    FROM mitra
    INNER JOIN users ON mitra.id_user = users.id_user
    ORDER BY mitra.id_mitra DESC
");

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

    mysqli_query($conn, "
        INSERT INTO users (nama, email, role)
        VALUES ('$nama','$email','mitra')
    ");

    $id_user = mysqli_insert_id($conn);

    mysqli_query($conn, "
        INSERT INTO mitra (id_user, wilayah, no_kendaraan, status)
        VALUES ('$id_user','$wilayah','$kendaraan','$status')
    ");

    header("Location: mitra.php");
    exit;
}

// ================== HAPUS ==================
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];

    $get = mysqli_query($conn, "SELECT id_user FROM mitra WHERE id_mitra=$id");
    $d = mysqli_fetch_assoc($get);

    if ($d) {
        mysqli_query($conn, "DELETE FROM mitra WHERE id_mitra=$id");
        mysqli_query($conn, "DELETE FROM users WHERE id_user=".$d['id_user']);
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

<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: '#004030',
                secondary: '#2d6a4f'
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

<!-- SIDEBAR (SAMA DASHBOARD) -->
<aside id="sidebar"
class="fixed top-16 md:top-0 left-[-100%] md:left-0 
w-64 h-[calc(100%-4rem)] md:h-screen 
bg-primary text-white p-6 
transition-all duration-300 ease-in-out z-50">

    <h2 class="text-2xl font-bold mb-10 flex items-center gap-2">
        <i class="fas fa-recycle"></i> Greasycle
    </h2>

    <nav class="space-y-4">
        <a href="dashboard.php" class="block p-3 rounded-lg hover:bg-white/10 text-white/70">
            <i class="fas fa-th-large mr-2"></i> Dashboard
        </a>

        <a href="pelanggan.php" class="block p-3 hover:bg-white/10 rounded-lg text-white/70">
            <i class="fas fa-users mr-2"></i> Pelanggan
        </a>

        <a href="mitra.php" class="block bg-white/10 p-3 rounded-lg font-semibold">
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
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl md:text-2xl font-bold text-primary">Data Mitra</h2>

    <button onclick="openModal()" 
    class="bg-secondary text-white px-4 py-2 rounded-lg text-sm">
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
    <td class="p-3 font-semibold"><?= htmlspecialchars($m['nama']) ?></td>
    <td><?= htmlspecialchars($m['email']) ?></td>
    <td><?= htmlspecialchars($m['wilayah']) ?></td>
    <td><?= htmlspecialchars($m['kendaraan']) ?></td>

    <td>
        <span class="px-2 py-1 text-xs rounded 
        <?= $m['status'] == 'Aktif' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' ?>">
        <?= $m['status'] ?>
        </span>
    </td>

    <td class="text-center">
        <a href="?hapus=<?= $m['id_mitra'] ?>"
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

</div>
</main>

<!-- MODAL -->
<div id="modal" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50">
<div class="bg-white p-6 rounded-xl w-[90%] max-w-md">

<h3 class="font-bold mb-4">Tambah Mitra</h3>

<form method="POST" class="space-y-3">

<input name="nama" placeholder="Nama" required class="w-full p-2 border rounded">
<input name="email" placeholder="Email" required class="w-full p-2 border rounded">
<input name="wilayah" placeholder="Wilayah" required class="w-full p-2 border rounded">
<input name="kendaraan" placeholder="No Kendaraan" required class="w-full p-2 border rounded">

<select name="status" class="w-full p-2 border rounded">
<option value="Aktif">Aktif</option>
<option value="Nonaktif">Nonaktif</option>
</select>

<div class="flex gap-2 pt-2">
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