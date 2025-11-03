# 🎓 School Agent - Documentation Technique

## 📋 Vue d'ensemble

School Agent est une plateforme éducative interactive développée en PHP avec une architecture MVC (Model-View-Controller). Le site permet aux utilisateurs d'interagir avec des agents IA spécialisés (Agent Mathéo, Agent Histoire, Agent Scolaire) et offre un panel d'administration moderne avec gestion des utilisateurs et modération des conversations.

## 🛠️ Technologies Utilisées

### Backend
- **PHP 8.x** - Langage principal du serveur
- **MySQL (Base: schoolia)** - Base de données relationnelle
- **Architecture MVC** - Organisation du code en namespaces
- **Sessions PHP** - Gestion de l'authentification avec rôles
- **PDO** - Accès sécurisé à la base de données
- **password_hash()** - Chiffrement des mots de passe

### Frontend
- **HTML5** - Structure des pages
- **Tailwind CSS** - Framework CSS utilitaire (via CDN)
- **JavaScript Vanilla** - Interactions et filtres en temps réel
- **Font Awesome 6.4.0** - Icônes (via CDN)
- **Animations CSS** - Effets de hover et transitions

### Serveur de développement
- **PHP Built-in Server** - `php -S localhost:8080 -t public`

## 📁 Structure du Projet

```
School_Agent/
├── app/
│   ├── Config/
│   │   ├── Database.php          # Connexion PDO Singleton
│   │   └── Authenticator.php     # Gestion sessions & rôles
│   ├── Controllers/
│   │   ├── AuthController.php    # Connexion/Déconnexion
│   │   ├── HomeController.php    # Page d'accueil
│   │   ├── UserController.php    # Profils utilisateurs
│   │   ├── ConversationController.php # Gestion conversations
│   │   ├── MessageController.php # Messages des conversations
│   │   ├── SubjectController.php # Pages matières
│   │   ├── LevelController.php   # Pages niveaux scolaires
│   │   └── AdminController.php   # Panel d'administration complet
│   ├── Models/
│   │   ├── UserModel.php         # Table utilisateur
│   │   ├── ConversationModel.php # Table conversation
│   │   ├── MessageModel.php      # Table message
│   │   ├── AgentModel.php        # Table agent
│   │   ├── SubjectModel.php      # Table matiere
│   │   └── LevelModel.php        # Table niveau_scolaire
│   └── Views/
│       ├── templates/            # Headers et footers réutilisables
│       ├── auth/                 # login.php
│       ├── admin/                # Interface d'administration moderne
│       │   ├── dashboard.php     # Tableau de bord avec stats
│       │   ├── users.php         # Gestion utilisateurs (cartes)
│       │   └── conversations.php # Gestion conversations (cartes)
│       ├── conversation/         # Interface conversations
│       ├── subject/              # Pages des matières
│       ├── level/                # Pages des niveaux
│       ├── user/                 # Profils utilisateurs
│       └── home.php              # Page d'accueil avec agents
├── public/
│   ├── index.php                 # Point d'entrée et routage
│   └── images/                   # Assets statiques
├── documents/
│   └── doc_bdd/                  # Documentation base de données
│       ├── code_sql.txt          # Structure complète des tables
│       └── jeu_donne.txt         # Données de test
├── scripts/
│   ├── update_passwords.php      # Migration MD5 → password_hash
│   └── check_table_structure.php # Vérification structure BDD
└── vendor/                       # Autoloader Composer
```

## 🗄️ Base de Données SCHOOLIA - Structure Réelle

### Configuration
```php
// app/Config/Database.php - Singleton Pattern
private static $instance = null;
$host = 'localhost';
$dbname = 'schoolia';
$username = 'root';
$password = '';
```

### Tables Principales (7 tables)

#### 1. **niveau_scolaire** - Niveaux éducatifs
```sql
CREATE TABLE niveau_scolaire (
    id_niveau_scolaire INT AUTO_INCREMENT,
    niveau VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_niveau_scolaire)
);

-- Données
INSERT INTO niveau_scolaire (niveau) VALUES 
('Collège'), ('Lycée'), ('Université');
```

#### 2. **agent** - Agents IA spécialisés
```sql
CREATE TABLE agent (
    id_agent INT AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    avatar VARCHAR(255),
    description TEXT,
    temperature FLOAT,
    system_prompt TEXT,
    PRIMARY KEY (id_agent)
);

-- Données
INSERT INTO agent (nom, avatar, description, temperature, system_prompt) VALUES
('Agent Mathéo', 'math.png', 'Agent spécialisé en mathématiques', 0.7, 'Tu es un assistant de mathématiques.'),
('Agent Histoire', 'hist.png', 'Agent passionné d\'histoire et de culture générale', 0.6, 'Tu es un professeur d\'histoire.'),
('Agent Scolaire', 'school.png', 'Agent généraliste pour le suivi scolaire', 0.8, 'Tu aides les élèves à organiser leur travail.');
```

#### 3. **matiere** - Matières scolaires liées aux agents
```sql
CREATE TABLE matiere (
    id_matiere INT AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    id_agent INT NOT NULL,
    PRIMARY KEY (id_matiere),
    FOREIGN KEY (id_agent) REFERENCES agent(id_agent)
);

-- Données
INSERT INTO matiere (nom, id_agent) VALUES
('Mathématiques', 1), ('Histoire', 2), ('Méthodologie', 3);
```

#### 4. **utilisateur** - Comptes utilisateurs
```sql
CREATE TABLE utilisateur (
    id_user INT AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('etudiant', 'professeur', 'admin') DEFAULT 'etudiant',
    id_niveau_scolaire INT NOT NULL,
    PRIMARY KEY (id_user),
    FOREIGN KEY (id_niveau_scolaire) REFERENCES niveau_scolaire(id_niveau_scolaire)
);

-- Utilisateurs de test
INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, role, id_niveau_scolaire) VALUES
('Dupont', 'Alice', 'alice.dupont@example.com', MD5('password1'), 'etudiant', 1),
('Martin', 'Jean', 'jean.martin@example.com', MD5('password2'), 'professeur', 2),
('Durand', 'Sophie', 'sophie.durand@example.com', MD5('password3'), 'admin', 3);
```

#### 5. **user_log** - Historique des connexions
```sql
CREATE TABLE user_log (
    id_userlog INT AUTO_INCREMENT,
    derniere_connection DATETIME,
    id_user INT NOT NULL,
    PRIMARY KEY (id_userlog),
    UNIQUE (id_user),
    FOREIGN KEY (id_user) REFERENCES utilisateur(id_user)
);
```

#### 6. **conversation** - Discussions avec les agents
```sql
CREATE TABLE conversation (
    id_conversation INT AUTO_INCREMENT,
    titre VARCHAR(150),
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_agent INT NOT NULL,
    id_user INT NOT NULL,
    PRIMARY KEY (id_conversation),
    FOREIGN KEY (id_agent) REFERENCES agent(id_agent),
    FOREIGN KEY (id_user) REFERENCES utilisateur(id_user)
);
```

#### 7. **message** - Messages des conversations
```sql
CREATE TABLE message (
    id_message INT AUTO_INCREMENT,
    question TEXT,
    reponse TEXT,
    id_conversation INT NOT NULL,
    PRIMARY KEY (id_message),
    FOREIGN KEY (id_conversation) REFERENCES conversation(id_conversation)
);
```

#### 8. **utiliser** - Table de liaison utilisateur ↔ agent
```sql
CREATE TABLE utiliser (
    id_user INT NOT NULL,
    id_agent INT NOT NULL,
    PRIMARY KEY (id_user, id_agent),
    FOREIGN KEY (id_user) REFERENCES utilisateur(id_user),
    FOREIGN KEY (id_agent) REFERENCES agent(id_agent)
);
```

## 🛣️ Système de Routage

### Point d'Entrée - `public/index.php`

Le routage est géré par un système simple basé sur les paramètres GET :

```php
<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use SchoolAgent\Controllers\{
    HomeController, AuthController, AdminController, 
    UserController, ConversationController, SubjectController, LevelController
};

$page = $_GET['page'] ?? 'home';
$section = $_GET['section'] ?? null;

switch ($page) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
        
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
        
    case 'admin':
        $controller = new AdminController();
        switch ($section) {
            case 'users':
                $controller->users();        # Page complète moderne
                break;
            case 'conversations':
                $controller->conversations(); # Page complète moderne
                break;
            default:
                $controller->dashboard();     # Dashboard principal
        }
        break;
        
    case 'subject':
        $controller = new SubjectController();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller->show($id);
        } else {
            $controller->index();
        }
        break;
        
    case 'level':
        $controller = new LevelController();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller->show($id);
        } else {
            $controller->index();
        }
        break;
}
?>
```

### Exemples d'URLs

| URL | Description | Contrôleur | Vue |
|-----|-------------|------------|-----|
| `?page=home` | Page d'accueil avec agents | HomeController | home.php |
| `?page=login` | Connexion | AuthController | auth/login.php |
| `?page=admin` | Dashboard admin | AdminController | admin/dashboard.php |
| `?page=admin&section=users` | Gestion utilisateurs | AdminController | admin/users.php |
| `?page=admin&section=conversations` | Gestion conversations | AdminController | admin/conversations.php |
| `?page=subject&id=1` | Mathématiques | SubjectController | subject/show.php |
| `?page=level&id=2` | Lycée | LevelController | level/show.php |

## 🔐 Authentification et Autorisations

### Système de Sessions - `app/Config/Authenticator.php`
```php
class Authenticator {
    public static function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
    
    public static function getUserRole() {
        return $_SESSION['user_role'] ?? null;
    }
    
    public static function isAdmin() {
        return self::getUserRole() === 'admin';
    }
    
    public static function requireAdmin() {
        if (!self::isAdmin()) {
            header('Location: ?page=login');
            exit;
        }
    }
}
```

### Redirection basée sur les rôles - `AuthController.php`
```php
public function login() {
    if ($_POST) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $user = $this->userModel->getUserByEmail($email);
        
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_name'] = $user['prenom'] . ' ' . $user['nom'];
            
            // Redirection selon le rôle
            if ($user['role'] === 'admin') {
                header('Location: ?page=admin');
            } else {
                header('Location: ?page=home');
            }
            exit;
        }
    }
    
    require __DIR__ . '/../Views/auth/login.php';
}
```

## 🎨 Interface Utilisateur Moderne

### Pages Principales Créées

#### 1. **Page d'Accueil** (`home.php`)
- Hero section avec les 3 agents IA
- Grille des matières (Mathématiques, Histoire, Méthodologie)
- Design avec gradient bleu/indigo
- Conversations récentes de l'utilisateur

#### 2. **Dashboard Admin** (`admin/dashboard.php`)
- Statistiques en temps réel (utilisateurs, conversations)
- Graphiques de répartition par rôle
- Activité récente
- Navigation vers gestion utilisateurs/conversations

#### 3. **Gestion Utilisateurs** (`admin/users.php`)
- **Design moderne** : Cartes utilisateur avec avatars colorés par rôle
- **Statistiques** : Compteurs par rôle (admin, professeur, étudiant)
- **Recherche** : Filtrage en temps réel par nom/email
- **Actions** : Promouvoir/Rétrograder admin, Modifier, Supprimer
- **Thème** : Rouge/Rose

#### 4. **Gestion Conversations** (`admin/conversations.php`)
- **Design moderne** : Cartes conversation avec agents colorés
- **Statistiques** : Compteurs par agent (Mathéo, Histoire, Scolaire)
- **Filtrage** : Par agent, recherche par utilisateur/sujet
- **Détails** : Aperçu dernier message, nombre de messages
- **Thème** : Vert/Émeraude

#### 5. **Pages Matières** (`subject/`)
- Pages dédiées pour chaque matière
- Agent associé avec description
- Interface d'interaction avec l'IA

#### 6. **Pages Niveaux** (`level/`)
- Pages par niveau scolaire (Collège, Lycée, Université)
- Contenu adapté au niveau

### Design System
- **Couleurs** :
  - Admin Users : Rouge/Rose (#dc2626 → #ec4899)
  - Admin Conversations : Vert/Émeraude (#059669 → #10b981)
  - Pages Public : Bleu/Indigo (#2563eb → #4f46e5)
- **Animations** : slideInUp, fadeIn, pulse, float
- **Composants** : Cards avec hover, boutons avec glow effect
- **Layout** : Responsive, navigation moderne avec breadcrumbs

## 🐛 Erreurs Rencontrées et Solutions

### 1. **Migration MD5 → password_hash()**
**Problème** : Les mots de passe étaient stockés en MD5
```sql
-- Anciens mots de passe
mot_de_passe = MD5('password1')  -- 32 caractères
```

**Solution** : Script de migration `scripts/update_passwords.php`
```php
$map = [
    'alice.dupont@example.com' => 'password1',
    'jean.martin@example.com'  => 'password2',
    'sophie.durand@example.com'=> 'password3',
];

foreach ($map as $email => $plain) {
    $hash = password_hash($plain, PASSWORD_DEFAULT);
    $stmt = $db->prepare("UPDATE utilisateur SET mot_de_passe = :hash WHERE email = :email");
    $stmt->execute([':hash' => $hash, ':email' => $email]);
}
```

### 2. **Redirection Admin ne fonctionnait pas**
**Problème** : Tous les utilisateurs étaient redirigés vers home
```php
// Code défaillant
header('Location: ?page=home');
```

**Solution** : Vérification du rôle dans `AuthController`
```php
if ($user['role'] === 'admin') {
    header('Location: ?page=admin');
} else {
    header('Location: ?page=home');
}
```

### 3. **Erreur Array to String Conversion**
**Problème** : Méthode `getRecentUsers()` tentait d'accéder à une colonne inexistante
```
Notice: Array to string conversion in dashboard.php
```

**Solution** : Correction dans `UserModel.php`
```php
// Tentative originale (colonne inexistante)
SELECT * FROM utilisateur WHERE created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR)

// Solution temporaire
public function getRecentUsers() {
    return 0; // La table n'a pas de colonne created_at
}
```

### 4. **Serveur PHP dans le mauvais répertoire**
**Problème** : Serveur démarré depuis un sous-dossier
```bash
# Erreur
cd app/Views/level
php -S localhost:8080 -t public  # public n'existe pas ici
```

**Solution** : Toujours démarrer depuis la racine
```bash
# Correct
cd School_Agent
php -S localhost:8080 -t public
```

### 5. **Différences entre les tables prévues et réelles**
**Problème initial** : La documentation ne correspondait pas à la vraie structure
- Table `users` → Table `utilisateur` (vraie)
- Colonne `password` → Colonne `mot_de_passe` (vraie)
- Table `subjects` → Table `matiere` (vraie)
- Table `levels` → Table `niveau_scolaire` (vraie)

**Solution** : Adaptation des modèles à la vraie structure
```php
// UserModel.php - Adapté à la vraie table 'utilisateur'
$sql = "SELECT u.id_user, u.nom, u.prenom, u.email, u.role, n.niveau 
        FROM utilisateur u
        JOIN niveau_scolaire n ON u.id_niveau_scolaire = n.id_niveau_scolaire";
```

### 6. **Gestion des relations entre tables**
**Solution** : Utilisation des vraies clés étrangères
```php
// ConversationModel.php - Relations réelles
$sql = "SELECT c.id_conversation, c.titre, c.date_creation, 
               a.nom as agent_nom, a.avatar,
               u.nom as user_nom, u.prenom as user_prenom
        FROM conversation c
        JOIN agent a ON c.id_agent = a.id_agent
        JOIN utilisateur u ON c.id_user = u.id_user";
```

## 🚀 Installation et Démarrage

### Prérequis
- PHP 8.x
- MySQL/MariaDB
- Serveur web ou PHP built-in server

### Installation Complète

1. **Cloner le projet**
```bash
git clone [url-du-repo]
cd School_Agent
```

2. **Créer la base de données**
```sql
-- Créer la base
CREATE DATABASE schoolia CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

3. **Importer la structure**
```bash
# Copier le contenu de documents/doc_bdd/code_sql.txt dans MySQL
mysql -u root -p schoolia < code_sql.txt
```

4. **Importer les données de test**
```bash
# Copier le contenu de documents/doc_bdd/jeu_donne.txt dans MySQL
mysql -u root -p schoolia < jeu_donne.txt
```

5. **Configurer la connexion** (si nécessaire)
```php
// app/Config/Database.php
$host = 'localhost';
$dbname = 'schoolia';
$username = 'root';
$password = 'your_password';
```

6. **Migrer les mots de passe**
```bash
php scripts/update_passwords.php
```

7. **Démarrer le serveur**
```bash
php -S localhost:8080 -t public
```

### Accès à l'application

- **Site** : http://localhost:8080
- **Page de connexion** : http://localhost:8080?page=login

### Comptes de Test (après migration)

```
Admin (accès panel admin) :
- Email : sophie.durand@example.com
- Password : password3

Professeur :
- Email : jean.martin@example.com  
- Password : password2

Étudiant :
- Email : alice.dupont@example.com
- Password : password1
```

## 📚 Fonctionnalités Implémentées

### Pour les Utilisateurs
- ✅ Connexion avec redirection par rôle
- ✅ Page d'accueil avec agents IA
- ✅ Navigation par matières (Mathématiques, Histoire, Méthodologie)
- ✅ Navigation par niveaux (Collège, Lycée, Université)
- ✅ Interface de conversation avec agents
- ✅ Historique des conversations personnelles

### Pour les Administrateurs
- ✅ **Dashboard complet** avec statistiques temps réel
- ✅ **Gestion utilisateurs moderne** :
  - Interface en cartes avec avatars colorés
  - Recherche et filtrage en temps réel
  - Promotion/Rétrogradation des rôles
  - Suppression sécurisée (admin protected)
- ✅ **Modération des conversations** :
  - Interface en cartes par agent
  - Filtrage par agent (Mathéo, Histoire, Scolaire)
  - Aperçu des messages
  - Suppression des conversations
- ✅ **Navigation moderne** avec breadcrumbs
- ✅ **Design responsive** avec thèmes différenciés

### Agents IA Disponibles
1. **Agent Mathéo** (Mathématiques)
   - Icône : calculatrice
   - Couleur : Bleu
   - Spécialité : Résolution d'équations, algèbre

2. **Agent Histoire** (Histoire)
   - Icône : monument
   - Couleur : Orange/Rouge
   - Spécialité : Histoire, culture générale

3. **Agent Scolaire** (Méthodologie)
   - Icône : graduation
   - Couleur : Vert
   - Spécialité : Organisation, méthodologie de travail

## 🔧 Scripts Utiles

### Migration et Maintenance
```bash
# Migration des mots de passe MD5 → password_hash
php scripts/update_passwords.php

# Vérification de la structure de base de données
php scripts/check_table_structure.php
```

### Debug et Logs
```php
// Activation des erreurs (développement)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Logs personnalisés dans les modèles
error_log("Debug: " . print_r($data, true));
```

## 📈 Architecture Technique

### Pattern Singleton pour Database
```php
class Database {
    private static $instance = null;
    
    public static function getConnection() {
        if (self::$instance === null) {
            self::$instance = new PDO(/* config */);
        }
        return self::$instance;
    }
}
```

### Gestion sécurisée des requêtes
```php
// Toujours utiliser les requêtes préparées
$stmt = $this->db->prepare("SELECT * FROM utilisateur WHERE email = :email");
$stmt->execute([':email' => $email]);
```

### Namespaces et Autoloading
```php
namespace SchoolAgent\Controllers;
namespace SchoolAgent\Models;
namespace SchoolAgent\Config;

// Autoloader Composer
require_once __DIR__ . '/../vendor/autoload.php';
```

## 📋 Améliorations Futures Possibles

- [ ] **API REST** pour les interactions avec les agents IA
- [ ] **Chat en temps réel** avec WebSockets
- [ ] **Système de notifications** push
- [ ] **Upload d'avatar** pour les utilisateurs
- [ ] **Historique détaillé** des connexions (table user_log complète)
- [ ] **Système de permissions** granulaire
- [ ] **Export des données** en PDF/Excel
- [ ] **Dashboard analytics** avancé
- [ ] **Mode sombre/clair** pour l'interface
- [ ] **Mobile app** avec API

---

**Développé avec ❤️ pour l'éducation moderne**

*Documentation correspondant exactement à la structure réelle du projet School Agent*