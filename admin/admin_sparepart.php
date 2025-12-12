<?php
session_start(); // Memulai session untuk admin
include '../config/database.php'; // Menghubungkan ke database

// Pastikan sudah login sebagai admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php"); // Redirect ke login jika belum login
    exit();
}

// Tambah sparepart
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Cek jika form dikirim
    $nama_part = $_POST['nama_part']; // Ambil input nama sparepart
    $jenis = $_POST['jenis'];         // Ambil input jenis sparepart
    $merek = $_POST['merek'];         // Ambil input merek
    $harga = $_POST['harga'];         // Ambil input harga
    $deskripsi = $_POST['deskripsi']; // Ambil input deskripsi
    $gambar = $_FILES['gambar']['name']; // Ambil nama file gambar

    $target_dir = "../assets/images/";
    $target_file = $target_dir . basename($gambar);
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file); // Upload gambar ke folder

    // Simpan data sparepart ke database
    $stmt = $pdo->prepare("INSERT INTO spareparts (nama_part, jenis, merek, harga, deskripsi, gambar)
                           VALUES (:nama_part, :jenis, :merek, :harga, :deskripsi, :gambar)");
    $stmt->execute([
        'nama_part' => $nama_part,
        'jenis' => $jenis,
        'merek' => $merek,
        'harga' => $harga,
        'deskripsi' => $deskripsi,
        'gambar' => $gambar
    ]);

    $success = "✅ Sparepart berhasil ditambahkan!"; // Pesan sukses
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Sparepart - Garasi Muda Admin</title>
    <link rel="icon" href="../assets/images/logo.png">
    <link rel="stylesheet" href="../assets/css/admin.css?v=5">
</head>

<body>
    <!-- Header Admin -->
    <div class="admin-header">
        <h1>Dashboard Admin</h1>
        <div class="nav-links">
            <a href="admin.php">Tambah Mobil</a>
            <a href="admin_gallery.php">Tambah Galeri</a>
            <a href="admin_sparepart.php" class="active">Tambah Sparepart</a> <!-- Halaman aktif -->
            <a href="admin_contact.php">Pesan Pengunjung</a>
            <a href="../index.php" target="_blank">Lihat Website</a>
            <a href="#" id="logoutBtn">Logout</a>
        </div>
    </div>

    <!-- Section Tambah Sparepart -->
    <section class="admin-section fade-in">
        <h2>Tambah Sparepart / Modifikasi</h2>
        <?php if (!empty($success))
            echo "<p class='success'>$success</p>"; // Tampilkan pesan sukses jika ada ?>

        <form method="POST" enctype="multipart/form-data"> <!-- Form input sparepart -->
            <input type="text" name="nama_part" placeholder="Nama Sparepart" required>
            <input type="text" name="jenis" placeholder="Jenis (misal: Turbo, Velg, Spoiler)" required>
            <input type="text" name="merek" placeholder="Merek Sparepart" required>
            <input type="number" name="harga" placeholder="Harga (Rp)" required>
            <textarea name="deskripsi" placeholder="Deskripsi Sparepart..." required></textarea>
            <input type="file" name="gambar" accept="image/*" required> <!-- Upload gambar -->
            <button type="submit">Tambah Sparepart</button>
        </form>

        <!-- Section Daftar Sparepart -->
        <h2>Daftar Sparepart</h2>
        <div class="car-list">
            <?php
            $stmt = $pdo->query("SELECT * FROM spareparts ORDER BY id DESC"); // Ambil semua data sparepart
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "
        <div class='car-card'>
            <img src='../assets/images/{$row['gambar']}' alt='{$row['nama_part']}'>
            <h3>{$row['nama_part']}</h3>
            <p><strong>Jenis:</strong> {$row['jenis']}</p>
            <p><strong>Merek:</strong> {$row['merek']}</p>
            <p><strong>Harga:</strong> Rp " . number_format($row['harga'], 0, ',', '.') . "</p>
            <div class='card-actions'>
                <a href='edit_sparepart.php?id={$row['id']}' class='btn-edit'>Edit</a>
                <a href='#' class='btn-delete' data-id='{$row['id']}' data-type='sparepart'>Hapus</a>
            </div>
        </div>
        "; // Tampilkan sparepart dengan tombol edit dan hapus
            }
            ?>
        </div>

    </section>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Konfirmasi Hapus</h3>
            <p>Apakah kamu yakin ingin menghapus spareparts ini?</p>
            <div class="modal-actions">
                <button id="cancelBtn" class="btn btn-cancel">Batal</button>
                <a href="#" id="confirmDelete" class="btn btn-confirm" data-type="sparepart">Hapus</a>
            </div>
        </div>
    </div>

    <!-- Modal Logout -->
    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <span class="close" id="logoutClose">&times;</span>
            <h3>Konfirmasi Logout</h3>
            <p>Apakah kamu yakin ingin keluar dari akun admin?</p>
            <div class="modal-actions">
                <button id="cancelLogout" class="btn btn-cancel">Batal</button>
                <a href="logout.php" class="btn btn-confirm">Logout</a>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2025 Garasi Muda | Dibuat oleh Rifki Muhamad Fauzi</p>
    </footer>
    <script src="../assets/js/admin.js?=v3"></script> <!-- Script untuk modal konfirmasi hapus -->
</body>

</html>