<?php
// Secure database connection using PDO
$host = "localhost";      // Servidor de base de datos
$dbName = "userDatabase"; // Nombre de la base de datos
$username = "root";       // Usuario
$password = "";           // Contraseña

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Database connection failed: " . $e->getMessage());
}
?>
