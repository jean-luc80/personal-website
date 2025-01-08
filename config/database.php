<?php
define('DB_HOST', 'localhost:3306');  // Ajout du port par défaut
define('DB_USER', 'root');            // Utilisateur par défaut de XAMPP
define('DB_PASS', '');                // Mot de passe vide par défaut
define('DB_NAME', 'restaurant_db');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Erreur de connexion: " . $e->getMessage());
}
?>
