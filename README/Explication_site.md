# School Agent - Plateforme d'Assistants IA Éducatifs

## 🎯 Qu'est-ce que School Agent ?

**School Agent** est une plateforme web éducative qui met à disposition des **assistants IA spécialisés** pour accompagner les étudiants dans leur apprentissage. Chaque assistant est un expert dans un domaine spécifique (mathématiques, français, histoire, sciences, etc.) et peut dialoguer avec les utilisateurs pour les aider à comprendre, réviser et progresser.

---

## 🌟 À quoi sert School Agent ?

### Pour les Étudiants

- **Aide aux devoirs** : Poser des questions sur les cours et obtenir des explications détaillées
- **Révisions** : Préparer les examens avec un assistant qui adapte ses explications à votre niveau
- **Apprentissage personnalisé** : Chaque conversation est sauvegardée, l'assistant se souvient de vos échanges précédents
- **Disponibilité 24/7** : Accès aux assistants à tout moment, même en dehors des heures de cours
- **Plusieurs matières** : Accès à des assistants spécialisés dans différents domaines

### Pour les Enseignants (Admin)

- **Gestion des assistants** : Créer et configurer des assistants IA adaptés aux besoins pédagogiques
- **Suivi des utilisateurs** : Voir qui utilise la plateforme et comment
- **Personnalisation** : Définir le comportement, la spécialité et le niveau de chaque assistant
- **Monitoring** : Accès aux logs et aux conversations pour améliorer l'expérience

---

## ✨ Fonctionnalités Principales

### 1. 🔐 Authentification et Gestion des Comptes

**Connexion / Inscription**
- Création de compte étudiant avec email et mot de passe
- Connexion sécurisée avec hashage des mots de passe
- Gestion de session (rester connecté)
- Rôles utilisateurs : `étudiant` ou `admin`

**Profil utilisateur**
- Informations personnelles (nom, prénom, email)
- Niveau d'éducation (collège, lycée, université)
- Historique des conversations

---

### 2. 🤖 Sélection des Assistants IA

**Liste des assistants disponibles**
- Affichage des assistants actifs avec :
  - Nom de l'assistant (ex: "Prof de Maths", "Tuteur Français")
  - Spécialité (Mathématiques, Sciences, Langues, etc.)
  - Description de ce que l'assistant peut faire
  - Statut (actif/inactif)
  - Avatar ou icône représentative

**Filtres et recherche** (fonctionnalité future)
- Filtrer par matière
- Filtrer par niveau scolaire
- Rechercher un assistant spécifique

**Démarrer une conversation**
- Bouton "Discuter" pour créer une nouvelle conversation
- Accès direct à l'interface de chat

---

### 3. 💬 Interface de Chat Intelligente

**Messagerie en temps réel**
- Messages utilisateur alignés à droite (bulles violettes)
- Réponses de l'assistant alignées à gauche (bulles blanches)
- Avatar de l'assistant visible dans chaque réponse
- Horodatage de chaque message
- Auto-scroll vers les nouveaux messages

**Zone de saisie optimisée**
- Textarea qui s'agrandit automatiquement selon le contenu
- Bouton d'envoi avec icône
- Raccourci clavier : `Ctrl + Entrée` pour envoyer
- Indication visuelle lors de l'envoi

**Fonctionnalités du chat**
- Historique complet de la conversation
- Sauvegarde automatique de tous les messages
- Possibilité de reprendre une conversation ultérieurement
- Réponses contextuelles (l'IA se souvient du contexte)

---

### 4. 📚 Gestion des Conversations

**Liste des conversations**
- Vue de toutes vos conversations avec chaque assistant
- Affichage par assistant (regroupées)
- Informations visibles :
  - Titre de la conversation
  - Nom de l'assistant
  - Date de création
  - Dernier message
- Bouton pour accéder au chat
- Bouton pour supprimer une conversation

**Actions sur les conversations**
- **Créer** : Démarrer une nouvelle conversation avec un assistant
- **Reprendre** : Continuer une conversation existante
- **Supprimer** : Effacer une conversation (avec confirmation)
- **Archiver** : Marquer une conversation comme terminée (fonctionnalité future)

**Organisation**
- Conversations triées par date (plus récentes en premier)
- Interface claire avec cartes pour chaque conversation
- Bouton "Retour aux assistants" pour changer d'assistant

---

### 5. 🎓 Intelligence Artificielle Contextuelle

**Assistants spécialisés**
- Chaque assistant a un **prompt système** qui définit :
  - Sa personnalité (patient, encourageant, pédagogue)
  - Son domaine d'expertise (mathématiques niveau lycée, grammaire française, etc.)
  - Son style de réponse (détaillé, concis, avec exemples)
  - Ses limites (ne donne pas les réponses directement, guide l'étudiant)

**Technologie utilisée**
- **API Groq** : Utilisation de modèles de langage avancés (Llama 3.3 70B)
- Réponses rapides (< 2 secondes)
- Compréhension du contexte de la conversation
- Réponses adaptées au niveau de l'étudiant

**Exemples d'usage**
```
Étudiant : "Je ne comprends pas le théorème de Pythagore"
Assistant Maths : "Je vais t'expliquer ! Le théorème de Pythagore concerne 
les triangles rectangles. Il dit que dans un triangle rectangle, 
le carré de l'hypoténuse (le côté le plus long) est égal à la somme 
des carrés des deux autres côtés. On l'écrit : a² + b² = c². 
Veux-tu que je te montre avec un exemple concret ?"
```

---

### 6. 👨‍💼 Panneau d'Administration (Réservé Admin)

**Gestion des utilisateurs**
- Liste de tous les utilisateurs inscrits
- Voir les informations de chaque utilisateur
- Modifier les rôles (étudiant → admin)
- Supprimer des comptes
- Créer des comptes manuellement

**Gestion des assistants IA**
- Créer de nouveaux assistants
- Configurer :
  - Nom de l'assistant
  - Type (éducation, tuteur, conseiller)
  - Spécialité (matière)
  - Description publique
  - Prompt système (instructions pour l'IA)
  - Statut (actif/inactif)
- Modifier les assistants existants
- Désactiver/Activer des assistants
- Supprimer des assistants

**Gestion des niveaux scolaires**
- Définir les niveaux disponibles (Collège, Lycée, Université, etc.)
- Associer des niveaux aux assistants
- Adapter les réponses selon le niveau

**Gestion des matières**
- Créer des catégories de matières
- Organiser les assistants par matière
- Faciliter la recherche pour les étudiants

**Logs et monitoring**
- Voir l'historique des connexions
- Suivre l'activité des utilisateurs
- Analyser l'utilisation des assistants
- Détecter les problèmes techniques

**Dashboard**
- Vue d'ensemble de la plateforme
- Statistiques :
  - Nombre d'utilisateurs actifs
  - Nombre de conversations aujourd'hui
  - Assistant le plus utilisé
  - Taux de satisfaction (fonctionnalité future)

---

## 🎨 Design et Expérience Utilisateur

### Interface Moderne et Intuitive

**Design épuré**
- Fond blanc avec dégradés subtils
- Accents violets pour les éléments interactifs
- Ombres légères pour la profondeur
- Typographie claire et lisible

**Navigation fluide**
- Menu toujours visible en haut
- Fil d'Ariane pour savoir où on est
- Boutons "Retour" bien placés
- Transitions douces entre les pages

**Responsive Design**
- Adapté aux ordinateurs (desktop)
- Optimisé pour tablettes
- Compatible smartphones (mobile)
- Grilles flexibles qui s'adaptent

**Accessibilité**
- Contrastes respectés pour la lisibilité
- Tailles de texte ajustables
- Navigation au clavier possible
- Messages d'erreur clairs

---

## 🔒 Sécurité et Confidentialité

### Protection des Données

**Authentification sécurisée**
- Mots de passe hashés avec `bcrypt`
- Sessions PHP sécurisées
- Protection contre les attaques par force brute
- Déconnexion automatique après inactivité

**Protection des requêtes**
- Requêtes préparées PDO (contre injections SQL)
- Échappement XSS sur toutes les sorties
- Validation des données côté serveur
- CSRF protection (à améliorer)

**Confidentialité**
- Conversations privées (chaque utilisateur ne voit que les siennes)
- Clés API protégées (fichier config.php non versionné)
- Logs anonymisés
- Pas de revente de données

---

## 🚀 Technologies Utilisées

### Backend
- **PHP 8+** : Langage serveur
- **Architecture MVC** : Organisation du code
- **MySQL** : Base de données relationnelle
- **PDO** : Accès sécurisé à la base de données
- **Composer** : Gestion des dépendances

### Frontend
- **HTML5** : Structure des pages
- **CSS3** : Styles et animations
- **JavaScript vanilla** : Interactions dynamiques
- **Design responsive** : Compatible tous écrans

### Intelligence Artificielle
- **API Groq** : Modèles de langage
- **Llama 3.3 70B** : Modèle utilisé
- **Requêtes HTTP** : Communication avec l'API

### Environnement
- **WAMP** : Serveur local (Windows)
- **Git** : Versioning du code
- **GitHub** : Hébergement du code

---

## 📊 Architecture et Fonctionnement

### Flux d'une Conversation

```
1. L'étudiant se connecte
   → Authentification via AuthController
   → Création de session

2. L'étudiant choisit un assistant
   → Affichage de la liste via IaController
   → Clic sur "Discuter"

3. Création d'une nouvelle conversation
   → Insertion en BDD (table conversation)
   → Redirection vers le chat

4. L'étudiant envoie un message
   → Message sauvegardé (table message, role='user')
   → Récupération du prompt système de l'assistant
   → Appel API Groq avec le contexte

5. L'IA génère une réponse
   → Réponse reçue de l'API
   → Sauvegarde en BDD (table message, role='assistant')
   → Affichage dans le chat

6. Continuation de la conversation
   → L'historique complet est disponible
   → Chaque nouveau message enrichit le contexte
```

### Structure de la Base de Données

```
user (utilisateurs)
├── id_user
├── nom, prenom
├── email (unique)
├── mot_de_passe (hashé)
├── role (étudiant/admin)
└── niveau_education

agent (assistants IA)
├── id_agent
├── nom
├── type
├── specialite
├── description
├── prompt_system
└── status (active/inactive)

conversation (discussions)
├── id_conversation
├── id_user → user
├── id_agent → agent
├── date_creation
└── statut (active/archivée)

message (messages)
├── id_message
├── id_conversation → conversation
├── role (user/assistant)
├── contenu
└── timestamp
```

---

## 🎯 Cas d'Usage Concrets

### Scénario 1 : Étudiant en difficulté en maths

**Contexte** : Marie, lycéenne en 1ère S, ne comprend pas les fonctions logarithmes.

**Utilisation de School Agent** :
1. Marie se connecte sur School Agent
2. Elle sélectionne "Prof de Maths - Lycée"
3. Elle démarre une conversation
4. Elle écrit : "Je ne comprends rien aux logarithmes, c'est quoi exactement ?"
5. L'assistant lui répond avec une explication simple
6. Elle pose des questions de suivi
7. L'assistant lui propose des exercices
8. Elle peut revenir plus tard et reprendre la conversation

**Résultat** : Marie a compris le concept et peut faire ses exercices.

---

### Scénario 2 : Révisions avant un examen

**Contexte** : Thomas prépare son bac de français, épreuve orale sur "L'Étranger" de Camus.

**Utilisation de School Agent** :
1. Thomas sélectionne "Tuteur Français - Littérature"
2. Il écrit : "J'ai l'oral du bac sur L'Étranger, tu peux m'aider ?"
3. L'assistant lui pose des questions pour tester ses connaissances
4. Il lui donne des axes d'analyse
5. Il lui propose des citations clés à retenir
6. Thomas pratique son argumentation avec l'assistant
7. Il sauvegarde la conversation pour relire plus tard

**Résultat** : Thomas se sent préparé et confiant pour son oral.

---

### Scénario 3 : Professeur qui crée un nouvel assistant

**Contexte** : M. Dupont, professeur d'histoire, veut un assistant spécialisé en Histoire Moderne.

**Utilisation de School Agent (Admin)** :
1. Connexion avec compte admin
2. Accès au panneau d'administration
3. Clic sur "Créer un assistant"
4. Remplir le formulaire :
   - Nom : "Prof d'Histoire - Révolution Française"
   - Spécialité : "Histoire Moderne"
   - Description : "Spécialiste de la Révolution Française, explique les événements de 1789 à 1799"
   - Prompt système : "Tu es un professeur d'histoire passionné par la Révolution Française. Tu expliques les événements historiques de manière chronologique et tu aides les élèves à comprendre les causes et conséquences. Tu es patient et tu donnes des exemples concrets."
5. Activation de l'assistant
6. L'assistant est maintenant disponible pour tous les étudiants

**Résultat** : Les étudiants ont un nouvel expert disponible pour leurs révisions d'histoire.

---

## 🔮 Fonctionnalités Futures (Roadmap)

### Court terme (1-3 mois)
- [ ] Notifications en temps réel (nouveau message)
- [ ] Recherche dans l'historique des conversations
- [ ] Export des conversations en PDF
- [ ] Mode sombre (dark mode)
- [ ] Statistiques personnelles pour chaque étudiant

### Moyen terme (3-6 mois)
- [ ] Génération d'exercices personnalisés
- [ ] Quiz interactifs avec correction automatique
- [ ] Partage de conversations (demander de l'aide à un prof)
- [ ] Suggestions d'assistants basées sur les difficultés
- [ ] Support vocal (reconnaissance et synthèse vocale)

### Long terme (6-12 mois)
- [ ] Application mobile (iOS et Android)
- [ ] Intégration avec plateformes éducatives (Moodle, etc.)
- [ ] Détection automatique du niveau de l'étudiant
- [ ] Adaptation dynamique de la difficulté
- [ ] Système de badges et gamification
- [ ] Groupes d'étude virtuels
- [ ] Intégration de documents (PDF, images) dans le chat

---

## 💡 Avantages de School Agent

### Pour les Étudiants
✅ **Disponibilité permanente** : Pas besoin d'attendre le cours suivant  
✅ **Pas de jugement** : Poser autant de questions qu'on veut  
✅ **Apprentissage à son rythme** : L'assistant s'adapte  
✅ **Gratuit** : Accessible à tous les étudiants  
✅ **Complémentaire aux cours** : Aide à la révision et à la compréhension  

### Pour les Enseignants
✅ **Gain de temps** : Les questions simples sont gérées par l'IA  
✅ **Suivi personnalisé** : Voir les difficultés de chaque étudiant  
✅ **Ressource supplémentaire** : Complète l'enseignement en classe  
✅ **Adaptable** : Chaque assistant est personnalisable  
✅ **Scalable** : Peut servir des centaines d'étudiants simultanément  

### Pour l'Établissement Scolaire
✅ **Innovation pédagogique** : Image moderne et technologique  
✅ **Résultats améliorés** : Les étudiants comprennent mieux  
✅ **Réduction du décrochage** : Aide disponible 24/7  
✅ **Données d'analyse** : Identifier les sujets difficiles  
✅ **Coût maîtrisé** : Solution technologique abordable  

---

## 🎓 Philosophie Pédagogique

School Agent est conçu selon les principes suivants :

### 1. **Guider, ne pas donner la réponse**
L'assistant ne fait pas les devoirs à la place de l'étudiant. Il pose des questions, explique les concepts et guide vers la solution.

### 2. **Apprentissage par la compréhension**
L'objectif est de comprendre profondément, pas de mémoriser bêtement. L'assistant utilise des exemples, des analogies et des reformulations.

### 3. **Encouragement et bienveillance**
L'assistant félicite les progrès, encourage lors des difficultés et maintient une attitude positive.

### 4. **Adaptation au niveau**
Chaque assistant connaît le niveau de ses interlocuteurs et adapte son vocabulaire et ses explications.

### 5. **Contextualisation**
Les explications sont reliées au monde réel, aux applications pratiques, pour donner du sens.

---

## 📞 Support et Aide

### Pour les Utilisateurs

**Questions fréquentes**
- Comment créer un compte ?
- J'ai oublié mon mot de passe, que faire ?
- Comment démarrer une conversation ?
- Puis-je supprimer mes anciennes conversations ?
- L'assistant ne répond pas, que faire ?

**Contact**
- Email support : support@schoolagent.fr (exemple)
- Documentation en ligne
- Tutoriels vidéo (à venir)

### Pour les Administrateurs

**Documentation technique**
- Guide d'installation
- Configuration des assistants
- Gestion des utilisateurs
- Monitoring et logs
- Troubleshooting

---

## 🌟 Conclusion

**School Agent** est une plateforme innovante qui combine **pédagogie** et **intelligence artificielle** pour offrir un accompagnement éducatif personnalisé et accessible à tous. 

Que vous soyez étudiant cherchant de l'aide pour vos devoirs, enseignant souhaitant proposer un outil moderne à vos élèves, ou établissement voulant innover pédagogiquement, **School Agent** est la solution adaptée à vos besoins.

---

**Version** : 1.0  
**Date** : Novembre 2025  
**Créateurs** : Olivier / Nicolas / Flavie
