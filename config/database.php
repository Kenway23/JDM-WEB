<?php

$host = getenv("MYSQLHOST");
$port = getenv("MYSQLPORT");
$dbname = getenv("MYSQLDATABASE");
$username = getenv("MYSQLUSER");
$password = getenv("MYSQLPASSWORD");

try {
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 5,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Koneksi DB gagal");
}
