<?php
$host = 'localhost';
$dbname = 'Arteco';
$username = 'root';
$password = 'root';
$dsn = "mysql:host=$host;dbname=$dbname";

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die('Erreur de connexion: ' . $e->getMessage());
}
?>