# Plateforme de Vente de Bétail

## Description du Projet
Ce projet est une plateforme de vente de bétail destinée aux particuliers, développée pour une ferme familiale. La plateforme offre aux utilisateurs la possibilité de parcourir, trier, et filtrer les animaux en vente. Les fermiers peuvent gérer la liste des animaux via un back-office sécurisé.

### Fonctionnalités
- **Catalogue d'Animaux** : Affichage de la liste des animaux avec des informations détaillées et la possibilité de filtrer par type, race, etc.
- **Gestion Admin** : Interface pour ajouter, modifier et supprimer des animaux en vente.
- **Sécurité** : Accès restreint au back-office pour l'administrateur uniquement, avec authentification.
- **Front et Back** : Frontend développé avec Vue.js pour l’interaction utilisateur, et backend avec Symfony pour la gestion des données et logique métier.

## Technologies Utilisées
- **Backend** : Symfony, PHP, SQLite pour la base de données.
- **Frontend** : Vue.js, avec TailwindCSS pour le style.
- **Système de Contrôle de Version** : Git.

## Prérequis
Avant d'installer le projet, assurez-vous que les outils suivants sont installés sur votre machine :
- **PHP** 8.1 ou plus récent
- **Composer** pour la gestion des dépendances PHP
- **Node.js** et **npm** pour la gestion des dépendances JavaScript
- **Symfony CLI** pour gérer le serveur de développement et les commandes Symfony

## Installation

### 1. Cloner le Dépôt
Clonez le projet dans votre environnement de développement :
```bash
git clone git@github.com:quentingarc/cattleMarket.git
cd plateforme-vente-betail
```

### 2. Configuration du Backend (Symfony)

Pour configurer le backend de l'application, suivez les étapes ci-dessous :

1. **Installation des dépendances PHP**  
   Dans le répertoire principal du projet, installez les dépendances nécessaires avec Composer :
   ```bash
   composer install
