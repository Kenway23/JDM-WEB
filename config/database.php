<?php
$host = "caboose.proxy.rlwy.net";
$dbname = "railway";
$username = "root";
$password = "PumgOfCCwdYatVhUBhgNRryjmKnmTLcx";
$port = "11878";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>