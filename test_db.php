<?php
require_once 'config/database.php';

try {
    // Test de la connexion
    $query = "SHOW TABLES";
    $stmt = $pdo->query($query);
    $tables = $stmt->fetchAll();
    
    echo "Connexion réussie à la base de données!<br>";
    echo "Tables dans la base de données:<br>";
    foreach($tables as $table) {
        echo "- " . $table[0] . "<br>";
    }
} catch(PDOException $e) {
    echo "Erreur de connexion: " . $e->getMessage();
}
?>
