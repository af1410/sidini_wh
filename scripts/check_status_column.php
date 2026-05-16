<?php
$host = '127.0.0.1';
$port = 3306;
$db = 'sidini';
$user = 'root';
$pass = '';
try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $stmt = $pdo->query("SHOW COLUMNS FROM presensi LIKE 'status'");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($rows);
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
}
