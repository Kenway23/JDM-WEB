<?php
session_start(); // Memulai session agar bisa menyimpan status login admin
include '../config/database.php'; // Memasukkan koneksi database (meskipun login saat ini pakai statis)

// Login sederhana
$admin_username = "admin"; // Username default admin
$admin_password = "12345"; // Password default admin

// Cek apakah form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username']; // Ambil input username dari form
    $password = $_POST['password']; // Ambil input password dari form

    // Validasi username dan password
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin'] = $username; // Simpan session admin
        header("Location: admin.php"); // Redirect ke halaman admin
        exit(); // Hentikan eksekusi script setelah redirect
    } else {
        $error = "Username atau password salah!"; // Jika login gagal, simpan pesan error
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Admin - Garasi Muda Garage</title>
    <link rel="icon" href="../assets/images/logo.png"> <!-- Icon tab browser -->
    <link rel="stylesheet" href="../assets/css/admin.css"> <!-- Link ke CSS admin -->
</head>

<body>
    <!-- Container login -->
    <div class="login-container fade-in">
        <h2>Login Admin</h2>

        <!-- Tampilkan pesan error jika ada -->
        <?php if (!empty($error))
            echo "<p class='error'>$error</p>"; ?>

        <!-- Form login -->
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required> <!-- Input username -->
            <input type="password" name="password" placeholder="Password" required> <!-- Input password -->
            <button type="submit">Login</button> <!-- Tombol submit -->
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <p>© 2025 Garasi Muda | Dibuat oleh Rifki Muhamad Fauzi</p>
    </footer>

    <!-- Script JS untuk efek fade-in dan interaksi admin (jika ada) -->
    <script src="../assets/js/admin.js?=v2"></script>
</body>

</html>