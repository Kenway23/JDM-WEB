<?php
session_start(); // Memulai session untuk mengecek status login admin
include '../config/database.php'; // Menghubungkan ke database

// Cek apakah admin sudah login, jika belum redirect ke login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Ambil ID gambar dari query string (URL)
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: admin_gallery.php"); // Jika tidak ada ID, kembali ke halaman galeri admin
    exit();
}

// Ambil data gambar dari tabel gallery berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM gallery WHERE id = :id");
$stmt->execute(['id' => $id]);
$gallery = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika data gambar tidak ditemukan, redirect kembali
if (!$gallery) {
    header("Location: admin_gallery.php");
    exit();
}

// Proses update gambar jika form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_FILES['gambar']['name'])) { // Jika admin memilih file baru
        $gambar = $_FILES['gambar']['name']; // Ambil nama file
        $target_dir = "../assets/images/";    // Folder tujuan upload
        $target_file = $target_dir . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file); // Pindahkan file ke folder

        // Update nama file di database
        $stmt = $pdo->prepare("UPDATE gallery SET gambar = :gambar WHERE id = :id");
        $stmt->execute([
            'gambar' => $gambar,
            'id' => $id
        ]);

        // Redirect kembali ke halaman admin galeri setelah update
        header("Location: admin_gallery.php");
        exit();
    } else {
        $error = "⚠️ Silakan pilih file gambar baru."; // Pesan error jika tidak ada file yang dipilih
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Gambar Galeri - Garasi Muda Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css?v=2"> <!-- CSS halaman admin -->
</head>

<body>
    <!-- Header dashboard admin -->
    <div class="admin-header">
        <h1>Dashboard Admin</h1>
        <div class="nav-links">
            <a href="admin.php">Tambah Mobil</a>
            <a href="admin_gallery.php" class="active">Tambah Galeri</a>
            <a href="admin_sparepart.php">Tambah Sparepart</a>
            <a href="admin_contact.php">Pesan Pengunjung</a>
            <a href="../index.php" target="_blank">Lihat Website</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Form edit gambar -->
    <section class="admin-section fade-in">
        <h2>Edit Gambar Galeri</h2>

        <!-- Tampilkan pesan sukses atau error jika ada -->
        <?php if (!empty($success))
            echo "<p class='success'>$success</p>"; ?>
        <?php if (!empty($error))
            echo "<p class='error'>$error</p>"; ?>

        <form method="POST" enctype="multipart/form-data"> <!-- enctype untuk upload file -->
            <p>Gambar saat ini:</p>
            <!-- Tampilkan gambar lama -->
            <img src="../assets/images/<?php echo $gallery['gambar']; ?>" alt=""
                style="width:200px; border-radius:8px; margin-bottom:10px;">
            <!-- Input file untuk upload gambar baru -->
            <input type="file" name="gambar" accept="image/*" required>
            <button type="submit">Update Gambar</button> <!-- Submit form -->
        </form>
    </section>
</body>

</html>