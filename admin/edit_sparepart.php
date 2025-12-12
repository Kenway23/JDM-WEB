<?php
session_start(); // Memulai session untuk cek status login admin
include '../config/database.php'; // Menghubungkan ke database

// Cek apakah admin sudah login, jika belum redirect ke login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Ambil id sparepart dari query string
$id = $_GET['id'] ?? null;
if (!$id) { // Jika id kosong, redirect ke halaman admin sparepart
    header("Location: admin_sparepart.php");
    exit();
}

// Ambil data sparepart berdasarkan id
$stmt = $pdo->prepare("SELECT * FROM spareparts WHERE id = :id");
$stmt->execute(['id' => $id]);
$sparepart = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$sparepart) { // Jika data tidak ditemukan, hentikan script
    die("Data tidak ditemukan!");
}

// Proses update data saat form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_part = $_POST['nama_part']; // Ambil input nama part
    $jenis = $_POST['jenis'];         // Ambil input jenis
    $merek = $_POST['merek'];         // Ambil input merek
    $harga = $_POST['harga'];         // Ambil input harga
    $deskripsi = $_POST['deskripsi']; // Ambil input deskripsi

    // Jika ada file gambar baru yang diunggah
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name']; // Nama file baru
        $target_dir = "../assets/images/";   // Folder tujuan
        $target_file = $target_dir . basename($gambar);
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file); // Pindahkan file ke folder tujuan
    } else {
        $gambar = $sparepart['gambar']; // Jika tidak ada gambar baru, pakai gambar lama
    }

    // Query update data ke database
    $stmt = $pdo->prepare("UPDATE spareparts 
                           SET nama_part = :nama_part, jenis = :jenis, merek = :merek, harga = :harga, deskripsi = :deskripsi, gambar = :gambar
                           WHERE id = :id");
    $stmt->execute([
        'nama_part' => $nama_part,
        'jenis' => $jenis,
        'merek' => $merek,
        'harga' => $harga,
        'deskripsi' => $deskripsi,
        'gambar' => $gambar,
        'id' => $id
    ]);

    // Setelah update, redirect kembali ke halaman admin sparepart
    header("Location: admin_sparepart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Sparepart - YoungRides Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css"> <!-- CSS admin -->
</head>

<body>
    <!-- Header admin -->
    <div class="admin-header">
        <h1>Edit Sparepart</h1>
        <div class="nav-links">
            <a href="admin_sparepart.php">Kembali</a> <!-- Link kembali ke daftar sparepart -->
        </div>
    </div>

    <!-- Form edit sparepart -->
    <section class="admin-section fade-in">
        <form method="POST" enctype="multipart/form-data"> <!-- enctype untuk upload file -->
            <input type="text" name="nama_part" value="<?= htmlspecialchars($sparepart['nama_part']) ?>" required>
            <!-- Nama part -->
            <input type="text" name="jenis" value="<?= htmlspecialchars($sparepart['jenis']) ?>" required>
            <!-- Jenis -->
            <input type="text" name="merek" value="<?= htmlspecialchars($sparepart['merek']) ?>" required>
            <!-- Merek -->
            <input type="number" name="harga" value="<?= htmlspecialchars($sparepart['harga']) ?>" required>
            <!-- Harga -->
            <textarea name="deskripsi" required><?= htmlspecialchars($sparepart['deskripsi']) ?></textarea>
            <!-- Deskripsi -->

            <p>Gambar saat ini:</p>
            <img src="../assets/images/<?= $sparepart['gambar'] ?>" width="150" style="border-radius:6px;">
            <!-- Tampilkan gambar lama -->

            <input type="file" name="gambar" accept="image/*"> <!-- Upload gambar baru -->

            <button type="submit">Simpan Perubahan</button> <!-- Submit form -->
        </form>
    </section>

    <!-- Footer -->
    <footer>
        <p>© 2025 YoungRides Garage</p>
    </footer>
</body>

</html>