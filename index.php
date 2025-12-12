<?php include 'config/database.php'; // Memanggil file koneksi database PDO ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8"> <!-- Set karakter UTF-8 -->
    <title>Garasi Muda</title> <!-- Judul halaman -->
    <link rel="icon" href="assets/images/logo.png"> <!-- Favicon -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS eksternal -->

    <style>
        /* ===== Hero Section ===== */
        section.hero {
            padding: 150px 40px 100px;
            /* Padding atas, samping, bawah */
            text-align: center;
            /* Rata tengah teks */
            background: url('assets/images/cars.jpg') center/cover fixed;
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
        <img src="assets/images/logo.png" alt="logo" class="logo"> <!-- Logo website -->
        <nav>
            <a href="index.php" class="active">Home</a> <!-- Halaman aktif -->
            <a href="about.php">About</a>
            <a href="gallery.php">Gallery</a>
            <a href="cars.php">Cars</a>
            <a href="spareparts.php">Spareparts</a>
            <a href="contact.php">Contact</a>
        </nav>
    </header>

    <!-- ===== Hero Section ===== -->
    <section class="hero">
        <h1>Selamat Datang di <span>Garasi Muda</span></h1> <!-- Judul besar -->
        <p>Eksplorasi dunia mobil anak muda dari Jepang, Eropa, hingga Amerika!</p> <!-- Deskripsi hero -->
        <a href="cars.php" class="btn">Lihat Koleksi</a> <!-- Tombol CTA -->
    </section>

    <!-- ===== Footer ===== -->
    <footer>
        <p>© 2025 Garasi Muda | Dibuat oleh Rifki Muhamad Fauzi</p>
    </footer>

    <!-- ===== Script JS ===== -->
    <script src="assets/js/script.js"></script> <!-- Script untuk animasi fade-in, scroll-top button, dll -->
</body>

</html>