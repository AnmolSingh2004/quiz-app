<?php
# anmol singh
# database connection file for the quiz app

# database host, usually localhost for AMPPS or XAMPP
$host = "localhost";

# database name used by the quiz app
$dbname = "quiz_app";

# MySQL username
$user = "root";

# AMPPS usually uses mysql as the root password
# If you use XAMPP, this may need to be changed to an empty string: ""
$pass = "mysql";

try {

    # create a PDO database connection
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass
    );

    # show database errors clearly while testing
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    # stop the page if the database connection fails
    die("Database connection failed: " . $e->getMessage());
}
?>
