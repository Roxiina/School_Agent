# 🎓 Plateforme IA Éducative – SCHOOLIA (Phase 1)

## 📘 Contexte du projet

Le projet **SCHOOLIA** vise à créer une plateforme éducative intelligente où des **étudiants**, **professeurs** et **administrateurs** peuvent interagir avec des **agents IA pédagogiques**.  
Cette première phase se concentre sur :
- la **base de données relationnelle MySQL** (modélisation MERISE),
- le **développement POO/MVC en PHP**,
- la **gestion RGPD** (consentement, suppression des données),
- et l’interface HTML/Tailwind/JS pour le CRUD et la navigation.

---

## 🧠 Objectif de la Phase 1

- Concevoir et implémenter la base de données SCHOOLIA (MySQL).
- Créer les classes PHP (User, Agent, Conversation, Message...).
- Implémenter le modèle MVC manuel.
- Mettre en place un CRUD complet.
- Respecter les règles de sécurité et de RGPD.

---

## 👥 Rôles utilisateurs

- 👨‍🎓 **Étudiant** : Apprend avec des agents IA.
- 👩‍🏫 **Professeur** : Crée et gère des agents IA.
- 👨‍💼 **Administrateur** : Supervise le système et la base de données.

---

## 📋 User Stories (Phase 1)

---

### US01 – Inscription utilisateur
**En tant qu’étudiant**, je veux créer un compte sur la plateforme.

**Tâches :**
- Créer le formulaire d’inscription (HTML/PHP)
- Valider les champs côté client et serveur
- Hacher le mot de passe
- Enregistrer dans la table `utilisateur`

**Critères d’acceptation :**
- Tous les champs sont remplis et validés
- Email unique
- Confirmation après inscription réussie

---

### US02 – Connexion utilisateur
**En tant qu’utilisateur**, je veux me connecter pour accéder à mon tableau de bord.

**Tâches :**
- Créer le formulaire de connexion
- Vérifier email et mot de passe
- Mettre à jour `user_log`
- Rediriger vers le tableau de bord

**Critères d’acceptation :**
- Connexion uniquement avec identifiants valides
- Message d’erreur clair en cas d’échec
- Journal de connexion mis à jour

---

### US03 – Liste et interaction avec les agents
**En tant qu’étudiant**, je veux voir les agents disponibles et discuter avec eux.

**Tâches :**
- Créer page listant les agents avec nom, avatar, description
- Créer une conversation dans `conversation` lors du premier message
- Lier conversation à `id_user` et `id_agent`

**Critères d’acceptation :**
- Liste d’agents affichée correctement
- Conversation créée automatiquement
- Affichage du titre dans l'historique et de la date

---

### US04 – Gestion du profil utilisateur
**En tant qu’étudiant**, une fois connecté je veux voir mon profil et modifier les données.

**Tâches :**
- Créer page listant les données de profil
- Validation ou annulation en cas de modification
- Possibilité de modifier chaque champs, même l'avatar (nécéssite une gestion d'image pas trop lourde)

**Critères d’acceptation :**
- Données de profil affichées correctement
- Bouton de validation fonctionnel (données mises à jour à l'affichage)
- Message clair de modification réussie et affichage des données mises à jour

---
### US05 – Liste et interaction avec les agents
**En tant qu’étudiant**, je veux voir les agents disponibles et discuter avec eux.

**Tâches :**
- Créer page listant agents (nom, avatar, description) correspondant au **niveau scolaire** et à la **matière** de l’étudiant  
- Créer une conversation dans `conversation` lors du premier message
- Lier conversation à `id_user` et `id_agent`

**Critères d’acceptation :**
- Liste des agents filtrée selon le niveau scolaire et la matière
- Conversation créée automatiquement
- Affichage du titre et de la date

---

### US06 – Échanger des messages
**En tant qu’étudiant**, je veux poser des questions à un agent et voir ses réponses.

**Tâches :**
- Créer la table `message`
- Envoyer et afficher les messages
- Charger l’historique d’une conversation

**Critères d’acceptation :**
- Messages enregistrés dans `message`
- Affichage instantané question/réponse
- Historique consultable

---

### US07 – Suppression des conversations (RGPD)
**En tant qu’étudiant**, je veux supprimer mes conversations.

**Tâches :**
- Ajouter bouton "Supprimer conversation"
- Suppression en cascade (`conversation` + `message`)
- Confirmation avant suppression

**Critères d’acceptation :**
- Suppression complète dans la base
- Message de confirmation affiché
- Aucun accès aux conversations supprimées

---

### US08 – Gestion des niveaux scolaires
**En tant qu’administrateur**, je veux gérer les niveaux scolaires.

**Tâches :**
- Créer interface CRUD pour les niveaux
- Lier `utilisateur.id_niveau_scolaire` à `niveau_scolaire.id_niveau_scolaire`
- Empêcher suppression si utilisé par un utilisateur

**Critères d’acceptation :**
- Niveaux ajoutés, modifiés ou supprimés correctement
- Aucun conflit avec utilisateurs existants

---

### US09 – Gestion des utilisateurs
**En tant qu’administrateur**, je veux gérer les utilisateurs.

**Tâches :**
- Créer page CRUD pour utilisateurs
- Modifier informations utilisateur (profil)
- Supprimer un utilisateur et ses conversations

**Critères d’acceptation :**
- CRUD complet fonctionnel
- Suppression en cascade des données associées
- Validation avant suppression

---

### US010 – Gestion des matières et agents
**En tant qu’administrateur**, je veux lier chaque agent à une matière.

**Tâches :**
- Créer table `matiere`
- Lier `id_agent` à `id_matiere` et à `id_niveau_scolaire`
- Interface d’ajout et gestion des matières

**Critères d’acceptation :**
- Agents correctement associés à un niveau et une matière
- Suppression impossible si matière utilisée
- Affichage clair sur la page étudiant

---

### US011 – Gestion des matières et agents
**En tant qu’administrateur**, je veux lier chaque agent à une matière.

**Tâches :**
- Créer table `matiere`
- Lier `id_agent` à `id_matiere`
- Interface d’ajout et de gestion des matières

**Critères d’acceptation :**
- Agents correctement associés à une matière
- Suppression impossible si matière utilisée
- Affichage clair sur la page étudiant

---

### US012 – Tableau de bord étudiant
**En tant qu’étudiant**, je veux voir mes agents utilisés et mes dernières conversations.

**Tâches :**
- Créer page tableau de bord
- Charger agents et conversations depuis la BDD
- Lien pour reprendre une conversation existante

**Critères d’acceptation :**
- Tableau de bord clair et dynamique
- Accès rapide aux conversations récentes

---

### US013 – Journal de connexion
**En tant qu’administrateur**, je veux consulter les journaux de connexion.

**Tâches :**
- Créer table `user_log` si non existante
- Page affichant date de dernière connexion par utilisateur
- Mise à jour automatique à chaque connexion

**Critères d’acceptation :**
- Affichage correct des logs
- Suppression de l’utilisateur supprime aussi son log

---

## 🗂️ Backlog & Organisation (Trello)

### 🔹 Backlog Produit
Toutes les User Stories ci-dessus.

### 🔹 Sprint 1 – Base de Données & Authentification
- US01 à US04
- US09, US13

### 🔹 Sprint 2 – Agents & Conversations
- US05 à US08

### 🔹 Sprint 3 – RGPD & Sécurité
- US10 à US12

---

## ✅ Critères de réussite
- Base de données fonctionnelle sans erreur.
- Classes POO propres avec PDO sécurisé.
- CRUD complet pour `Utilisateur` et `Agent`.
- Consentement RGPD respecté.
- Interface claire et responsive.
- Historique Git propre (commits clairs + README).

---

