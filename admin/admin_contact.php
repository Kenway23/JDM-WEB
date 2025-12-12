<?php
session_start(); // Memulai session untuk admin
include '../config/database.php'; // Menghubungkan ke database

// Cek login admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php"); // Redirect ke login jika belum login
    exit();
}

// Hapus pesan jika ada request ?delete=ID
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; // Ambil ID dari query string
    $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = :id"); // Siapkan query hapus
    $stmt->execute(['id' => $id]); // Jalankan query
    $success = "🗑️ Pesan berhasil dihapus!"; // Pesan sukses
}

// Ambil semua pesan dari database
$stmt = $pdo->query("SELECT * FROM contacts ORDER BY id DESC"); // Query semua kontak, terbaru di atas
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC); // Simpan hasil ke array
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pesan Pengunjung - Garasi Muda Admin</title>
    <link rel="icon" href="../assets/images/logo.png">
    <link rel="stylesheet" href="../assets/css/admin.css?v=5"> <!-- CSS admin -->
</head>

<body>

    <!-- Header Navbar Admin -->
    <div class="admin-header">
        <h1>Dashboard Admin</h1>
        <div class="nav-links">
            <a href="admin.php">Tambah Mobil</a>
            <a href="admin_gallery.php">Tambah Galeri</a>
            <a href="admin_sparepart.php">Tambah Sparepart</a>
            <a href="admin_contact.php" class="active">Pesan Pengunjung</a> <!-- Halaman aktif -->
            <a href="../index.php" target="_blank">Lihat Website</a>
            <a href="#" id="logoutBtn">Logout</a>
        </div>
    </div>

    <!-- Section Daftar Pesan -->
    <section class="admin-section fade-in">
        <h2>Pesan dari Pengunjung</h2>
        <?php if (!empty($success)): ?>
            <p class="success"><?= $success ?></p> <!-- Tampilkan pesan sukses jika ada -->
        <?php endif; ?>

        <div class="message-list">
            <?php if (count($contacts) > 0): ?> <!-- Cek ada pesan atau tidak -->
                <?php foreach ($contacts as $c): ?> <!-- Looping setiap pesan -->
                    <div class="message-card">
                        <h3><?= htmlspecialchars($c['nama']) ?></h3> <!-- Nama pengirim -->
                        <p><strong>Email:</strong> <?= htmlspecialchars($c['email']) ?></p> <!-- Email pengirim -->
                        <p><?= nl2br(htmlspecialchars($c['pesan'])) ?></p> <!-- Isi pesan dengan baris baru -->
                        <a href="#" class="btn-delete" data-id="<?= $c['id'] ?>" data-type="contact">Hapus</a>
                        <!-- Tombol hapus -->
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Belum ada pesan masuk.</p> <!-- Jika tidak ada pesan -->
            <?php endif; ?>
        </div>
    </section>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span> <!-- Tombol tutup modal -->
            <h3>Konfirmasi Hapus</h3>
            <p>Apakah kamu yakin ingin menghapus pesan ini?</p>
            <div class="modal-actions">
                <button id="cancelBtn" class="btn btn-cancel">Batal</button> <!-- Tombol batal -->
                <a href="#" id="confirmDelete" class="btn btn-confirm">Hapus</a> <!-- Tombol konfirmasi hapus -->
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


    <!-- Footer -->
    <footer>
        <p>© 2025 Garasi Muda | Dibuat oleh Rifki Muhamad Fauzi</p>
    </footer>

    <!-- Script admin -->
    <script src="../assets/js/admin.js?v=3"></script> <!-- Script modal hapus dan interaksi -->
</body>

</html>