<?php
require_once 'config/database.php';

// Récupération des spécialités depuis la base de données
$stmt = $pdo->query("SELECT * FROM menu_items WHERE is_featured = 1 LIMIT 6");
$specialties = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muskoka Coffee & Tea House</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="images/logo.png" alt="Muskoka Logo">
            </div>
            <ul class="nav-links">
                <li><a href="#accueil">Accueil</a></li>
                <li><a href="#specialites">Spécialités</a></li>
                <li><a href="#reservation">Réservation</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </nav>
    </header>

    <main>
        <section id="accueil" class="hero">
            <div class="hero-content">
                <h1>Bienvenue chez Muskoka</h1>
                <p>Découvrez notre sélection de cafés et thés d'exception</p>
                <a href="#reservation" class="btn primary">Réserver une table</a>
                <a href="#specialites" class="btn secondary">Nos spécialités</a>
            </div>
        </section>

        <section id="specialites" class="specialites">
            <div class="container">
                <h2>Nos Spécialités</h2>
                <div class="specialites-grid">
                    <?php foreach($specialties as $specialty): ?>
                    <div class="specialite-card">
                        <img src="<?php echo htmlspecialchars($specialty['image_path']); ?>" 
                             alt="<?php echo htmlspecialchars($specialty['name']); ?>">
                        <h3><?php echo htmlspecialchars($specialty['name']); ?></h3>
                        <p><?php echo htmlspecialchars($specialty['description']); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="reservation" class="reservation-section">
            <div class="container">
                <h2>Réserver une table</h2>
                <div class="reservation-content">
                    <form id="reservation-form" class="reservation-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Nom complet</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Téléphone</label>
                                <input type="tel" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="guests">Nombre de personnes</label>
                                <select id="guests" name="guests" required>
                                    <?php for($i = 1; $i <= 10; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> personne<?php echo $i > 1 ? 's' : ''; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" id="date" name="date" required>
                            </div>
                            <div class="form-group">
                                <label for="time">Heure</label>
                                <input type="time" id="time" name="time" required>
                            </div>
                        </div>
                        <div class="form-group full-width">
                            <label for="special_requests">Demandes spéciales</label>
                            <textarea id="special_requests" name="special_requests" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn-reserve">Réserver</button>
                    </form>
                </div>
            </div>
        </section>

        <section id="contact" class="location-section">
            <div class="container">
                <h2>Nous trouver</h2>
                <div class="location-content">
                    <div class="location-info">
                        <h3>Coordonnées</h3>
                        <p><i class="fas fa-map-marker-alt"></i> 123 Rue du Café, 75001 Paris</p>
                        <p><i class="fas fa-phone"></i> +33 1 23 45 67 89</p>
                        <p><i class="fas fa-envelope"></i> contact@muskoka.com</p>
                        <h3>Horaires</h3>
                        <p>Lundi - Vendredi : 8h - 20h</p>
                        <p>Samedi - Dimanche : 9h - 22h</p>
                    </div>
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.9916256937595!2d2.292292615674431!3d48.85837007928746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2964e34e2d%3A0x8ddca9ee380ef7e0!2sTour%20Eiffel!5e0!3m2!1sfr!2sfr!4v1647856687320!5m2!1sfr!2sfr" 
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Newsletter</h3>
                <form id="newsletter-form" class="newsletter-form">
                    <div class="form-group">
                        <input type="email" id="newsletter-email" name="email" placeholder="Votre email" required>
                        <button type="submit">S'abonner</button>
                    </div>
                </form>
            </div>
            <div class="footer-section">
                <h3>Suivez-nous</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <p class="copyright">&copy; 2025 Muskoka Coffee & Tea House. Tous droits réservés.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        // Gestion du formulaire de réservation
        document.getElementById('reservation-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('process/reservation.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    this.reset();
                } else {
                    alert(data.error);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors de la réservation');
            });
        });

        // Gestion du formulaire newsletter
        document.getElementById('newsletter-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('process/newsletter.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    this.reset();
                } else {
                    alert(data.error);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors de l\'inscription à la newsletter');
            });
        });
    </script>
</body>
</html>
