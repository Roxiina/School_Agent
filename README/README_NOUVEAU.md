# 🎓 School Agent - Application de Chat avec IA

## 📋 Description

School Agent est une application web permettant aux étudiants de converser avec des agents IA spécialisés dans différentes matières. L'application utilise une architecture MVC avec PHP et MySQL pour la gestion des données.

---

## 🎯 Changements Récents (v2)

### ✨ Nouvelles Fonctionnalités Ajoutées

#### 1️⃣ **Icônes pour chaque agent**
- Chaque agent dispose maintenant d'une icône distinctive
- Les icônes apparaissent dans :
  - La liste des agents (sidebar)
  - Le header du chat
  - Les messages de l'agent
- **Mapping automatique** basé sur le nom de l'agent :
  - 📊 Mathéo → Calculatrice
  - 📖 Histoire → Livre
  - 🎓 Scolaire → Chapeau diplôme
  - 🖋️ Français → Stylo
  - 🔬 Science → Flacon
  - 🇬🇧 Anglais → Drapeau

#### 2️⃣ **Historique des conversations**
- Affichage de l'historique des conversations par agent
- Liste formatée avec :
  - Titre de la conversation
  - Date et heure (format JJ/MM/AAAA HH:MM)
  - Hover effects et animations
- Accès facile aux conversations précédentes

#### 3️⃣ **URLs RESTful propres**
- ✅ Ancien format : `/conversation?agent=1`
- ✅ Nouveau format : `/conversation/agent/1`
- Routing amélioré dans `public/index.php`
- Support des URLs avec paramètres en chemin

#### 4️⃣ **Theme cohérent**
- Couleurs alignées avec le reste de l'application
- Palette de couleurs :
  - Primaire : #2563eb (Bleu)
  - Accent : #10b981 (Vert)
  - Secondaire : #f8fafc (Gris clair)
- Design responsive et moderne

---

## 🔧 Configuration WAMP

### Port MySQL
⚠️ **Important** : L'application utilise le **port 3308** pour MySQL (pas 3306)

```php
// app/Config/database.config.php
'port' => '3308'
```

Si vous avez MySQL sur un port différent, mettez à jour ce fichier.

### Base de Données
- **Nom** : `schoolia`
- **Utilisateur** : `root`
- **Mot de passe** : (vide)
- **Charset** : utf8mb4

### Tables
- `utilisateur` - Utilisateurs (étudiants, professeurs, admins)
- `agent` - Agents IA
- `conversation` - Historique des conversations
- `message` - Messages individuels
- `niveau_scolaire` - Niveaux d'études
- `matiere` - Matières/Sujets
- `user_log` - Logs de connexion
- `utiliser` - Relations utilisateur-agent

---

## 🚀 Installation et Démarrage

### 1. Prérequis
- PHP 7.4+
- MySQL/WAMP
- Composer

### 2. Installation
```bash
# Cloner le repository
git clone https://github.com/Roxiina/School_Agent.git
cd School_Agent

# Installer les dépendances
composer install

# Créer la base de données
# Importer les fichiers SQL depuis documents/doc_bdd/
```

### 3. Démarrer le serveur
```bash
# Avec le router PHP
php -S localhost:8080 router.php

# Ou avec Apache/WAMP (utiliser .htaccess automatiquement)
```

### 4. Accéder à l'application
- **Accueil** : http://localhost:8080
- **Conversation** : http://localhost:8080/conversation
- **Admin** : http://localhost:8080/admin
- **Diagnostic** : http://localhost:8080/test-wamp.php

---

## 📁 Structure du Projet

```
School_Agent/
├── app/
│   ├── Config/
│   │   ├── Database.php          # Connexion MySQL
│   │   ├── database.config.php   # Configuration (PORT 3308)
│   │   └── Authenticator.php     # Gestion authentification
│   ├── Models/
│   │   ├── UserModel.php
│   │   ├── AgentModel.php
│   │   ├── ConversationModel.php
│   │   └── ...
│   ├── Controllers/
│   │   ├── Front/
│   │   │   ├── ConversationController.php  # Chat avec agents
│   │   │   ├── HomeController.php
│   │   │   └── AgentsController.php
│   │   └── Admin/
│   │       └── ...
│   └── Views/
│       ├── front/
│       │   ├── conversation.php    # Page chat (avec icônes + historique)
│       │   └── ...
│       └── admin/
│           └── ...
├── public/
│   ├── index.php                  # Router principal
│   ├── router.php                 # Router pour serveur PHP
│   ├── css/
│   │   └── front/
│   │       ├── conversation.css    # Styles conversation (icônes + historique)
│   │       └── ...
│   ├── js/
│   │   └── front/
│   │       ├── conversation.js     # JS pour chat
│   │       └── ...
│   └── test-wamp.php             # Diagnostic WAMP
├── documents/
│   └── doc_bdd/
│       ├── code_sql.txt           # Création tables
│       ├── jeu_donne.txt          # Données test
│       └── add_conversations_test.sql
└── composer.json
```

---

## 👥 Agents Disponibles

| Agent | ID | Spécialité | Icône |
|-------|----|----|-------|
| Agent Mathéo | 1 | Mathématiques | 📊 |
| Agent Histoire | 2 | Histoire & Culture | 📖 |
| Agent Scolaire | 3 | Suivi scolaire | 🎓 |
| Agent Français | 4 | Français & Littérature | 🖋️ |

---

## 🔐 Authentification

### Utilisateurs Test

| Email | Mot de passe | Rôle |
|-------|-------------|------|
| alice.dupont@example.com | password1 | Étudiant |
| jean.martin@example.com | password2 | Professeur |
| sophie.durand@example.com | password3 | Admin |

**Note** : Les mots de passe sont hashés en MD5 dans la base de test.

---

## 🐛 Dépannage

### "Connection refused"
- Vérifiez que WAMP est démarré
- Vérifiez le port MySQL (3308 par défaut)

### "Database not found"
- Créez la base `schoolia` dans phpMyAdmin
- Importez `documents/doc_bdd/code_sql.txt`

### Les agents ne s'affichent pas
- Vérifiez le port MySQL dans `app/Config/database.config.php`
- Exécutez `php public/test-wamp.php`

---

## 📊 Tests Disponibles

```bash
# Tester la connexion WAMP
http://localhost:8080/test-wamp.php

# Lister tous les agents
php public/list-all-agents.php

# Tester les modèles
php public/test-models.php

# Trouver le bon port MySQL
php public/find-mysql-port.php
```

---

## 📝 Fichiers Modifiés/Créés

| Fichier | Type | Description |
|---------|------|-------------|
| `app/Views/front/conversation.php` | Modifié | Ajout icônes + historique |
| `public/css/front/conversation.css` | Modifié | Styles pour icônes + historique |
| `app/controllers/Front/ConversationController.php` | Modifié | Chargement historique |
| `app/Models/ConversationModel.php` | Modifié | Méthode getConversationsByAgentAndUser() |
| `public/index.php` | Modifié | Routing RESTful |
| `app/Config/Database.php` | Modifié | Configuration flexible |
| `app/Config/database.config.php` | Créé | Configuration WAMP (PORT 3308) |
| `router.php` | Créé | Router pour serveur PHP |
| `public/test-wamp.php` | Créé | Diagnostic WAMP |
| `SETUP_WAMP.md` | Créé | Guide installation |

---

## 🎨 Design & UX

### Conversation Page
- ✅ Sidebar avec liste des agents (avec icônes)
- ✅ Chat area avec messages
- ✅ Historique des conversations scrollable
- ✅ Messages avec timestamps
- ✅ Responsive design (mobile, tablette, desktop)
- ✅ Theme couleurs cohérent

### Icons
- Utilise Font Awesome 6.4.0
- Icônes automatiquement assignées par agent
- Animations et hover effects

---

## 🔄 Workflow Utilisateur

1. **Connexion** → `/login`
2. **Accueil** → `/home`
3. **Conversation** → `/conversation`
4. **Sélectionner agent** → `/conversation/agent/1`
5. **Consulter historique** → Affiché dans la conversation
6. **Déconnexion** → `/logout`

---

## 📞 Support

Pour les problèmes :
1. Vérifiez `http://localhost:8080/test-wamp.php`
2. Consultez `SETUP_WAMP.md`
3. Vérifiez les logs PHP/MySQL
4. Vérifiez la configuration dans `app/Config/database.config.php`

---

## 📅 Version

- **Version** : 2.0
- **Date** : 5 novembre 2025
- **Statut** : En développement

---

## 📄 Licence

Projet étudiants - Simplon

---

**Dernière mise à jour** : 5 novembre 2025
