<?php
session_start(); // Memulai session, agar bisa mengakses data session saat ini
session_destroy(); // Menghapus semua data session (logout user)
header("Location: login.php"); // Mengarahkan user kembali ke halaman login
exit(); // Menghentikan eksekusi script agar redirect berjalan sempurna
?>