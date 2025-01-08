# Plateforme de Formation en Ligne

Une plateforme moderne pour la vente et la diffusion de formations en vidéo.

## Fonctionnalités

- Page d'accueil avec présentation des formations
- Catalogue de formations avec filtres
- Pages détaillées pour chaque formation
- Lecteur vidéo intégré
- Système de paiement sécurisé
- Espace membre personnalisé
- Support client

## Installation

1. Cloner le repository
2. Installer les dépendances :
   ```bash
   npm install
   cd client
   npm install
   ```
3. Créer un fichier .env à la racine du projet
4. Lancer le serveur de développement :
   ```bash
   npm run dev:full
   ```

## Technologies Utilisées

- Frontend : React.js
- Backend : Node.js, Express
- Base de données : MongoDB
- Paiement : Stripe
- Authentification : JWT
- Stockage vidéo : AWS S3
