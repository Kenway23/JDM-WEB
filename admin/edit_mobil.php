<?php
session_start(); // Memulai session untuk cek status login admin
include '../config/database.php'; // Menghubungkan ke database

// Cek apakah admin sudah login, jika belum redirect ke halaman login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Ambil id mobil dari query string
$id = $_GET['id'];

// Ambil data mobil berdasarkan id
$stmt = $pdo->prepare("SELECT * FROM cars WHERE id = :id");
$stmt->execute(['id' => $id]);
$mobil = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika data tidak ditemukan, hentikan script
if (!$mobil) {
    die("Data tidak ditemukan!");
}

// Proses update data saat form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_mobil = $_POST['nama_mobil']; // Ambil input nama mobil
    $merek = $_POST['merek'];           // Ambil input merek
    $negara = $_POST['negara'];         // Ambil input negara
    $tahun = $_POST['tahun'];           // Ambil input tahun
    $deskripsi = $_POST['deskripsi'];   // Ambil input deskripsi

    // Update gambar jika ada file baru yang diunggah
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name']; // Nama file baru
        $target_dir = "../assets/images/";   // Folder tujuan
        $target_file = $target_dir . basename($gambar);
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file); // Pindahkan file
    } else {
        $gambar = $mobil['gambar']; // Jika tidak ada gambar baru, pakai gambar lama
    }

    // Query update data ke database
    $stmt = $pdo->prepare("UPDATE cars SET nama_mobil=:nama_mobil, merek=:merek, negara=:negara, tahun=:tahun, deskripsi=:deskripsi, gambar=:gambar WHERE id=:id");
    $stmt->execute([
        'nama_mobil' => $nama_mobil,
        'merek' => $merek,
        'negara' => $negara,
        'tahun' => $tahun,
        'deskripsi' => $deskripsi,
        'gambar' => $gambar,
        'id' => $id
    ]);

    // Setelah update, redirect kembali ke halaman admin
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Mobil - Garasi Muda Admin</title>
    <link rel="icon" href="../assets/images/logo.png">
    <link rel="stylesheet" href="../assets/css/admin.css"> <!-- CSS admin -->
</head>

<body>

    <!-- Header admin -->
    <div class="admin-header">
        <h1>Edit Data Mobil</h1>
        <div class="nav-links">
            <a href="admin.php">Kembali</a> <!-- Kembali ke daftar mobil -->
            <a href="logout.php">Logout</a> <!-- Logout admin -->
        </div>
    </div>

    <!-- Form edit mobil -->
    <section class="admin-section fade-in">
        <form method="POST" enctype="multipart/form-data"> <!-- enctype untuk upload file -->
            <input type="text" name="nama_mobil" value="<?= $mobil['nama_mobil'] ?>" required> <!-- Nama mobil -->
            <input type="text" name="merek" value="<?= $mobil['merek'] ?>" required> <!-- Merek -->
            <input type="text" name="negara" value="<?= $mobil['negara'] ?>" required> <!-- Negara -->
            <input type="number" name="tahun" value="<?= $mobil['tahun'] ?>" required> <!-- Tahun -->
            <textarea name="deskripsi" required><?= $mobil['deskripsi'] ?></textarea> <!-- Deskripsi -->

            <p>Gambar saat ini:</p>
            <img src="../assets/images/<?= $mobil['gambar'] ?>" width="200"
                style="border-radius:8px; margin-bottom:10px;"> <!-- Tampilkan gambar lama -->

            <input type="file" name="gambar" accept="image/*"> <!-- Upload gambar baru -->

            <button type="submit">Simpan Perubahan</button> <!-- Submit form -->
        </form>
    </section>

</body>

</html>