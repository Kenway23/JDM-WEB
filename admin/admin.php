<?php
session_start(); // Memulai session untuk login admin
include '../config/database.php'; // Menghubungkan ke database

// Pastikan sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php"); // Redirect ke login jika belum login
    exit();
}

// Proses tambah data mobil
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Cek apakah form dikirim
    $nama_mobil = $_POST['nama_mobil']; // Ambil input nama mobil
    $merek = $_POST['merek'];           // Ambil input merek mobil
    $negara = $_POST['negara'];         // Ambil input negara asal
    $tahun = $_POST['tahun'];           // Ambil input tahun rilis
    $deskripsi = $_POST['deskripsi'];   // Ambil input deskripsi
    $gambar = $_FILES['gambar']['name']; // Ambil nama file gambar

    // Upload gambar ke folder /assets/images/
    $target_dir = "../assets/images/";
    $target_file = $target_dir . basename($gambar);
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file); // Pindahkan file gambar

    // Simpan data ke database
    $stmt = $pdo->prepare("INSERT INTO cars (nama_mobil, merek, negara, tahun, deskripsi, gambar) 
                           VALUES (:nama_mobil, :merek, :negara, :tahun, :deskripsi, :gambar)");
    $stmt->execute([
        'nama_mobil' => $nama_mobil,
        'merek' => $merek,
        'negara' => $negara,
        'tahun' => $tahun,
        'deskripsi' => $deskripsi,
        'gambar' => $gambar
    ]);

    $success = "✅ Data mobil berhasil ditambahkan!"; // Pesan sukses
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Garasi Muda Garage</title>
    <link rel="icon" href="../assets/images/logo.png">
    <link rel="stylesheet" href="../assets/css/admin.css?v=5">
</head>

<body>

    <!-- Header Admin -->
    <div class="admin-header">
        <h1>Dashboard Admin</h1>
        <div class="nav-links">
            <a href="admin.php" class="active">Tambah Mobil</a> <!-- Link aktif halaman ini -->
            <a href="admin_gallery.php">Tambah Galeri</a>
            <a href="admin_sparepart.php">Tambah Sparepart</a>
            <a href="admin_contact.php">Pesan Pengunjung</a>
            <a href="../index.php" target="_blank">Lihat Website</a>
            <a href="#" id="logoutBtn">Logout</a>
        </div>
    </div>

    <!-- Section Tambah Mobil -->
    <section class="admin-section fade-in">
        <h2>Tambah Mobil Baru</h2>
        <?php if (!empty($success))
            echo "<p class='success'>$success</p>"; // Tampilkan pesan sukses jika ada ?>
        <form method="POST" enctype="multipart/form-data"> <!-- Form untuk input data mobil -->
            <input type="text" name="nama_mobil" placeholder="Nama Mobil" required>
            <input type="text" name="merek" placeholder="Merek" required>
            <input type="text" name="negara" placeholder="Asal Negara" required>
            <input type="number" name="tahun" placeholder="Tahun Rilis" required>
            <textarea name="deskripsi" placeholder="Deskripsi Mobil..." required></textarea>
            <input type="file" name="gambar" accept="image/*" required> <!-- Upload gambar -->
            <button type="submit">Tambah Mobil</button>
        </form>
    </section>

    <!-- Section Daftar Mobil -->
    <section class="admin-section fade-in">
        <h2>Daftar Mobil di Database</h2>
        <div class="car-list">
            <?php
            $stmt = $pdo->query("SELECT * FROM cars ORDER BY id DESC"); // Ambil semua data mobil
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "
                <div class='car-card'>
                    <img src='../assets/images/{$row['gambar']}' alt='{$row['nama_mobil']}'>
                    <h3>{$row['nama_mobil']}</h3>
                    <p><strong>Merek:</strong> {$row['merek']}</p>
                    <p><strong>Negara:</strong> {$row['negara']}</p>
                    <p><strong>Tahun:</strong> {$row['tahun']}</p>
                    <div class='card-actions'>
                        <a href='edit_mobil.php?id={$row['id']}' class='btn-edit'>Edit</a>
                        <a href='#' class='btn-delete' data-id='{$row['id']}' data-type='mobil'>Hapus</a>
                    </div>
                </div>
                "; // Tampilkan data mobil dengan tombol edit dan hapus
            }
            ?>
        </div>
    </section>
    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Konfirmasi Hapus</h3>
            <p>Apakah kamu yakin ingin menghapus mobil ini?</p>
            <div class="modal-actions">
                <button id="cancelBtn" class="btn btn-cancel">Batal</button>
                <a href="logout.php" class="btn btn-confirm">Logout</a>
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

    <script src="../assets/js/admin.js?=v3"></script> <!-- Script untuk modal konfirmasi dan aksi hapus -->
</body>

</html>