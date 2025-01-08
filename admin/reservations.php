<?php
session_start();
require_once '../config/database.php';

// Vérification de l'authentification
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Traitement des actions
if (isset($_POST['action'])) {
    $id = $_POST['id'];
    
    switch ($_POST['action']) {
        case 'confirm':
            $stmt = $pdo->prepare("UPDATE reservations SET status = 'confirmed' WHERE id = ?");
            $stmt->execute([$id]);
            break;
        case 'cancel':
            $stmt = $pdo->prepare("UPDATE reservations SET status = 'cancelled' WHERE id = ?");
            $stmt->execute([$id]);
            break;
        case 'delete':
            $stmt = $pdo->prepare("DELETE FROM reservations WHERE id = ?");
            $stmt->execute([$id]);
            break;
    }
    
    header("Location: reservations.php");
    exit();
}

// Récupération des réservations
$stmt = $pdo->query("SELECT * FROM reservations ORDER BY date DESC, time DESC");
$reservations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des réservations - Administration</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .admin-container {
            padding: 2rem;
            background: #f5f5f5;
            min-height: 100vh;
        }
        .reservations-table {
            width: 100%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-top: 2rem;
        }
        .reservations-table th,
        .reservations-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        .reservations-table th {
            background: var(--primary-color);
            color: white;
        }
        .status {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        .status-pending {
            background: #ffd700;
            color: #000;
        }
        .status-confirmed {
            background: #28a745;
            color: white;
        }
        .status-cancelled {
            background: #dc3545;
            color: white;
        }
        .action-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 0.5rem;
            color: white;
        }
        .confirm-btn {
            background: #28a745;
        }
        .cancel-btn {
            background: #dc3545;
        }
        .delete-btn {
            background: #6c757d;
        }
        .back-btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <a href="dashboard.php" class="back-btn">
            <i class="fas fa-arrow-left"></i> Retour au tableau de bord
        </a>
        
        <h1>Gestion des réservations</h1>
        
        <table class="reservations-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Personnes</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($reservations as $reservation): ?>
                <tr>
                    <td><?php echo date('d/m/Y', strtotime($reservation['date'])); ?></td>
                    <td><?php echo date('H:i', strtotime($reservation['time'])); ?></td>
                    <td><?php echo htmlspecialchars($reservation['name']); ?></td>
                    <td><?php echo htmlspecialchars($reservation['email']); ?></td>
                    <td><?php echo htmlspecialchars($reservation['phone']); ?></td>
                    <td><?php echo $reservation['guests']; ?></td>
                    <td>
                        <span class="status status-<?php echo $reservation['status']; ?>">
                            <?php echo ucfirst($reservation['status']); ?>
                        </span>
                    </td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $reservation['id']; ?>">
                            
                            <?php if($reservation['status'] == 'pending'): ?>
                            <button type="submit" name="action" value="confirm" class="action-btn confirm-btn">
                                <i class="fas fa-check"></i>
                            </button>
                            <?php endif; ?>
                            
                            <?php if($reservation['status'] != 'cancelled'): ?>
                            <button type="submit" name="action" value="cancel" class="action-btn cancel-btn">
                                <i class="fas fa-times"></i>
                            </button>
                            <?php endif; ?>
                            
                            <button type="submit" name="action" value="delete" class="action-btn delete-btn" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
