# 🎓 School Agent - Plateforme d'Assistants IA Éducatifs

[![PHP Version](https://img.shields.io/badge/PHP-8.3+-blue.svg)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

## 📋 Table des matières

- [Description](#-description)
- [Fonctionnalités](#-fonctionnalités)
- [Technologies](#-technologies)
- [Architecture](#-architecture)
- [Base de données](#-base-de-données)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Utilisation](#-utilisation)
- [Structure du projet](#-structure-du-projet)
- [Documentation](#-documentation)
- [Équipe](#-équipe)

---

## 📘 Description

**School Agent** est une plateforme web éducative innovante qui met à disposition des **assistants IA spécialisés** pour accompagner les étudiants dans leur apprentissage. Chaque assistant est un expert dans un domaine spécifique (mathématiques, français, histoire, sciences, etc.) et dialogue avec les utilisateurs pour les aider à comprendre, réviser et progresser.

### 🎯 Objectifs du projet

- Fournir un accompagnement pédagogique 24/7
- Personnaliser l'apprentissage selon le niveau de chaque étudiant
- Offrir des explications claires et adaptées
- Sauvegarder l'historique des conversations
- Faciliter la révision et la préparation aux examens

### 🚀 Méthodologie Agile

Le projet suit une méthodologie **Agile** avec organisation en sprints :
- **Sprint 1** : Backend et base de données
- **Sprint 2** : Interface utilisateur et IA
- **Sprint 3** : Sécurité et RGPD

Les tâches sont suivies dans Trello :  
👉 [Accéder au tableau Trello](https://trello.com/invite/b/68ef748e0e82c5cecfcfe7db/ATTI2536ef6f89f22ec7129aa49833f94f442AF2FB7B/mon-tableau-trello)

---

## ✨ Fonctionnalités

### Pour les Étudiants
- ✅ **Authentification sécurisée** (inscription, connexion, gestion de session)
- ✅ **Sélection d'assistants IA** spécialisés par matière
- ✅ **Chat interactif** avec historique sauvegardé
- ✅ **Gestion des conversations** (créer, consulter, supprimer)
- ✅ **Interface moderne et responsive**
- ✅ **Réponses contextuelles** adaptées au niveau

### Pour les Administrateurs
- ✅ **Dashboard d'administration** complet
- ✅ **Gestion des utilisateurs** (CRUD)
- ✅ **Gestion des assistants IA** (création, configuration, activation/désactivation)
- ✅ **Gestion des niveaux scolaires** et matières
- ✅ **Logs et monitoring** des connexions
- ✅ **Configuration des prompts système** pour chaque assistant

### Intelligence Artificielle
- ✅ **API Groq** avec modèle Llama 3.3 70B
- ✅ **Prompts système personnalisés** par assistant
- ✅ **Réponses rapides** (< 2 secondes)
- ✅ **Contexte de conversation** maintenu

---

## 🛠️ Technologies

### Backend
- **PHP 8.3+** - Langage serveur
- **Architecture MVC** - Séparation des responsabilités
- **POO** - Programmation Orientée Objet
- **Composer** - Gestion des dépendances
- **PDO** - Accès sécurisé à la base de données

### Frontend
- **HTML5** - Structure sémantique
- **CSS3** - Styles modernes et animations
- **JavaScript (Vanilla)** - Interactions dynamiques
- **Design Responsive** - Compatible tous écrans

### Base de données
- **MySQL 8.0+** - Base de données relationnelle
- **Méthode Merise** - Modélisation (MCD/MLD/MPD)
- **Requêtes préparées** - Protection contre injections SQL

### Intelligence Artificielle
- **API Groq** - Service d'IA
- **Llama 3.3 70B** - Modèle de langage
- **cURL** - Communication HTTP

### Environnement
- **WAMP Server** - Environnement de développement Windows
- **Git** - Versioning du code
- **GitHub** - Hébergement du repository

---

## 🏗️ Architecture

Le projet utilise une **architecture MVC (Model-View-Controller)** personnalisée :

```
┌─────────────────────────────────────────────────────────┐
│                   NAVIGATEUR (Client)                   │
└─────────────────────────────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────┐
│                  public/index.php                       │
│              (Point d'entrée unique)                    │
│                    • Routing                            │
│                    • Session start                      │
└─────────────────────────────────────────────────────────┘
                          │
          ┌───────────────┼───────────────┐
          ▼               ▼               ▼
    ┌──────────┐   ┌──────────┐   ┌──────────┐
    │  MODELS  │   │CONTROLLERS│   │  VIEWS   │
    │          │   │           │   │          │
    │ • User   │◄──│ • Auth    │──►│ • HTML   │
    │ • Agent  │   │ • Home    │   │ • Twig   │
    │ • Conv.  │   │ • Ia      │   │ • CSS    │
    │ • Message│   │ • Admin   │   │ • JS     │
    └──────────┘   └──────────┘   └──────────┘
          │
          ▼
    ┌──────────┐
    │  MySQL   │
    │Database  │
    └──────────┘
```

### Flux d'une requête

1. **Client** : L'utilisateur accède à une URL (ex: `/ia/chat?id=5`)
2. **Routing** : `index.php` analyse l'URL et appelle le contrôleur approprié
3. **Controller** : Vérifie l'authentification, récupère les données via les Models
4. **Model** : Effectue les requêtes SQL et retourne les données
5. **View** : Affiche les données dans un template HTML
6. **Response** : Le HTML est envoyé au navigateur

---

## 💾 Base de données

### Méthode Merise - Modélisation

#### 📊 MCD (Modèle Conceptuel de Données)

```
┌────────────┐         ┌────────────┐         ┌────────────┐
│    USER    │         │CONVERSATION│         │   AGENT    │
├────────────┤         ├────────────┤         ├────────────┤
│ id_user    │1      N │id_conversation│    N│ id_agent   │
│ nom        ├─────────┤id_user     │─────────┤ nom        │
│ prenom     │         │id_agent    │         │ type       │
│ email      │         │date_creation│        │ description│
│ password   │         │statut      │         │ specialite │
│ role       │         └────────────┘         │ status     │
│ niveau     │               │1                │prompt_syst │
└────────────┘               │                 └────────────┘
                             │N
                      ┌──────▼──────┐
                      │   MESSAGE   │
                      ├─────────────┤
                      │ id_message  │
                      │ id_conv     │
                      │ role        │
                      │ contenu     │
                      │ timestamp   │
                      └─────────────┘
```

#### 🗂️ MLD (Modèle Logique de Données)

```
user(id_user, nom, prenom, email, mot_de_passe, role, niveau_education)
agent(id_agent, nom, type, description, specialite, status, prompt_system)
conversation(id_conversation, #id_user, #id_agent, date_creation, statut)
message(id_message, #id_conversation, role, contenu, timestamp)
level(id_level, nom)
subject(id_subject, nom)
user_log(id_log, #id_user, derniere_connexion, action)
user_agent(#id_user, #id_agent, date_assignation)
```

#### 🔗 Relations

- **user** ↔ **conversation** : Un utilisateur peut avoir plusieurs conversations (1,N)
- **agent** ↔ **conversation** : Un agent peut être utilisé dans plusieurs conversations (1,N)
- **conversation** ↔ **message** : Une conversation contient plusieurs messages (1,N)
- **user** ↔ **user_agent** ↔ **agent** : Association utilisateur/agent (N,N)

### 📐 MPD (Modèle Physique de Données)

```sql
CREATE TABLE user (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100),
    email VARCHAR(180) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'etudiant',
    niveau_education VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE agent (
    id_agent INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    type VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    specialite VARCHAR(100) NOT NULL,
    status VARCHAR(50) DEFAULT 'active',
    prompt_system TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE conversation (
    id_conversation INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT NOT NULL,
    id_agent INT NOT NULL,
    date_creation DATETIME NOT NULL,
    statut VARCHAR(50) DEFAULT 'active',
    FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_agent) REFERENCES agent(id_agent) ON DELETE CASCADE,
    INDEX idx_user (id_user),
    INDEX idx_agent (id_agent)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE message (
    id_message INT PRIMARY KEY AUTO_INCREMENT,
    id_conversation INT NOT NULL,
    role VARCHAR(50) NOT NULL,
    contenu TEXT NOT NULL,
    timestamp DATETIME NOT NULL,
    FOREIGN KEY (id_conversation) REFERENCES conversation(id_conversation) ON DELETE CASCADE,
    INDEX idx_conversation (id_conversation),
    INDEX idx_timestamp (timestamp)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

Fichier SQL complet : [`documents/doc_bdd/code_sql.txt`](documents/doc_bdd/code_sql.txt)

### 🔐 Sécurité de la base de données

- ✅ **Requêtes préparées PDO** - Protection contre injections SQL
- ✅ **Mots de passe hashés** - Utilisation de `password_hash()` bcrypt
- ✅ **Clés étrangères** - Intégrité référentielle avec CASCADE
- ✅ **Indexes** - Optimisation des performances sur colonnes fréquentes
- ✅ **Transactions** - Cohérence des données
- ✅ **UTF8MB4** - Support des emojis et caractères spéciaux

---

## 📥 Installation

### Prérequis

- **PHP 8.1+** ([Télécharger](https://www.php.net/downloads))
- **MySQL 8.0+** ou **WAMP/XAMPP** ([Télécharger WAMP](https://www.wampserver.com/))
- **Composer** ([Télécharger](https://getcomposer.org/download/))
- **Git** ([Télécharger](https://git-scm.com/downloads))

### Étapes d'installation

#### 1. Cloner le repository

```bash
git clone https://github.com/Roxiina/School_Agent.git
cd School_Agent
```

#### 2. Installer les dépendances PHP

```bash
composer install
```

Si Composer n'est pas installé :
```bash
# Windows
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

#### 3. Créer la base de données

**Option A : Via phpMyAdmin**
1. Démarrer WAMP/XAMPP
2. Accéder à http://localhost/phpmyadmin (port 3308 pour WAMP)
3. Créer une base de données nommée `schoolia`
4. Importer le fichier SQL : `documents/doc_bdd/code_sql.txt`

**Option B : En ligne de commande**

```bash
# Créer la base de données
mysql -u root -p -P 3308 -e "CREATE DATABASE schoolia CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Importer la structure
mysql -u root -p -P 3308 schoolia < documents/doc_bdd/code_sql.txt

# Importer les données de test (optionnel)
mysql -u root -p -P 3308 schoolia < documents/doc_bdd/jeu_donne.txt
```

#### 4. Configurer l'application

Créer le fichier de configuration : `app/Config/database.config.php`

```php
<?php
/**
 * Configuration Base de Données
 * WAMP Server - Port 3308 (pas 3306)
 */
return [
    'host' => 'localhost',
    'port' => '3308',        // Port MySQL WAMP (3306 pour XAMPP)
    'dbname' => 'schoolia',
    'username' => 'root',
    'password' => '',        // Votre mot de passe MySQL
    'charset' => 'utf8mb4'
];
```

**⚠️ Important** : Ce fichier est dans `.gitignore` pour protéger vos credentials.

#### 5. Configurer l'API Groq (optionnel)

Créer un fichier `app/Config/config.php` :

```php
<?php
return [
    'database' => [
        'host' => 'localhost',
        'port' => '3308',
        'dbname' => 'schoolia',
        'user' => 'root',
        'password' => ''
    ],
    'app' => [
        'name' => 'School Agent',
        'url' => 'http://localhost:8000',
        'environment' => 'development'
    ],
    'ai' => [
        'api_key' => 'VOTRE_CLE_API_GROQ',
        'api_url' => 'https://api.groq.com/openai/v1/chat/completions',
        'model' => 'llama-3.3-70b-versatile',
        'temperature' => 1.0
    ],
    'session' => [
        'lifetime' => 3600,
        'cookie_secure' => false,
        'cookie_httponly' => true
    ]
];
```

Obtenir une clé API gratuite : [https://console.groq.com/](https://console.groq.com/)

#### 6. Vérifier la configuration

```bash
# Tester la connexion à la base de données
php -r "require 'app/Config/Database.php'; echo 'Connexion OK\n';"

# Vérifier l'autoload Composer
php -r "require 'vendor/autoload.php'; echo 'Autoload OK\n';"
```

---

## ⚙️ Configuration

### Variables d'environnement

Le projet utilise des fichiers de configuration PHP au lieu de `.env` :

- `app/Config/database.config.php` - Configuration base de données
- `app/Config/config.php` - Configuration générale (API, session, etc.)

### Configuration WAMP

Si vous utilisez WAMP avec le port **3308** :

1. Vérifier que MySQL est démarré (icône WAMP verte)
2. Port par défaut : **3308**
3. PhpMyAdmin : http://localhost/phpmyadmin
4. Credentials par défaut : `root` / (pas de mot de passe)

### Configuration Apache (optionnel)

Pour utiliser Apache au lieu du serveur PHP intégré, créer un VirtualHost :

```apache
<VirtualHost *:80>
    ServerName schoolagent.local
    DocumentRoot "C:/wamp64/www/School_Agent/public"
    
    <Directory "C:/wamp64/www/School_Agent/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Ajouter dans `C:\Windows\System32\drivers\etc\hosts` :
```
127.0.0.1 schoolagent.local
```

---

## 🚀 Utilisation

### Démarrer le serveur de développement

```bash
# Se placer dans le dossier du projet
cd School_Agent

# Démarrer le serveur PHP intégré
php -S localhost:8000 -t public
```

Le serveur démarre sur **http://localhost:8000**

### Accéder à l'application

Ouvrir votre navigateur et accéder à : **http://localhost:8000**

### Comptes de test

**Étudiant** :
- Email : `etudiant@test.com`
- Mot de passe : `password123`

**Administrateur** :
- Email : `admin@test.com`
- Mot de passe : `admin123`

### Arrêter le serveur

Appuyer sur `Ctrl + C` dans le terminal

### Dépannage

**Erreur "ERR_EMPTY_RESPONSE"** :
- Vérifier que WAMP/MySQL est démarré
- Vérifier le fichier `database.config.php`
- Vérifier les logs PHP : `var/log/php_errors.log`

**Erreur "session_start()"** :
- Déjà corrigée dans la dernière version
- La session démarre dans `public/index.php`

**Port 8000 occupé** :
- Utiliser un autre port : `php -S localhost:8080 -t public`

---

## 📁 Structure du projet

```
School_Agent/
├── app/
│   ├── Config/                    # Configuration
│   │   ├── Authenticator.php     # Gestion des sessions
│   │   ├── Database.php           # Singleton PDO
│   │   ├── database.config.php    # Credentials BDD (gitignored)
│   │   └── config.php             # Config générale (gitignored)
│   │
│   ├── Controllers/               # Contrôleurs (logique métier)
│   │   ├── AuthController.php    # Authentification
│   │   ├── Front/                # Contrôleurs front-end
│   │   │   ├── HomeController.php
│   │   │   ├── IaController.php
│   │   │   └── ...
│   │   └── Admin/                # Contrôleurs admin
│   │       ├── AdminController.php
│   │       ├── AdminUserController.php
│   │       └── ...
│   │
│   ├── Models/                    # Modèles (accès BDD)
│   │   ├── UserModel.php
│   │   ├── AgentModel.php
│   │   ├── ConversationModel.php
│   │   ├── MessageModel.php
│   │   └── ...
│   │
│   └── Views/                     # Vues (templates HTML)
│       ├── front/                # Vues utilisateur
│       │   ├── home.php
│       │   ├── login.php
│       │   └── ia/
│       │       ├── ia.php
│       │       └── conversation/
│       │           ├── index.php
│       │           └── show.php
│       ├── admin/                # Vues administration
│       │   ├── dashboard.php
│       │   └── ...
│       └── templates/            # Templates réutilisables
│           ├── header.php
│           └── footer.php
│
├── public/                        # Dossier public (accessible web)
│   ├── index.php                 # Point d'entrée unique
│   ├── css/                      # Styles CSS
│   │   └── front/
│   │       ├── home.css
│   │       ├── ia.css
│   │       ├── chat.css
│   │       └── ...
│   ├── js/                       # Scripts JavaScript
│   │   └── front/
│   │       ├── home.js
│   │       ├── chat.js
│   │       └── ...
│   └── images/                   # Images et assets
│
├── documents/                     # Documentation
│   ├── doc_bdd/                  # Documentation base de données
│   │   ├── schoolia-version1.txt # Script SQL complet
│   │   ├── code_sql.txt          # Structure BDD
│   │   ├── jeu_donne.txt         # Données de test
│   │   └── schoolia-version1.lo1 # Schéma Merise
│   └── Git log.txt               # Historique Git
│
├── vendor/                        # Dépendances Composer
│   └── autoload.php              # Autoloader
│
├── .gitignore                     # Fichiers ignorés par Git
├── composer.json                  # Dépendances PHP
├── composer.lock                  # Versions figées
├── README.md                      # Ce fichier
├── README_Symfony.md              # Guide migration Symfony
├── README_User_Story.md           # User Stories
└── Explication_site.md            # Documentation utilisateur
```

---

## 📖 Documentation

### Documents disponibles

- **[README.md](README.md)** - Documentation principale (ce fichier)
- **[README_Symfony.md](README_Symfony.md)** - Guide de migration vers Symfony avec Docker
- **[README_User_Story.md](README_User_Story.md)** - User Stories et Backlog
- **[Explication_site.md](Explication_site.md)** - Fonctionnalités détaillées du site

### Documentation technique

#### Architecture MVC

Le projet suit une architecture MVC stricte :

**Model** :
```php
class UserModel {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
```

**Controller** :
```php
class AuthController {
    private $model;
    
    public function __construct() {
        $this->model = new UserModel();
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->model->getUserByEmail($_POST['email']);
            if ($user && password_verify($_POST['password'], $user['mot_de_passe'])) {
                Authenticator::login($user['id_user']);
                header('Location: /home');
            }
        }
        require __DIR__ . '/../Views/front/login.php';
    }
}
```

**View** :
```php
<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>
    <form method="POST">
        <input type="email" name="email" required>
        <input type="password" name="password" required>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
```

#### Sécurité

**Protection XSS** :
```php
<p>Bonjour <?= htmlspecialchars($user['prenom']) ?></p>
```

**Protection CSRF** (à implémenter) :
```php
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
```

**Requêtes préparées** :
```php
$stmt = $db->prepare("SELECT * FROM user WHERE email = :email");
$stmt->execute(['email' => $email]);
```

### Diagrammes

#### MCD (Modèle Conceptuel de Données)

Voir fichier : `documents/doc_bdd/schoolia-version1.lo1` (Looping)

#### Diagramme de classes POO

```
┌─────────────────────────┐
│      Database           │
│  (Singleton Pattern)    │
├─────────────────────────┤
│ - instance: Database    │
│ - connection: PDO       │
├─────────────────────────┤
│ + getInstance(): Database│
│ + getConnection(): PDO  │
└─────────────────────────┘
            ▲
            │
            │ utilise
            │
┌───────────┴─────────────┐
│      UserModel          │
├─────────────────────────┤
│ - db: PDO               │
├─────────────────────────┤
│ + getAllUsers(): array  │
│ + getUser(id): array    │
│ + createUser(data): bool│
│ + updateUser(id): bool  │
│ + deleteUser(id): bool  │
└─────────────────────────┘
```

---

## 👥 Équipe

### Développeurs

- **Olivier** - Backend & Base de données
- **Nicolas** - Frontend & Design
- **Flavie** - Full Stack & Architecture

### Rôles

- **Product Owner** : Définition des User Stories et priorisation
- **Scrum Master** : Animation des sprints et suivi Trello
- **Développeurs** : Implémentation des fonctionnalités

### Contact

- **GitHub** : [Roxiina/School_Agent](https://github.com/Roxiina/School_Agent)
- **Email** : contact@schoolagent.fr (exemple)

---

## 📝 Licence

Ce projet est sous licence **MIT**. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

---

## 🙏 Remerciements

- **Simplon** - Formation et accompagnement
- **Groq** - API d'intelligence artificielle
- **Communauté PHP** - Documentation et ressources

---

## 🔮 Roadmap

### Version actuelle : 1.0 (MVP)

✅ Authentification utilisateurs  
✅ Gestion des assistants IA  
✅ Chat interactif  
✅ Interface responsive  
✅ Panneau d'administration  

### Version 1.1 (Court terme)

- [ ] Notifications en temps réel
- [ ] Recherche dans l'historique
- [ ] Export des conversations en PDF
- [ ] Mode sombre
- [ ] Statistiques personnelles

### Version 2.0 (Moyen terme)

- [ ] Génération d'exercices personnalisés
- [ ] Quiz interactifs avec correction
- [ ] Partage de conversations
- [ ] Support vocal
- [ ] Application mobile

### Version 3.0 (Long terme)

- [ ] Migration vers Symfony
- [ ] Intégration Docker
- [ ] API REST complète
- [ ] Système de badges
- [ ] Groupes d'étude virtuels

---

## 📊 Statistiques du projet

- **Lignes de code PHP** : ~5000
- **Lignes de code CSS** : ~2000
- **Lignes de code JavaScript** : ~500
- **Tables BDD** : 8
- **Contrôleurs** : 15
- **Modèles** : 8
- **Vues** : 25+

---

**Version** : 1.0.0  
**Date** : Novembre 2025  
**Status** : Production Ready ✅

---

*Fait avec ❤️ pour l'éducation et l'apprentissage*
