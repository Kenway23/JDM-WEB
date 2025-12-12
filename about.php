<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8"> <!-- Set karakter UTF-8 -->
    <title>Tentang Garasi Muda</title> <!-- Judul halaman -->
    <link rel="icon" href="assets/images/logo.png"> <!-- Favicon -->
    <link rel="stylesheet" href="assets/css/style.css?v=5"> <!-- CSS eksternal -->

    <style>
        /* ===== Hero Section Style ===== */
        section.hero {
            padding: 150px 40px 100px;
            /* jarak atas, samping, bawah */
            text-align: center;
            /* teks rata tengah */
            background: url('assets/images/garage-bg.jpg') center/cover fixed;
            /* background gambar full, tetap saat scroll */
            position: relative;
            /* posisi relatif untuk elemen dalamnya */
            color: #fff;
            /* warna teks putih */
        }
    </style>
</head>

<body>
    <!-- ===== Header / Navbar ===== -->
    <header>
        <img src="assets/images/logo.png" class="logo" alt="logo"> <!-- Logo website -->
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php" class="active">About</a> <!-- Link aktif halaman About -->
            <a href="gallery.php">Gallery</a>
            <a href="cars.php">Cars</a>
            <a href="spareparts.php">Spareparts</a>
            <a href="contact.php">Contact</a>
        </nav>
    </header>

    <!-- ===== Hero Section ===== -->
    <section class="hero">
        <h1>Tentang Garasi Muda</h1> <!-- Judul besar -->
        <p>Komunitas otomotif muda yang menyalakan semangat, inovasi, dan gaya hidup pecinta mobil dari seluruh dunia.
        </p>
    </section>

    <!-- ===== About Section ===== -->
    <section class="about">
        <img src="assets/images/about-garage.jpg" alt="Garasi Muda"> <!-- Gambar about -->
        <div class="text">
            <h2>Siapa Kami?</h2>
            <p><strong>Garasi Muda</strong> lahir dari semangat anak muda pecinta otomotif. Kami menggabungkan kecintaan
                terhadap performa, modifikasi, dan desain mobil dari berbagai negara.</p>
            <p>Dari JDM hingga muscle car Amerika, kami menghargai setiap detail dari bodykit, mesin turbo, hingga
                suara knalpot yang khas.</p>
            <p>Kami juga menyediakan informasi tentang <em>sparepart</em>, modifikasi, dan teknologi otomotif terbaru
                agar para penggemar dapat terus update.</p>
        </div>
    </section>

    <!-- ===== Features Section / Fokus Kami ===== -->
    <section class="features">
        <h2>Fokus Kami</h2>
        <div class="feature-grid">
            <!-- Feature 1 -->
            <div class="feature">
                <img src="assets/images/icon-car.png" alt="Mobil">
                <h3>Mobil JDM & Eropa</h3>
                <p>Menyajikan koleksi dan ulasan mobil legendaris dari Jepang dan Eropa, mulai dari Skyline, Supra,
                    hingga BMW M Series.</p>
            </div>
            <!-- Feature 2 -->
            <div class="feature">
                <img src="assets/images/icon-tools.png" alt="Sparepart">
                <h3>Sparepart & Modifikasi</h3>
                <p>Bahas komponen performa tinggi seperti turbocharger, coilover, bodykit, dan tuning mesin yang membuat
                    mobil lebih bertenaga.</p>
            </div>
            <!-- Feature 3 -->
            <div class="feature">
                <img src="assets/images/icon-community.png" alt="Komunitas">
                <h3>Komunitas Aktif</h3>
                <p>Kami bukan sekadar media, tapi keluarga besar pecinta otomotif yang saling berbagi ilmu, event, dan
                    inspirasi.</p>
            </div>
        </div>
    </section>

    <!-- ===== Footer ===== -->
    <footer>
        <p>© 2025 Garasi Muda | Dibuat oleh Rifki Muhamad Fauzi</p>
    </footer>
</body>

</html>