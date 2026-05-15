<?php

$host = "switchback.proxy.rlwy.net";
$db   = "railway";
$user = "root";
$pass = "PAYWpYNJGgiPIVpYybklPQYNNCTzMSHK";
$port = "48473";

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {

    $pdo = new PDO($dsn, $user, $pass);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    die("Database connection failed: " . $e->getMessage());

}

?>