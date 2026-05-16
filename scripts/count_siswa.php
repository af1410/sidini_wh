<?php
$host = '127.0.0.1';
$port = 3306;
$db = 'sidini';
$user = 'root';
$pass = '';
try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $stmt = $pdo->query("SELECT COUNT(*) as c FROM siswa");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($row);
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
}
