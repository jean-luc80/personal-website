<?php
session_start();
require_once '../config/database.php';

// Vérification de l'authentification
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Récupération des statistiques
$stmt = $pdo->query("SELECT COUNT(*) as total FROM reservations WHERE status = 'pending'");
$pending_reservations = $stmt->fetch()['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM newsletter_subscribers WHERE status = 'active'");
$active_subscribers = $stmt->fetch()['total'];

$stmt = $pdo->query("SELECT COUNT(*) as total FROM menu_items");
$menu_items = $stmt->fetch()['total'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Administration</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .admin-dashboard {
            padding: 2rem;
            background: #f5f5f5;
            min-height: 100vh;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .stat-card h3 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        .stat-card .number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--accent-color);
        }
        .admin-nav {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .admin-nav a {
            background: var(--primary-color);
            color: white;
            padding: 1rem;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
        }
        .admin-nav a:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }
        .logout-btn {
            background: #dc3545;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="admin-dashboard">
        <div class="admin-header">
            <h1>Tableau de bord</h1>
            <a href="logout.php" class="logout-btn">Déconnexion</a>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Réservations en attente</h3>
                <div class="number"><?php echo $pending_reservations; ?></div>
            </div>
            <div class="stat-card">
                <h3>Abonnés newsletter</h3>
                <div class="number"><?php echo $active_subscribers; ?></div>
            </div>
            <div class="stat-card">
                <h3>Items du menu</h3>
                <div class="number"><?php echo $menu_items; ?></div>
            </div>
        </div>

        <nav class="admin-nav">
            <a href="reservations.php">
                <i class="fas fa-calendar-alt"></i> Gérer les réservations
            </a>
            <a href="menu.php">
                <i class="fas fa-utensils"></i> Gérer le menu
            </a>
            <a href="newsletter.php">
                <i class="fas fa-envelope"></i> Gérer la newsletter
            </a>
            <a href="images.php">
                <i class="fas fa-images"></i> Gérer les images
            </a>
        </nav>

        <div class="recent-activity">
            <!-- Nous ajouterons ici les activités récentes plus tard -->
        </div>
    </div>

    <script>
        // Nous ajouterons ici le JavaScript pour les notifications en temps réel plus tard
    </script>
</body>
</html>
