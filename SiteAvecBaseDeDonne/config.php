<?php
// Définition des paramètres de connexion à la base de données
$host = 'localhost';  
$dbname = 'site_collection_carte';  
$username = 'root';  
$password = '';  
$port = 3306;  

try {
    // Tentative de connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Activation du mode d'erreur pour afficher les exceptions
} catch (PDOException $e) {
    // Si la connexion échoue, afficher un message d'erreur
    die("Erreur de connexion : " . $e->getMessage());
}
?>
