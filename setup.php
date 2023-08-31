<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "gwsc_";

try {

    $conn = new PDO("mysql:host=$host", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$database'");
    if ($stmt->fetchColumn()) {
        echo "Error: Database already exists";
    } else {
        $conn->exec("CREATE DATABASE $database");
        echo "Database created successfully<br>";
        

        $conn->exec("USE $database");

        $sqlScript = file_get_contents("gwsc_db.sql");

        $conn->exec($sqlScript);
        echo "Tables and data created successfully<br>";
        echo "<a href='index.php'>Go to Homepage>>>>></a>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
