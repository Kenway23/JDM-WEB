<?php
include '../config/database.php'; // Menghubungkan ke database
// Ambil ID gambar dari query string
$id = $_GET['id'];
// Hapus data gallery dari database berdasarkan ID
$stmt = $pdo->prepare("DELETE FROM gallery WHERE id = :id");
$stmt->execute(['id' => $id]);
// Redirect kembali ke halaman admin gallery setelah penghapusan
header("Location: admin_gallery.php");
exit();
?>