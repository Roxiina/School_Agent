# Guide : Configurer la connexion à WAMP

## 🔧 Étapes à suivre

### 1️⃣ Vérifiez que WAMP est démarré
- Ouvrez **WAMP Manager** 
- Assurez-vous que le serveur est en **vert** (Running)
- Vérifiez que MySQL est en marche

### 2️⃣ Testez la connexion WAMP
Allez à : **http://localhost:8080/test-wamp.php**

Cela vous montrera :
- ✅ Si la connexion MySQL fonctionne
- ✅ Si la base de données 'schoolia' existe
- ✅ Si les tables sont créées
- ✅ Si les données existent

### 3️⃣ Configurez la base de données (si nécessaire)

**Fichier de configuration:** `app/Config/database.config.php`

```php
return [
    'host' => 'localhost',      // Hôte (localhost pour WAMP local)
    'port' => '3306',           // Port (3306 défaut, essayez 3307 si erreur)
    'dbname' => 'schoolia',     // Nom de la base de données
    'username' => 'root',       // Utilisateur (root par défaut WAMP)
    'password' => '',           // Mot de passe (vide par défaut WAMP)
    'charset' => 'utf8mb4',     // Charset
];
```

### 4️⃣ Créez la base de données (si elle n'existe pas)

#### Option A : Via phpMyAdmin
1. Ouvrez **http://localhost/phpmyadmin**
2. Cliquez sur "Nouvelle base de données"
3. Tapez `schoolia`
4. Cliquez "Créer"

#### Option B : Via la ligne de commande MySQL
```sql
CREATE DATABASE IF NOT EXISTS schoolia
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
```

### 5️⃣ Importez les tables et données

#### Option A : Via phpMyAdmin
1. Ouvrez **http://localhost/phpmyadmin**
2. Sélectionnez la base de données `schoolia`
3. Allez dans l'onglet "Importer"
4. Choisissez le fichier `documents/doc_bdd/code_sql.txt`
5. Cliquez "Exécuter"

#### Option B : Via la ligne de commande
```bash
mysql -u root -p schoolia < documents/doc_bdd/code_sql.txt
```

### 6️⃣ Insérez les données de test

Allez dans **http://localhost/phpmyadmin** et exécutez le SQL du fichier `documents/doc_bdd/jeu_donne.txt`

Ou copiez-collez dans l'onglet "SQL"

### 7️⃣ Testez votre application

#### Test Admin:
- Allez à **http://localhost:8080/admin**
- Connectez-vous avec un compte admin
- Les données du WAMP devraient s'afficher

#### Test Conversation:
- Allez à **http://localhost:8080/conversation**
- Les agents et l'historique devraient s'afficher

## ⚠️ Dépannage

| Problème | Solution |
|----------|----------|
| "Connection refused" | WAMP n'est pas démarré - démarrez le serveur |
| "Database not found" | La base de données n'existe pas - créez-la |
| "No such table" | Les tables n'existent pas - importez le SQL |
| Port 3307 | Essayez de changer le port dans `database.config.php` |
| Pas de données | Les données n'ont pas été insérées - insérez le jeu de données |

## 🎯 Vérification finale

Après tout ça, testez avec : **http://localhost:8080/test-wamp.php**

Tous les tests doivent être ✅ VERTS pour que ça marche !
