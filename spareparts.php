<?php
require_once __DIR__ . '/../config/database.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8"> <!-- Set karakter UTF-8 -->
    <title>Sparepart & Modifikasi - YoungRides Garage</title> <!-- Judul halaman -->
    <link rel="icon" href="assets/images/logo.png"> <!-- Favicon -->
    <link rel="stylesheet" href="assets/css/style.css?v=5"> <!-- CSS eksternal -->

    <style>
        /* ===== Hero Section ===== */
        section.hero {
            padding: 150px 40px 100px;
            /* Padding atas, samping, bawah */
            text-align: center;
            /* Rata tengah teks */
            background: url('assets/images/spare.jpg') center/cover fixed;
            /* Background image full cover dan fixed */
            position: relative;
            /* Relative untuk positioning elemen di dalamnya */
            color: #fff;
            /* Teks berwarna putih */
        }
    </style>
</head>

<body>
    <!-- ===== Header / Navbar ===== -->
    <header>
        <img src="assets/images/logo.png" class="logo" alt="logo"> <!-- Logo website -->
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="gallery.php">Gallery</a>
            <a href="cars.php">Cars</a>
            <a href="spareparts.php" class="active">Spareparts</a> <!-- Halaman aktif -->
            <a href="contact.php">Contact</a>
        </nav>
    </header>

    <!-- ===== Hero Section ===== -->
    <section class="hero">
        <h1>Sparepart & Modifikasi Mobil</h1> <!-- Judul hero -->
        <p>Koleksi komponen untuk meningkatkan performa dan tampilan mobil kamu.</p> <!-- Deskripsi hero -->
    </section>

    <!-- ===== Spareparts Section ===== -->
    <section class="cars fade-in">
        <div class="car-list">
            <?php
            // Ambil semua data sparepart dari tabel spareparts
            $stmt = $pdo->query("SELECT * FROM spareparts ORDER BY id DESC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "
            <div class='car-card'>
                <img src='assets/images/{$row['gambar']}' alt='{$row['nama_part']}'> <!-- Gambar sparepart -->
                <h3>{$row['nama_part']}</h3> <!-- Nama sparepart -->
                <p><strong>Jenis:</strong> {$row['jenis']}</p> <!-- Jenis sparepart -->
                <p><strong>Merek:</strong> {$row['merek']}</p> <!-- Merek sparepart -->
                <p><strong>Harga:</strong> Rp " . number_format($row['harga'], 0, ',', '.') . "</p> <!-- Harga -->
                <p>{$row['deskripsi']}</p> <!-- Deskripsi sparepart -->
            </div>
            ";
            }
            ?>
        </div>
    </section>

    <!-- ===== Footer ===== -->
    <footer>
        <p>© 2025 Garasi Muda | Dibuat oleh Rifki Muhamad Fauzi</p>
    </footer>

    <!-- ===== Script JS ===== -->
    <script src="assets/js/script.js"></script> <!-- Script untuk animasi fade-in, scroll-top button, dll -->
</body>

</html>