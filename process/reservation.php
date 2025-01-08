<?php
require_once '../config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit();
}

try {
    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'guests' => $_POST['guests'],
        'date' => $_POST['date'],
        'time' => $_POST['time'],
        'special_requests' => $_POST['special_requests'] ?? ''
    ];

    // Validation
    if (empty($data['name']) || empty($data['email']) || empty($data['phone']) || 
        empty($data['guests']) || empty($data['date']) || empty($data['time'])) {
        throw new Exception('Tous les champs requis doivent être remplis');
    }

    // Validation de l'email
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Adresse email invalide');
    }

    // Validation de la date
    $reservation_date = new DateTime($data['date']);
    $today = new DateTime();
    if ($reservation_date < $today) {
        throw new Exception('La date de réservation doit être dans le futur');
    }

    // Insertion dans la base de données
    $sql = "INSERT INTO reservations (name, email, phone, guests, date, time, special_requests) 
            VALUES (:name, :email, :phone, :guests, :date, :time, :special_requests)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

    // Envoi d'un email de confirmation
    $to = $data['email'];
    $subject = "Confirmation de votre réservation - Muskoka Coffee & Tea House";
    $message = "
    Bonjour {$data['name']},

    Nous avons bien reçu votre réservation pour le {$data['date']} à {$data['time']}.
    Nombre de personnes : {$data['guests']}

    Nous vous confirmerons votre réservation dans les plus brefs délais.

    Cordialement,
    L'équipe Muskoka Coffee & Tea House
    ";
    
    $headers = "From: reservations@muskoka.com";
    
    mail($to, $subject, $message, $headers);

    echo json_encode([
        'success' => true,
        'message' => 'Réservation enregistrée avec succès'
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
?>
