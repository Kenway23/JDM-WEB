<?php
session_start(); // Memulai session untuk mengecek status login admin
include '../config/database.php'; // Menghubungkan ke database

// Cek apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php"); // Jika belum login, redirect ke halaman login
    exit();
}

// Ambil ID mobil dari query string
$id = $_GET['id'];

// Hapus gambar fisik dari folder jika ada
$stmt = $pdo->prepare("SELECT gambar FROM cars WHERE id=:id"); // Ambil nama file gambar
$stmt->execute(['id' => $id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row && file_exists("../assets/images/" . $row['gambar'])) {
    unlink("../assets/images/" . $row['gambar']); // Hapus file gambar fisik
}

// Hapus data mobil dari database
$stmt = $pdo->prepare("DELETE FROM cars WHERE id=:id");
$stmt->execute(['id' => $id]);

// Redirect kembali ke halaman admin setelah penghapusan
header("Location: admin.php");
exit();
?>