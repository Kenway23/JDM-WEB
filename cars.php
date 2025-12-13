<?php
require_once __DIR__ . '/../config/database.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8"> <!-- Set karakter UTF-8 -->
    <title>Koleksi Mobil - Garasi Muda</title> <!-- Judul halaman -->
    <link rel="icon" href="assets/images/logo.png"> <!-- Favicon -->
    <link rel="stylesheet" href="assets/css/style.css?v=2"> <!-- CSS eksternal -->

    <style>
        /* ===== Hero Section Style ===== */
        section.hero {
            padding: 150px 40px 100px;
            /* jarak atas, samping, bawah */
            text-align: center;
            /* teks rata tengah */
            background: url('assets/images/dream.jpg') center/cover fixed;
            /* background gambar full, tetap saat scroll */
            position: relative;
            /* posisi relatif untuk elemen dalamnya */
            color: #fff;
            /* teks putih */
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
            <a href="cars.php" class="active">Cars</a> <!-- Halaman aktif Cars -->
            <a href="spareparts.php">Spareparts</a>
            <a href="contact.php">Contact</a>
        </nav>
    </header>

    <!-- ===== Hero Section ===== -->
    <section class="hero">
        <h1>Koleksi Mobil Anak Muda</h1> <!-- Judul hero -->
        <p>Mobil impian dari Jepang, Eropa, dan Amerika.</p> <!-- Deskripsi singkat -->
    </section>

    <!-- ===== Cars Section / Koleksi Mobil ===== -->
    <section class="cars fade-in">
        <div class="car-list">
            <?php
            // Ambil semua data mobil dari tabel cars
            $stmt = $pdo->query("SELECT * FROM cars");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Tampilkan setiap mobil dalam card
                echo "
      <div class='car-card fade-in'>
        <img src='assets/images/{$row['gambar']}' alt='{$row['nama_mobil']}'> <!-- Gambar mobil -->
        <h3>{$row['nama_mobil']}</h3> <!-- Nama mobil -->
        <p><strong>Merek:</strong> {$row['merek']}</p> <!-- Merek mobil -->
        <p><strong>Negara:</strong> {$row['negara']}</p> <!-- Negara asal mobil -->
        <p>{$row['deskripsi']}</p> <!-- Deskripsi mobil -->
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
    <script src="assets/js/script.js"></script> <!-- Script untuk animasi fade-in dan scroll-top -->
</body>

</html>