<?php
function getDatabaseConnection() {
    $dsn = 'mysql:host=localhost;dbname=mysql';
    $username = 'root';
    $password = '';
    
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
?>