<?php
session_start(); // Memulai session untuk mengecek login admin
include '../config/database.php'; // Menghubungkan ke database
// Cek login admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php"); // Jika belum login, redirect ke halaman login
    exit();
}
// Hapus pesan berdasarkan ID jika ada
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Ambil ID pesan dari query string
    $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = :id"); // Query hapus
    $stmt->execute(['id' => $id]); // Eksekusi query dengan parameter ID
}
// Setelah delete, kembali ke halaman contact admin
header("Location: admin_contact.php"); // Redirect ke halaman daftar pesan
exit(); // Hentikan eksekusi script
?>