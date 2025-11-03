# 📱 Guide d'Utilisation du Chat IA - School Agent

## 🚀 Vue d'ensemble

Le système de chat vous permet de communiquer directement avec les agents IA de School Agent. Cette interface est conçue pour offrir une expérience similaire à ChatGPT, avec un design moderne et intuitif.

## 🎯 Fonctionnalités

### 1. **Interface de Chat Moderne**
- Design inspiré de ChatGPT
- Sidebar avec historique des conversations
- Messages d'utilisateur et d'agent clairement distingués
- Animations fluides et réactives

### 2. **Créer une Nouvelle Conversation**
1. Cliquez sur le bouton "💬 Ouvrir le chat" dans le dashboard
2. Ou accédez directement à `?page=conversation/chat`
3. Remplissez le formulaire :
   - **Titre** : Donnez un nom descriptif à votre conversation
   - **Agent** : Sélectionnez l'agent IA avec lequel discuter
4. Cliquez sur "Créer la conversation"

### 3. **Envoyer des Messages**
- Tapez votre question dans la zone de saisie
- Appuyez sur Entrée ou cliquez sur le bouton d'envoi (✈️)
- L'agent répondra automatiquement
- Le message apparaît immédiatement dans le chat

### 4. **Historique des Conversations**
- Toutes vos conversations sont sauvegardées
- Accédez-les via la sidebar gauche
- Cliquez sur une conversation pour la charger
- Continuez la discussion avec l'agent

## 📁 Architecture du Système

### Fichiers Modifiés/Créés

```
app/
├── Models/
│   ├── MessageModel.php          (+ méthode getMessagesByConversation)
│   ├── ConversationModel.php     (inchangé)
│   └── AgentModel.php            (utilisé)
├── Controllers/
│   └── ConversationController.php (+ méthodes chat() et sendMessage())
└── Views/
    └── conversation/
        ├── chat.php              (★ NOUVELLE - Interface chat)
        └── create.php            (Amélioré - Formulaire moderne)
└── dashboard/
    └── student.php               (Ajout bouton chat)
public/
└── index.php                      (+ routes pour chat et API)
```

### Routes Disponibles

| Route | Méthode | Description |
|-------|---------|-------------|
| `?page=conversation/chat` | GET | Affiche l'interface de chat |
| `?page=conversation/chat&id=X` | GET | Ouvre une conversation spécifique |
| `?page=conversation/send-message` | POST | Envoie un message (AJAX) |
| `?page=api/conversations` | GET | Récupère les conversations en JSON |
| `?page=conversation/create` | GET/POST | Crée une nouvelle conversation |

## 💻 Détails Techniques

### MessageModel - Nouvelle Méthode

```php
public function getMessagesByConversation($conversationId)
```
- Récupère tous les messages d'une conversation
- Retourne un tableau avec question/réponse

### ConversationController - Nouvelles Méthodes

#### `chat($conversationId = null)`
- Affiche l'interface de chat
- Charge les messages existants
- Vérifie les permissions

#### `sendMessage()`
- Traite les messages envoyés en AJAX
- Valide que l'utilisateur a accès à la conversation
- Retourne une réponse JSON
- Sauvegarde en base de données

### Interface de Chat (chat.php)

**Fonctionnalités JavaScript :**
- `loadConversations()` : Charge la liste des conversations
- `sendMessage()` : Envoie un message via AJAX
- `escapeHtml()` : Sécurise les messages
- Animation des messages (fade-in)
- Indicateur de chargement lors de la réponse

## 🔒 Sécurité

✅ **Validations Implémentées :**
- Authentification requise pour accéder au chat
- Vérification que l'utilisateur possède la conversation
- Utilisation de PDO pour les requêtes SQL
- Échappement HTML des messages
- Contrôle d'accès par rôle

## 🎨 Design

### Palette de Couleurs
- **Principal** : `#667eea` (Bleu-violet)
- **Secondaire** : `#764ba2` (Violet)
- **Fond** : `#fff` (Blanc)
- **Texte** : `#2c3e50` (Gris foncé)

### Composants Visuels
- Messages utilisateur : Gradient bleu-violet, arrondi
- Messages agent : Gris clair, arrondi asymétrique
- Boutons : Gradient avec animations
- Sidebar : Historique avec surbrillance active

## 📊 Statuts des Messages

| Statut | Description |
|--------|-------------|
| ✅ Envoyé | Message sauvegardé en base |
| ⏳ En attente | Réponse de l'IA en cours |
| 🔄 Chargement | Animation pointillée (bounce) |
| ❌ Erreur | Message d'erreur en rouge |

## 🚀 Utilisation au Quotidien

### Pour un Étudiant :

1. **Se connecter** : Accédez au dashboard
2. **Ouvrir le chat** : Cliquez sur "💬 Ouvrir le chat"
3. **Créer une conversation** : Choisissez un agent
4. **Dialoguer** : Posez vos questions
5. **Consulter l'historique** : Revisualisez vos conversations précédentes

### Pour un Agent (à venir) :

- Répondre aux messages avec IA
- Personnaliser les réponses
- Voir les statistiques

## 🔧 Intégration avec OpenAI (À Faire)

Actuellement, les réponses sont simulées. Pour intégrer OpenAI :

1. Installer `openai/php-client`
2. Modifier la méthode `sendMessage()` pour appeler l'API OpenAI
3. Ajouter gestion des erreurs
4. Implémenter streaming des réponses

## 📱 Responsive Design

L'interface s'adapte automatiquement :
- **Desktop** : Sidebar + Chat (2 colonnes)
- **Tablette** : Sidebar masquée avec bouton menu
- **Mobile** : Chat en plein écran

## ✨ Fonctionnalités Futures

- [ ] Streaming des réponses IA
- [ ] Partage de conversations
- [ ] Édition des messages
- [ ] Suppression de messages
- [ ] Téléchargement de conversation
- [ ] Recherche dans l'historique
- [ ] Thème sombre/clair
- [ ] Support des images/fichiers

## 🐛 Dépannage

### Le chat ne charge pas
- Vérifier que l'utilisateur est connecté
- Vérifier les logs d'erreur
- Vérifier que la conversation existe

### Les messages ne s'envoient pas
- Vérifier la console JavaScript (F12)
- Vérifier que l'ID de conversation est valide
- Vérifier les permissions

### Les réponses n'apparaissent pas
- Vérifier la base de données
- Vérifier la réponse AJAX
- Vérifier les erreurs PHP

## 📞 Support

Pour toute question ou problème, veuillez contacter l'équipe de développement.

---

**Dernière mise à jour :** Novembre 2025
**Version :** 1.0.0
**Statut :** ✅ Production
