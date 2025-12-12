<?php
include 'config/database.php'; // Memanggil file koneksi database PDO
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8"> <!-- Set karakter UTF-8 -->
    <title>Galeri Mobil - Garasi Muda</title> <!-- Judul halaman -->
    <link rel="icon" href="assets/images/logo.png"> <!-- Favicon -->
    <link rel="stylesheet" href="assets/css/style.css?v=2"> <!-- CSS eksternal -->

    <style>
        /* ===== Hero Section ===== */
        section.hero {
            padding: 150px 40px 100px;
            /* Padding atas, samping, bawah */
            text-align: center;
            /* Rata tengah */
            background: url('assets/images/gallery.jpg') center/cover fixed;
            /* Background image full cover, posisi center, fixed */
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
            <a href="gallery.php" class="active">Gallery</a> <!-- Halaman aktif -->
            <a href="cars.php">Cars</a>
            <a href="spareparts.php">Spareparts</a>
            <a href="contact.php">Contact</a>
        </nav>
    </header>

    <!-- ===== Hero Section ===== -->
    <section class="hero">
        <h1>Galeri Mobil Anak Muda</h1>
        <p>Beragam mobil populer dari Jepang, Eropa, dan Amerika.</p>
    </section>

    <!-- ===== Gallery Section ===== -->
    <section class="gallery fade-in">
        <div class="grid">
            <?php
            // Ambil semua data gambar dari tabel gallery, urut dari terbaru
            $stmt = $pdo->query("SELECT * FROM gallery ORDER BY id DESC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Tampilkan setiap gambar dalam elemen <img>
                echo "<img src='assets/images/{$row['gambar']}' alt='Foto Galeri'>";
            }
            ?>
        </div>
    </section>

    <!-- ===== Footer ===== -->
    <footer>
        <p>© 2025 Garasi Muda | Dibuat oleh Rifki Muhamad Fauzi</p>
    </footer>

    <!-- ===== Script JS ===== -->
    <script src="assets/js/script.js"></script> <!-- Script untuk animasi fade-in, scroll-top, dll -->
</body>

</html>