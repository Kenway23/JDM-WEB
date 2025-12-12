<?php
include '../config/database.php'; // Menghubungkan ke database
// Ambil ID dari query string (URL)
$id = $_GET['id'];
// Siapkan query DELETE menggunakan prepared statement untuk keamanan
$stmt = $pdo->prepare("DELETE FROM spareparts WHERE id = :id");
// Eksekusi query dengan mengganti parameter :id dengan nilai $id
$stmt->execute(['id' => $id]);
// Setelah data dihapus, redirect kembali ke halaman admin sparepart
header("Location: admin_sparepart.php");
exit(); // Hentikan eksekusi script agar redirect langsung terjadi
?>