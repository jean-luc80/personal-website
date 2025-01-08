<?php
session_start();

// Identifiants par défaut
$admin_username = "admin";
$admin_password = "admin123";

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    // Si oui, afficher le panneau d'administration
    $show_admin_panel = true;
} else {
    // Si non, vérifier les identifiants si le formulaire est soumis
    $show_admin_panel = false;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['username'] === $admin_username && $_POST['password'] === $admin_password) {
            $_SESSION['admin_logged_in'] = true;
            $show_admin_panel = true;
        } else {
            $error_message = "Identifiants incorrects";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Muskoka Coffee & Tea House</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .admin-container {
            min-height: 100vh;
            padding: 80px 20px;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('Capture\ d\'écran_7-1-2025_212412_www.instagram.com.jpeg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .admin-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 15px;
            width: 100%;
            max-width: 800px;
            margin-top: 2rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .admin-title {
            color: var(--accent-color);
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2rem;
        }

        .login-form {
            max-width: 400px;
            margin: 0 auto;
        }

        .admin-menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .admin-menu-item {
            background: rgba(139, 69, 19, 0.6);
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 215, 0, 0.3);
        }

        .admin-menu-item:hover {
            background: rgba(139, 69, 19, 0.8);
            transform: translateY(-3px);
        }

        .admin-menu-item h3 {
            margin: 0;
            color: var(--accent-color);
        }

        .admin-menu-item p {
            margin: 0.5rem 0 0 0;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .error-message {
            background: rgba(255, 0, 0, 0.1);
            color: #ff0000;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .logout-btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-box">
            <?php if (!$show_admin_panel): ?>
                <!-- Formulaire de connexion -->
                <h1 class="admin-title">Administration</h1>
                <?php if (isset($error_message)): ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <form method="POST" class="login-form">
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn-reserve">Connexion</button>
                </form>
            <?php else: ?>
                <!-- Panneau d'administration -->
                <h1 class="admin-title">Panneau d'administration</h1>
                <div class="admin-menu">
                    <a href="#" class="admin-menu-item" onclick="showReservations()">
                        <h3>Réservations</h3>
                        <p>Gérer les réservations</p>
                    </a>
                    <a href="#" class="admin-menu-item" onclick="showMenu()">
                        <h3>Menu</h3>
                        <p>Gérer les spécialités</p>
                    </a>
                    <a href="#" class="admin-menu-item" onclick="showMessages()">
                        <h3>Messages</h3>
                        <p>Voir les messages reçus</p>
                    </a>
                    <a href="#" class="admin-menu-item" onclick="showNewsletter()">
                        <h3>Newsletter</h3>
                        <p>Gérer les abonnés</p>
                    </a>
                </div>

                <div id="admin-content">
                    <!-- Le contenu dynamique sera chargé ici -->
                </div>

                <div style="text-align: center; margin-top: 2rem;">
                    <a href="?logout=1" class="logout-btn">Déconnexion</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function showReservations() {
            const content = document.getElementById('admin-content');
            content.innerHTML = '<h2>Chargement des réservations...</h2>';
            // Ici nous ajouterons le code pour charger les réservations
        }

        function showMenu() {
            const content = document.getElementById('admin-content');
            content.innerHTML = '<h2>Chargement du menu...</h2>';
            // Ici nous ajouterons le code pour gérer le menu
        }

        function showMessages() {
            const content = document.getElementById('admin-content');
            content.innerHTML = '<h2>Chargement des messages...</h2>';
            // Ici nous ajouterons le code pour voir les messages
        }

        function showNewsletter() {
            const content = document.getElementById('admin-content');
            content.innerHTML = '<h2>Chargement de la newsletter...</h2>';
            // Ici nous ajouterons le code pour gérer la newsletter
        }
    </script>
</body>
</html>
