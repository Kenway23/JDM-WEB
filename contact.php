<?php
require_once __DIR__ . '/config/database.php';


// ===== Proses kirim pesan =====
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];   // Ambil input nama
    $email = $_POST['email']; // Ambil input email
    $pesan = $_POST['pesan']; // Ambil input pesan

    // Insert data ke tabel contacts
    $stmt = $pdo->prepare("INSERT INTO contacts (nama, email, pesan) VALUES (:nama, :email, :pesan)");
    $stmt->execute([
        'nama' => $nama,
        'email' => $email,
        'pesan' => $pesan
    ]);

    $success = "✅ Pesan kamu berhasil dikirim! 🚗💨"; // Pesan sukses
}

// ===== Ambil data komentar / pesan pengunjung =====
$stmt = $pdo->query("SELECT * FROM contacts ORDER BY id DESC");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8"> <!-- Set karakter UTF-8 -->
    <title>Kontak Kami - Garasi Muda</title> <!-- Judul halaman -->
    <link rel="icon" href="assets/images/logo.png"> <!-- Favicon -->
    <link rel="stylesheet" href="assets/css/style.css?v=5"> <!-- CSS eksternal -->
</head>

<body>
    <!-- ===== Header / Navbar ===== -->
    <header>
        <img src="assets/images/logo.png" class="logo" alt="logo"> <!-- Logo -->
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="gallery.php">Gallery</a>
            <a href="cars.php">Cars</a>
            <a href="spareparts.php">Spareparts</a>
            <a href="contact.php" class="active">Contact</a> <!-- Halaman aktif Contact -->
        </nav>
    </header>

    <!-- ===== Contact Section ===== -->
    <section class="contact fade-in">
        <h2>Hubungi Kami</h2>
        <p>Ingin berbagi cerita atau saran tentang dunia mobil? Kirimkan pesanmu!</p>

        <!-- Tampilkan pesan sukses jika ada -->
        <?php if (!empty($success)): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>

        <div class="contact-container">
            <!-- ===== Form kontak di kiri ===== -->
            <form method="POST" class="contact-form">
                <input type="text" name="nama" placeholder="Nama Anda" required>
                <input type="email" name="email" placeholder="Email Anda" required>
                <textarea name="pesan" placeholder="Tulis pesan Anda..." required></textarea>
                <button type="submit">Kirim Pesan</button>
            </form>

            <!-- ===== Daftar komentar / pesan pengunjung di kanan ===== -->
            <div class="comment-section">
                <h3>Pesan dari Pengunjung</h3>
                <div class="comment-list">
                    <?php if (count($contacts) > 0): ?>
                        <?php foreach ($contacts as $c): ?>
                            <div class="comment-box fade-in">
                                <h4><?= htmlspecialchars($c['nama']) ?></h4> <!-- Nama pengirim -->
                                <p class="comment-text"><?= nl2br(htmlspecialchars($c['pesan'])) ?></p> <!-- Pesan -->
                                <small><?= htmlspecialchars($c['email']) ?></small> <!-- Email -->
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Belum ada pesan masuk.</p> <!-- Jika belum ada pesan -->
                    <?php endif; ?>
                </div>
            </div>
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