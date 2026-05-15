<?php
# anmol singh
# database connection for render + aiven mysql

$host = "mysql-1fff6c78-quiz-app.k.aivencloud.com";
$port = "22081";
$dbname = "defaultdb";
$user = "avnadmin";
$pass = "AVNS_zVle5yU7BdHZPXIs1hb";

try {

    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass
    );

    # enable errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    die("Database connection failed: " . $e->getMessage());
}
?>