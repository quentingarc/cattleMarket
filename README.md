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

1. **Accéder au dossier backend.**

    ```bash
    cd cattle-market-market
    ```

2. **Installation des dépendances PHP**  

   Dans le répertoire principal du projet, installez les dépendances nécessaires avec Composer :
```bash
   composer install
   ```

3. **Configuration de l'Environnement : Créez un fichier .env.local pour personnaliser les variables d'environnement (ex. base de données SQLite) :**

```plaintext
    DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
```
4. **Exécuter les Migrations : Créez les tables de la base de données nécessaires pour le projet.**

```bash
    php bin/console doctrine:migrations:migrate
```
5. **Créer un Utilisateur Administrateur : Utilisez la commande dédiée pour ajouter un administrateur.**

```bash
    php bin/console app:create-admin-user
```
6. **Lancer le Serveur de Développement Vue.js :**
```bash
    npm run serve
```

Par défaut, l'application sera disponible à http://localhost:8080.


### 3. Installation du Frontend (Vue.js)

1. **Accéder au dossier frontend si le frontend est dans un dossier séparé.**

```bash
    cd cattle-market
```
2. **Installer les dépendances JavaScript**

```bash
    npm install
```
3. **Lancer le Serveur de Développement Vue.js :**

```bash
    symfony serve
```
Le backend sera accessible à http://localhost:8000.

## Utilisation

# Accès pour les Particuliers
Les utilisateurs peuvent :

- Voir la liste des animaux disponibles avec les détails nécessaires.
- Trier et filtrer les animaux par type, race, âge, etc.

# Accès pour l'Administrateur
L'administrateur peut :

- Accéder au back-office sécurisé pour ajouter, éditer ou supprimer des animaux.
- Gérer les informations suivantes pour chaque animal : nom, âge, type, race, description, statut (en vente, vendu), prix HT TTC, et photos.

## Temps de Développement

6 jours 


