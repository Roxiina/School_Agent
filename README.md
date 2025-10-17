# 🎓 Plateforme IA Éducative avec Agent (Phase 1)

## 🧭 Méthodologie Agile

Le projet est organisé en 3 sprints sur Trello :
- **Sprint 1** : Backend et base de données
- **Sprint 2** : Interface utilisateur et IA
- **Sprint 3** : Sécurité et RGPD

Chaque fonctionnalité est définie sous forme de **User Story** :
> En tant que [rôle], je veux [objectif] afin de [bénéfice].

Les tâches sont suivies dans Trello :  
👉 [https://trello.com/invite/b/68ef748e0e82c5cecfcfe7db/ATTI2536ef6f89f22ec7129aa49833f94f442AF2FB7B/mon-tableau-trello]()s

## 📘 Description du projet
Ce projet a pour objectif de concevoir et implémenter une **plateforme éducative** permettant à des utilisateurs de créer et gérer des **agents IA personnalisés**.  
Cette première phase se concentre sur :
- la **modélisation de la base de données** (Merise),
- la **programmation orientée objet en PHP** (POO),
- la **mise en place d’un MVC manuel**,
- et le **respect du RGPD**.

La **Phase 2** intégrera un **LLM (Local ou API)** comme Ollama ou Llama pour permettre aux agents IA de générer des réponses pédagogiques.

---

## 🧠 Objectifs pédagogiques
- Maîtriser la **méthode Merise** (MCD, MLD, MPD).
- Implémenter une **base de données MySQL** robuste et conforme RGPD.
- Développer en **PHP orienté objet** avec un **MVC manuel**.
- Gérer un **CRUD complet** (Create, Read, Update, Delete) pour les entités.
- Créer une **interface utilisateur responsive** en **HTML / TailwindCSS / JS**.
- Appliquer les bonnes pratiques de **versionnement GitHub** et **méthodes agiles**.

---

## 🧩 Fonctionnalités principales

### 👤 Utilisateurs
- Inscription avec consentement RGPD.
- Connexion sécurisée (mot de passe hashé).
- Modification / Suppression du compte.
- Gestion du consentement et tri des données personnelles.

### 🤖 Agents IA
- Création d’un agent avec prompt personnalisé.
- Consultation et suppression des agents liés à un utilisateur.
- Stockage de l’historique d’interactions (Phase 2 : dialogue LLM).

### 🔐 Sécurité / RGPD
- Stockage du **mot de passe hashé** via `password_hash()`.
- Suppression automatique des données sur demande.
- Registre RGPD documenté.
- Protection contre les **injections SQL** (PDO préparé).

---

## 🧱 Architecture du projet (MVC manuel)
 Exemple :
```bash
PlateformeIA/
├── app/
│ ├── Controllers/
│ │ ├── UserController.php
│ │ └── AgentController.php
│ ├── Models/
│ │ ├── User.php
│ │ └── Agent.php
│ └── Views/
│ ├── users/
│ │ ├── register.php
│ │ ├── login.php
│ │ └── profile.php
│ └── agents/
│ ├── index.php
│ └── create.php
├── config/
│ └── database.php
├── public/
│ ├── css/
│ │ └── tailwind.css
│ ├── js/
│ │ └── main.js
│ └── index.php
├── sql/
│ └── script.sql
├── rgpd/
│ └── registre_rgpd.pdf
├── .gitignore
└── README.md
```


---

## 🧮 Base de données (Merise)

Exemple :
## MCD (Modèle Conceptuel de Données)
Entités principales :
- **User** (`id`, `nom`, `email`, `passwordHash`, `consentementRGPD`)
- **Agent** (`id`, `user_id`, `promptPerso`, `historique`)

Relations :
- Un **User** peut avoir **0,n Agents**  
- Un **Agent** appartient à **1 User**

## MLD (Modèle Logique de Données)
```bash
USER(id_user, nom, email, password_hash, consentement_rgpd)
AGENT(id_agent, user_id, prompt_perso, historique)

Clé primaire :

USER.id_user

AGENT.id_agent

Clé étrangère :

AGENT.user_id → USER.id_user

```

## MPD (MySQL)
Extrait du script SQL :

```sql
CREATE TABLE users (
  id_user INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  email VARCHAR(150) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  consentement_rgpd BOOLEAN DEFAULT FALSE
);

CREATE TABLE agents (
  id_agent INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  prompt_perso TEXT,
  historique TEXT,
  FOREIGN KEY (user_id) REFERENCES users(id_user) ON DELETE CASCADE
);
```
## 💻 Technologies utilisées
- Catégorie	Outils / Langages
- Back-End	PHP 8 (POO, PDO)
- Front-End	HTML5, TailwindCSS, JavaScript
- Base de données	MySQL
- Modélisation	Merise (Draw.io)
- Versionnement	Git / GitHub
- Outils RGPD	Registre de traitement (Word/PDF)

## ⚙️ Installation (en local)
Cloner le dépôt GitHub :

```bash
Copier le code
git clone https://github.com/Roxiina/School_Agent.git
cd plateforme-ia-educative
Créer la base de données
```
Importer le script sql/script.sql dans phpMyAdmin ou MySQL Workbench.

Configurer la connexion

Modifier config/database.php :

```php
Copier le code
define('DB_HOST', 'localhost');
define('DB_NAME', 'plateforme_ia');
define('DB_USER', 'root');
define('DB_PASS', '');
```
Lancer le serveur PHP

```bash
php -S localhost:8000 -t public
Accéder à la plateforme
👉 http://localhost:8000
```

## 🧾 Registre RGPD
- Le registre (rgpd/registre_rgpd.pdf) décrit :

- les types de données traitées,

- la finalité de leur usage (authentification, personnalisation),

- les durées de conservation,

- les procédures de suppression.

## 🧑‍💻 Équipe projet
- Product Owner : Roxina Fmnd
- Formateur référent : David Michel
- Chef de projet : Nicolas
- Développeurs : Olivier
- Méthodologie : Agile / Kanban (GitHub Projects ou Trello)

## ✅ Livrables attendus
- Diagramme MCD / MLD / MPD (Draw.io export PNG/PDF)

- Script SQL d’installation

- Code PHP MVC (CRUD complet)

- Interfaces HTML/Tailwind

- Registre RGPD (PDF)

- README.md (ce document)

- Démo live (≤ 15 min)

## 🚀 Phase 2 (Prévision)
- Passage à Laravel (Back-End API) et Vue.js (Front).

- Intégration d’un LLM local (Ollama / Llama).

- Connexion via API pour générer des réponses IA.

- Déploiement sur serveur local ou distant.

## 📄 Licence
- Projet pédagogique – Tous droits réservés © 2025
- Formation : Développeur·se en Intelligence Artificielle
- Encadrant : David Michel