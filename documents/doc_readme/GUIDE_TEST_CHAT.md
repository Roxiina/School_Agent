# 🧪 Guide de Test - Système de Chat IA

## 🎯 Objectif
Valider que le système de chat fonctionne correctement pour les étudiants.

## ✅ Cas de Test

### Test 1 : Accès au Chat depuis le Dashboard
**Prérequis :** Être connecté en tant qu'étudiant

**Étapes :**
1. Accéder au dashboard étudiant (`?page=dashboard`)
2. Localiser la section "Mes Conversations"
3. Cliquer sur "💬 Ouvrir le chat"
4. Observer : La page de chat s'affiche

**Résultat attendu :** ✅ Interface de chat visible avec message "Bienvenue !"

---

### Test 2 : Créer une Nouvelle Conversation
**Étapes :**
1. Depuis la page de chat, cliquer sur "Nouvelle" (sidebar)
2. OU Accéder directement `?page=conversation/create`
3. Remplir le formulaire :
   - Titre : "Test de Mathématiques"
   - Agent : Sélectionner un agent
4. Observer l'aperçu de l'agent
5. Cliquer "Créer la conversation"

**Résultat attendu :** 
- ✅ Formulaire valide
- ✅ Aperçu agent s'affiche
- ✅ Message flash "Conversation créée avec succès"
- ✅ Redirection vers le chat
- ✅ Conversation visible dans l'historique

---

### Test 3 : Envoyer un Message
**Prérequis :** Avoir une conversation ouverte

**Étapes :**
1. Taper une question : "Qu'est-ce qu'une fraction ?"
2. Appuyer sur Entrée
3. Ou cliquer le bouton "✈️"
4. Observer le message s'afficher immédiatement

**Résultat attendu :**
- ✅ Message utilisateur visible à droite
- ✅ Indicateur de chargement (3 points animés)
- ✅ Après ~1 sec : Réponse agent s'affiche
- ✅ Réponse sauvegardée en base de données

---

### Test 4 : Historique des Conversations
**Étapes :**
1. Créer plusieurs conversations
2. Envoyer des messages dans 2-3 conversations
3. Observer la sidebar gauche
4. Cliquer sur une conversation précédente

**Résultat attendu :**
- ✅ Sidebar liste toutes les conversations
- ✅ Conversation sélectionnée en surbrillance
- ✅ Messages de la conversation chargés
- ✅ Scrolling automatique au bas

---

### Test 5 : Sécurité - Authentification
**Étapes :**
1. Se déconnecter
2. Tenter d'accéder à `?page=conversation/chat`

**Résultat attendu :**
- ✅ Redirection automatique vers login
- ✅ Message flash "Vous devez être connecté"

---

### Test 6 : Sécurité - Autorisation
**Prérequis :** 2 comptes d'utilisateur (Alice et Bob)

**Étapes :**
1. Connecté en Alice, créer une conversation
2. Récupérer l'ID : `?page=conversation/chat&id=5`
3. Se déconnecter
4. Connecter en Bob
5. Modifier l'URL : `?page=conversation/chat&id=5` (conversation d'Alice)

**Résultat attendu :**
- ✅ Erreur "Accès refusé" (403)
- ✅ Bob ne peut pas voir la conversation d'Alice

---

### Test 7 : Caractères Spéciaux (XSS)
**Étapes :**
1. Dans une conversation, taper :
   ```
   <script>alert('XSS')</script>
   ```
2. Envoyer le message

**Résultat attendu :**
- ✅ Le script ne s'exécute pas
- ✅ Le message apparaît littéralement (texte échappé)
- ✅ Pas d'erreur JavaScript

---

### Test 8 : Messages Longs et Multi-Lignes
**Étapes :**
1. Taper un message avec plusieurs lignes
2. Utiliser Shift+Entrée pour new line
3. Envoyer

**Résultat attendu :**
- ✅ Le message s'envoie correctement
- ✅ Les sauts de ligne sont préservés
- ✅ Pas d'erreur

---

### Test 9 : Responsivité Mobile
**Prérequis :** Navigateur avec outils de développement

**Étapes :**
1. Ouvrir le chat sur desktop
2. Appuyer F12 (DevTools)
3. Cliquer sur "Toggle Device Toolbar" (Ctrl+Shift+M)
4. Sélectionner "iPhone 12"
5. Rafraîchir la page

**Résultat attendu :**
- ✅ Sidebar disparaît
- ✅ Chat prend toute la largeur
- ✅ Zone d'input accessible
- ✅ Messages visibles correctement

---

### Test 10 : Persistance des Messages
**Étapes :**
1. Envoyer un message
2. Attendre que la réponse apparaisse
3. Rafraîchir la page (F5)
4. Observer la même conversation

**Résultat attendu :**
- ✅ Les messages restent visibles
- ✅ Pas de duplication
- ✅ Ordre chronologique préservé

---

## 📊 Résultats Attendus

| Test | Status | Notes |
|------|--------|-------|
| Test 1 : Accès Dashboard | ✅ | Interface charge |
| Test 2 : Créer Conversation | ✅ | Formulaire validé |
| Test 3 : Envoyer Message | ✅ | Message sauvegardé |
| Test 4 : Historique | ✅ | Toutes conversations chargées |
| Test 5 : Authentification | ✅ | Redirection login |
| Test 6 : Autorisation | ✅ | 403 Forbidden |
| Test 7 : XSS | ✅ | Script non exécuté |
| Test 8 : Messages Longs | ✅ | Multilignes OK |
| Test 9 : Mobile | ✅ | Responsive OK |
| Test 10 : Persistance | ✅ | Données sauvegardées |

---

## 🔍 Vérifications Côté Base de Données

### Vérifier les conversations créées
```sql
SELECT * FROM conversation 
WHERE id_user = 2 
ORDER BY date_creation DESC;
```

### Vérifier les messages
```sql
SELECT * FROM message 
WHERE id_conversation = 5 
ORDER BY id_message ASC;
```

### Vérifier les agents
```sql
SELECT * FROM agent 
WHERE id_agent IN (
    SELECT DISTINCT id_agent FROM conversation WHERE id_user = 2
);
```

---

## 🛠️ Dépannage

### Le chat ne charge pas
**Solution :**
1. Vérifier que l'utilisateur est connecté
2. Vérifier les logs PHP/erreurs navigateur
3. Vérifier que la base de données est accessible

### Les messages n'apparaissent pas
**Solution :**
1. Ouvrir la console JavaScript (F12)
2. Regarder les erreurs réseau
3. Vérifier la réponse du serveur

### Erreur "Conversation introuvable"
**Solution :**
1. Vérifier l'ID de la conversation
2. Vérifier que la conversation appartient à l'utilisateur
3. Vérifier la base de données

---

## ✅ Checklist Pre-Production

- [ ] Toutes les syntaxes PHP validées
- [ ] Base de données connectée correctement
- [ ] Au moins 1 agent créé
- [ ] Utilisateurs tests crées (Alice, Bob)
- [ ] Tests 1-10 passent avec succès
- [ ] Pas d'erreurs JavaScript
- [ ] Pas d'erreurs PHP (logs)
- [ ] Design responsive validé
- [ ] Sécurité confirmée
- [ ] Messages flash affichés correctement

---

## 📝 Logs de Test

**Date du test :** _________________
**Testeur :** _________________
**Navigateur :** _________________
**Système d'exploitation :** _________________

**Résultats :**
```
Test 1:  [ ] Pass [ ] Fail - Observations: ___________
Test 2:  [ ] Pass [ ] Fail - Observations: ___________
Test 3:  [ ] Pass [ ] Fail - Observations: ___________
Test 4:  [ ] Pass [ ] Fail - Observations: ___________
Test 5:  [ ] Pass [ ] Fail - Observations: ___________
Test 6:  [ ] Pass [ ] Fail - Observations: ___________
Test 7:  [ ] Pass [ ] Fail - Observations: ___________
Test 8:  [ ] Pass [ ] Fail - Observations: ___________
Test 9:  [ ] Pass [ ] Fail - Observations: ___________
Test 10: [ ] Pass [ ] Fail - Observations: ___________
```

**Bugs trouvés :**
```
1. ___________________________________________
2. ___________________________________________
3. ___________________________________________
```

---

## 🎉 Conclusion

Une fois tous les tests validés, le système est prêt pour la production !

**Prochaines étapes :**
1. Intégrer OpenAI pour les réponses réelles
2. Ajouter les features optionnelles (édition, suppression)
3. Déployer sur serveur production
4. Former les utilisateurs

---

**Dernière mise à jour :** Novembre 2025
