<?php
session_start(); // Memulai session untuk admin
include '../config/database.php'; // Menghubungkan ke database

// Pastikan sudah login sebagai admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php"); // Redirect ke login jika belum login
    exit();
}

// Proses upload gambar
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Cek jika form dikirim
    $gambar = $_FILES['gambar']['name']; // Ambil nama file gambar
    $target_dir = "../assets/images/"; // Folder tujuan upload
    $target_file = $target_dir . basename($gambar); // Path lengkap file
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file); // Upload file ke folder

    // Simpan nama file gambar ke database
    $stmt = $pdo->prepare("INSERT INTO gallery (gambar) VALUES (:gambar)");
    $stmt->execute(['gambar' => $gambar]);

    $success = "✅ Gambar berhasil ditambahkan ke galeri!"; // Pesan sukses
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Galeri - Garasi Muda Admin</title>
    <link rel="icon" href="../assets/images/logo.png">
    <link rel="stylesheet" href="../assets/css/admin.css?v=5">
</head>

<body>

    <!-- Header Navbar Admin -->
    <div class="admin-header">
        <h1>Dashboard Admin</h1>
        <div class="nav-links">
            <a href="admin.php">Tambah Mobil</a>
            <a href="admin_gallery.php" class="active">Tambah Galeri</a> <!-- Halaman aktif -->
            <a href="admin_sparepart.php">Tambah Sparepart</a>
            <a href="admin_contact.php">Pesan Pengunjung</a>
            <a href="../index.php" target="_blank">Lihat Website</a>
            <a href="#" id="logoutBtn">Logout</a>
        </div>
    </div>

    <!-- Section Upload Gambar -->
    <section class="admin-section fade-in">
        <?php if (!empty($success))
            echo "<p class='success'>$success</p>"; // Tampilkan pesan sukses jika ada ?>

        <h2>Upload Gambar Baru</h2>
        <form method="POST" enctype="multipart/form-data"> <!-- Form upload gambar -->
            <input type="file" name="gambar" accept="image/*" required>
            <button type="submit">Upload Gambar</button>
        </form>

        <!-- Daftar Gambar Galeri -->
        <h2>Daftar Gambar Galeri</h2>
        <div class="gallery-list">
            <?php
            $stmt = $pdo->query("SELECT * FROM gallery ORDER BY id DESC"); // Ambil semua data gallery
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "
        <div class='gallery-card'>
            <img src='../assets/images/{$row['gambar']}' alt=''> <!-- Tampilkan gambar -->
            <div class='card-actions'>
                <a href='edit_gallery.php?id={$row['id']}' class='btn-edit'>Edit</a> <!-- Link edit -->
                <a href='#' class='btn-delete' data-id='{$row['id']}' data-type='gallery'>Hapus</a> <!-- Tombol hapus -->
            </div>
        </div>
        ";
            }
            ?>
        </div>

    </section>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span> <!-- Tombol tutup modal -->
            <h3>Konfirmasi Hapus</h3>
            <p>Apakah kamu yakin ingin menghapus foto ini?</p>
            <div class="modal-actions">
                <button id="cancelBtn" class="btn btn-cancel">Batal</button>
                <a href="#" id="confirmDelete" class="btn btn-confirm" data-type="sparepart">Hapus</a>
                <!-- Tombol hapus konfirmasi -->
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

    <script src="../assets/js/admin.js?v=3"></script> <!-- Script modal hapus dan interaksi -->
</body>

</html>