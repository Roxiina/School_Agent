# 📋 CHANGELOG - Modifications Récentes

## 🔄 Derniers changements (5 novembre 2025)

### ✨ Nouvelles fonctionnalités

#### 1️⃣ **Interface de Conversation** 
- Page `/conversation` pour discuter avec les agents IA
- Sélection d'agents via sidebar
- Historique des conversations par agent
- **Icônes personnalisées** pour chaque agent :
  - 🧮 Agent Mathéo → Calculatrice
  - 📖 Agent Histoire → Livre ouvert
  - 🎓 Agent Scolaire → Chapeau diplôme
  - 🖋️ Agent Français → Plume fantaisie

#### 2️⃣ **Système d'icônes amélioré**
- Mapping automatique des icônes basé sur le nom/avatar de l'agent
- Icônes Font Awesome intégrées dans :
  - Liste des agents (sidebar)
  - En-tête du chat
  - Avatars des messages

#### 3️⃣ **Historique des conversations**
- Section dédiée affichant les conversations précédentes
- Affichage du titre et de la date/heure
- Scroll horizontal si nombreuses conversations
- Design cohérent avec le thème bleu

#### 4️⃣ **Configuration WAMP flexible**
- Fichier `app/Config/database.config.php` pour gérer les paramètres de connexion
- Support de plusieurs ports MySQL (3306, 3307, 3308, etc.)
- Configuration facile sans modifier le code source

#### 5️⃣ **4e Agent ajouté**
- **Agent Français** (ID: 4) - Spécialisé en français et littérature
- Avatar: `french.png`
- Icône: 🖋️ Plume fantaisie

---

## 🔧 Modifications techniques

### Base de données
| Élément | Ancien | Nouveau | Raison |
|---------|--------|---------|--------|
| **Port MySQL** | 3306 | **3308** | Port WAMP correct pour avoir tous les agents |
| **Agents** | 3 | **4** | Ajout Agent Français |

### Architecture
```
app/Config/database.config.php          ← NOUVEAU : Configuration externalisée
app/Views/front/conversation.php         ← MODIFIÉ : Ajout historique + icônes
public/css/front/conversation.css        ← MODIFIÉ : Nouveau style historique
public/js/front/conversation.js          ← Inchangé
public/index.php                         ← MODIFIÉ : Meilleur routing
```

### Fichiers de test créés (à supprimer après)
- `public/test-wamp.php` - Diagnostic connexion WAMP
- `public/test-models.php` - Test des modèles
- `public/test-agents.php` - Liste des agents
- `public/check-agents-db.php` - Vérification BD
- `public/list-all-agents.php` - Affichage formaté des agents
- `public/find-mysql-port.php` - Test des différents ports MySQL
- `public/diagnostic.php` - Diagnostic système

### Fichiers de configuration
- `app/Config/database.config.php` - Configuration externalisée ✅ À GARDER
- `SETUP_WAMP.md` - Guide d'installation WAMP (optionnel)
- `router.php` - Routeur pour serveur PHP intégré (optionnel)

---

## 📊 Impact

### ✅ Améliorations
- Interface conversation plus intuitive avec icônes visuelles
- Historique des conversations accessible rapidement
- Configuration de la base de données flexibles et facile à modifier
- Support de plusieurs environnements MySQL

### 🔧 Points techniques réglés
- Problème de routing admin (switch sur `$page` au lieu de `$mainPage`)
- Casse des chemins de fichiers (Views/admin au lieu de Views/Admin)
- Support du port MySQL 3308 pour accéder à tous les agents

---

## 🧹 Nettoyage recommandé

### À SUPPRIMER (fichiers de test)
```bash
rm public/test-wamp.php
rm public/test-models.php
rm public/test-agents.php
rm public/check-agents-db.php
rm public/list-all-agents.php
rm public/find-mysql-port.php
rm public/diagnostic.php
```

### À GARDER (utiles)
- ✅ `app/Config/database.config.php` - Configuration
- ✅ `SETUP_WAMP.md` - Documentation
- ✅ `router.php` - Routeur PHP optionnel

---

## 📝 Notes de déploiement

### Avant de mettre en production
1. Supprimer tous les fichiers de test (`public/test-*.php`, etc.)
2. Vérifier le port MySQL dans `database.config.php`
3. Tester les connexions complètes (admin, conversation)
4. Valider les icônes des agents

### Configuration WAMP finale
```php
// app/Config/database.config.php
'port' => '3308',  // Assurez-vous que c'est le bon port
```

---

## 🚀 Prochaines étapes recommandées

1. **Intégration LLM** - Connecter une véritable API IA (OpenAI, Ollama, etc.)
2. **Persistance des messages** - Sauvegarder les messages en BD
3. **Authentification améliorée** - JWT, sessions plus robustes
4. **Tests unitaires** - PHPUnit pour valider les modèles
5. **Optimisation** - Cache Redis, compression CSS/JS

---

## 📞 Support

Pour toute question sur ces changements, consultez :
- `SETUP_WAMP.md` - Guide d'installation
- `app/Config/database.config.php` - Configuration
- Code du ConversationController - Logique métier

---

**Dernière mise à jour:** 5 novembre 2025
**Auteur:** Flavie
**Branche:** front_v3
