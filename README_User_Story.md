## 🧩 Structure d’une User Story

👉 Chaque user story suit la structure :

- En tant que [type d’utilisateur],
- je veux [objectif / action],
- afin de [bénéfice / raison].

Et chaque story doit avoir :
- ✅ des critères d’acceptation (comment on sait que c’est fini),
- 🧠 éventuellement des tâches techniques associées (à donner aux dévs).
- 🎯 Liste des principales User Stories (Phase 1)
- 🧍‍♂️ US01 — Inscription utilisateur

En tant que nouvel utilisateur,
je veux m’inscrire sur la plateforme avec mon nom, e-mail, mot de passe et consentement RGPD,
afin de pouvoir accéder à mon espace personnel.

Critères d’acceptation :
- Un formulaire affiche les champs : nom, email, mot de passe, case consentement RGPD.
- Le mot de passe est haché avant insertion en base.
- Si le consentement n’est pas coché, l’inscription est refusée.
- Message de confirmation affiché si l’inscription réussit.

Tâches techniques :
- Créer le modèle User (POO).
- Ajouter méthode register() avec PDO sécurisé.
- Créer la vue register.php.

## 🔐 US02 — Connexion utilisateur

**En tant qu’**utilisateur existant,
je veux me connecter avec mon e-mail et mon mot de passe,
afin de accéder à mon espace personnel et gérer mes agents.

Critères d’acceptation :
- Vérification du mot de passe avec password_verify().
- Redirection vers le profil si connexion réussie.
- Mesage d’erreur si e-mail/mot de passe invalide.

Tâches techniques :
- Créer la méthode login() dans UserController.
- Gérer la session PHP.

## 👤 US03 — Gestion du profil

**En tant qu’**utilisateur connecté,
je veux voir et modifier mes informations (nom, e-mail, mot de passe),
afin de maintenir mes données à jour.

Critères d’acceptation :
- Le profil affiche les infos actuelles de l’utilisateur.
- La modification est enregistrée dans la base.
- Un message confirme la mise à jour.

Tâches techniques :
- Méthodes getUserById() et update() dans User.php.
Vue profile.php.

## 🗑️ US04 — Suppression du compte (RGPD)

**En tant qu’**utilisateur,
je veux pouvoir supprimer mon compte,
afin de exercer mon droit à l’effacement des données personnelles.

Critères d’acceptation :
- Bouton “Supprimer mon compte” accessible depuis le profil.
- Les agents liés sont supprimés automatiquement (ON DELETE CASCADE).
- Message confirmant la suppression.

Tâches techniques :
- Méthode delete() dans User.php.
- Vérifier le fonctionnement de la clé étrangère MySQL.

## 🤖 US05 — Création d’un agent IA

**En tant qu’**utilisateur connecté,
je veux créer un nouvel agent IA avec un prompt personnalisé,
afin de configurer mon assistant pédagogique.

Critères d’acceptation :
- Formulaire : nom agent, promptPerso.
- L’agent est lié à l’utilisateur (user_id).
- Confirmation affichée après enregistrement.

Tâches techniques :
- Modèle Agent.php, méthode create().
Vue agents/create.php.

## 📜 US06 — Liste de mes agents

**En tant qu’**utilisateur connecté,
je veux voir la liste de mes agents existants,
afin de les gérer facilement.

Critères d’acceptation :
- Affichage des agents liés à mon user_id.
- Lien pour modifier ou supprimer chaque agent.

Tâches techniques :
Méthode getAgentsByUser() dans Agent.php.
Vue agents/index.php.

## ✏️ US07 — Modification d’un agent

**En tant qu’**utilisateur,
je veux modifier le prompt ou le nom d’un agent,
afin de adapter son comportement.

Critères d’acceptation :
- Formulaire prérempli avec données actuelles.
- Validation et mise à jour dans la base.

Tâches techniques :
Méthode update() dans Agent.php.

## 🗑️ US08 — Suppression d’un agent

**En tant qu’**utilisateur,
je veux supprimer un agent que je n’utilise plus,
afin de garder mon espace organisé.

Critères d’acceptation :

Bouton “Supprimer” par agent.

Confirmation avant suppression.

L’agent disparaît de la liste.

Tâches techniques :

Méthode delete() dans Agent.php.

## ⚙️ US09 — Sécurité et RGPD
En tant que responsable RGPD,
je veux que les données personnelles soient protégées,
afin de respecter la réglementation.

Critères d’acceptation :
- Hash des mots de passe (password_hash()).
- Aucune donnée en clair sensible.
- Registre RGPD tenu à jour (PDF).
- Suppression complète des données supprimées.

Tâches techniques :
- Rédiger le registre_rgpd.pdf.
- Vérifier le code PHP pour conformité.

🌐 US10 — Interface responsive

**En tant qu’**utilisateur mobile,
je veux naviguer sur la plateforme depuis mon téléphone,
afin de créer et gérer mes agents facilement.

Critères d’acceptation :
- Interface responsive (Tailwind).
- Navigation claire et accessible (WCAG).
- Menus fonctionnels sur mobile.
